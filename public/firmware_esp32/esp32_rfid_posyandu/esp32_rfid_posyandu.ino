/*
 * ======================================================================================
 * PROYEK         : SMART RT & POSYANDU DIGITAL — TAP RFID e-KTP / KARTU WARGA
 * MIKROKONTROLER : NodeMCU ESP32 (DOIT ESP32 DEVKIT V1 / ESP-WROOM-32)
 * SENSOR RFID    : MFRC522 (RC522) 13.56 MHz (Mendukung e-KTP Indonesia & Mifare)
 * BACKEND        : E-KASRT → https://e-kasrt.unique-monsters.my.id
 * VERSI          : 4.1 — Auto-Detect RST Pin (GPIO 22 / GPIO 25), Max Gain, Fast Response
 * ======================================================================================
 *
 * ── WIRING RC522 ke ESP32 ─────────────────────────────────────────────────────────────
 *  PIN RC522   │ PIN ESP32 │ WARNA   │ KETERANGAN
 *  ────────────┼───────────┼─────────┼──────────────────────────────────────────────────
 *  VCC (3.3V)  │ 3V3       │ MERAH   │ ⚠️ Wajib 3.3V! JANGAN sambung ke VIN/5V!
 *  RST         │ GPIO 22   │ PUTIH   │ Otomatis didukung juga jika di GPIO 25!
 *  GND         │ GND       │ HITAM   │ Ground
 *  MISO        │ GPIO 19   │ HIJAU   │ SPI MISO
 *  MOSI        │ GPIO 23   │ BIRU    │ SPI MOSI
 *  SCK         │ GPIO 18   │ KUNING  │ SPI Clock
 *  SDA (SS)    │ GPIO 5    │ ORANYE  │ SPI Chip Select (CS / SS)
 *  IRQ         │ (kosong)  │ —       │ Tidak perlu disambung
 *
 * ── INDIKATOR ─────────────────────────────────────────────────────────────────────────
 *  LED BIRU Board : GPIO 2 (Menyala = Standby Siap Baca; Berkedip = Kartu Terbaca)
 *  Buzzer (+)     : GPIO 4 (Opsional)
 * ======================================================================================
 */

#include <WiFi.h>
#include <HTTPClient.h>
#include <WiFiClientSecure.h>
#include <SPI.h>
#include <MFRC522.h>

// ======================================================================================
// KONFIGURASI WIFI & BACKEND
// ======================================================================================
const char* WIFI_SSID_1 = "FATIMAH";
const char* WIFI_PASS_1 = "1819122024";

const char* WIFI_SSID_2 = "";
const char* WIFI_PASS_2 = "";

const char* SERVER_URL  = "https://e-kasrt.unique-monsters.my.id/smartrt/posyandu_rfid_tap";
const char* API_KEY     = "kasrt2025";

// ======================================================================================
// DEFINISI PIN HARDWARE
// ======================================================================================
#define SS_PIN     5    // SDA / SS RC522
#define RST_PIN_A  22   // RST RC522 Opsi A (Wiring Default Panduan)
#define RST_PIN_B  25   // RST RC522 Opsi B (Wiring Alternatif)
#define BUZZER_PIN 4    // Buzzer piezo (opsional)
#define LED_BLUE   2    // LED Biru bawaan NodeMCU ESP32

// ======================================================================================
// OBJEK GLOBAL
// ======================================================================================
MFRC522* rfid = nullptr;
int activeRstPin = -1;
WiFiClientSecure secureClient;

// Debounce & State
String        lastUid       = "";
unsigned long lastTapTime   = 0;
const unsigned long DEBOUNCE_MS = 2000;
unsigned long lastWifiCheck = 0;

// ======================================================================================
// SUARA BUZZER
// ======================================================================================
void beep(int freq, int durMs) {
  tone(BUZZER_PIN, freq, durMs);
  delay(durMs + 20);
}

void soundOK() {
  beep(1047, 80);
  beep(1319, 120);
}

void soundNew() {
  beep(880, 80);
  beep(1047, 100);
  beep(1319, 160);
}

void soundError() {
  beep(440, 100);
  beep(349, 200);
}

// ======================================================================================
// KONEKSI WIFI
// ======================================================================================
bool connectWifi() {
  WiFi.mode(WIFI_STA);
  WiFi.disconnect(false);
  delay(100);

  Serial.printf("\n[WiFi] Menghubungkan ke: %s\n", WIFI_SSID_1);

  WiFi.begin(WIFI_SSID_1, WIFI_PASS_1);
  for (int i = 0; i < 20 && WiFi.status() != WL_CONNECTED; i++) {
    delay(300);
    Serial.print(".");
    digitalWrite(LED_BLUE, !digitalRead(LED_BLUE));
  }

  if (WiFi.status() == WL_CONNECTED) {
    digitalWrite(LED_BLUE, HIGH);
    Serial.printf("\n✅ [WiFi] Terhubung! IP: %s | RSSI: %d dBm\n",
                  WiFi.localIP().toString().c_str(), WiFi.RSSI());
    return true;
  }

  if (strlen(WIFI_SSID_2) > 0) {
    Serial.printf("\n[WiFi] Mencoba cadangan: %s\n", WIFI_SSID_2);
    WiFi.begin(WIFI_SSID_2, WIFI_PASS_2);
    for (int i = 0; i < 20 && WiFi.status() != WL_CONNECTED; i++) {
      delay(300);
      Serial.print(".");
      digitalWrite(LED_BLUE, !digitalRead(LED_BLUE));
    }
    if (WiFi.status() == WL_CONNECTED) {
      digitalWrite(LED_BLUE, HIGH);
      Serial.printf("\n✅ [WiFi] Terhubung ke cadangan! IP: %s\n",
                    WiFi.localIP().toString().c_str());
      return true;
    }
  }

  Serial.println("\n⚠️ [WiFi] Hotspot/WiFi belum terhubung.");
  Serial.println("ℹ️ [INFO] Mode USB Serial AKTIF — Tap tetap terbaca di browser via WebSerial!");
  digitalWrite(LED_BLUE, HIGH);
  return false;
}

// ======================================================================================
// KIRIM KE SERVER VIA WIFI HTTP POST
// ======================================================================================
String sendToServer(const String& uid) {
  if (WiFi.status() != WL_CONNECTED) {
    return "{\"status\":\"offline\",\"message\":\"WiFi belum tersambung\"}";
  }

  HTTPClient http;
  secureClient.setInsecure(); // abaikan validasi SSL untuk kompatibilitas cert
  http.begin(secureClient, SERVER_URL);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  http.addHeader("Accept", "application/json");
  http.setTimeout(6000);

  String body = "api_key=" + String(API_KEY) + "&uid=" + uid;
  int code = http.POST(body);

  String resp = "";
  if (code > 0) {
    resp = http.getString();
    Serial.printf("  [HTTP %d] Respons Server: %s\n", code, resp.c_str());
  } else {
    Serial.printf("  [HTTP Gagal] %s\n", http.errorToString(code).c_str());
    resp = "{\"status\":\"error\",\"message\":\"" + http.errorToString(code) + "\"}";
  }
  http.end();
  return resp;
}

// ======================================================================================
// PROSES RESPON SERVER
// ======================================================================================
void handleResponse(const String& resp, const String& uid) {
  if (resp.indexOf("\"success\"") > -1 || resp.indexOf("SUCCESS") > -1) {
    Serial.println("  ✅ [ABSEN SUKSES] Warga terdaftar & balita hadir!");
    soundOK();
    for (int i = 0; i < 3; i++) {
      digitalWrite(LED_BLUE, LOW);  delay(60);
      digitalWrite(LED_BLUE, HIGH); delay(60);
    }
  } else if (resp.indexOf("already") > -1 || resp.indexOf("ALREADY") > -1) {
    Serial.println("  ℹ️ [SUDAH HADIR] Warga/balita ini sudah absen hari ini.");
    soundError();
  } else if (resp.indexOf("unregistered") > -1 || resp.indexOf("UNREGISTERED") > -1) {
    Serial.println("  🆕 [KARTU BARU] e-KTP belum terhubung ke data warga!");
    Serial.printf("     Silakan pilih nama warga di popup browser untuk UID: %s\n", uid.c_str());
    soundNew();
    for (int i = 0; i < 5; i++) {
      digitalWrite(LED_BLUE, LOW);  delay(50);
      digitalWrite(LED_BLUE, HIGH); delay(50);
    }
  } else if (resp.indexOf("offline") > -1) {
    Serial.println("  📶 [MODE OFFLINE] UID dikirim via USB Serial ke browser.");
  }
}

// ======================================================================================
// SETUP
// ======================================================================================
void setup() {
  Serial.begin(115200);
  delay(300);

  pinMode(LED_BLUE,   OUTPUT);
  pinMode(BUZZER_PIN, OUTPUT);

  // Indikator boot: kedip 3x
  for (int i = 0; i < 3; i++) {
    digitalWrite(LED_BLUE, HIGH); delay(100);
    digitalWrite(LED_BLUE, LOW);  delay(100);
  }
  digitalWrite(LED_BLUE, HIGH);

  Serial.println("\n╔══════════════════════════════════════════════════════╗");
  Serial.println("║   E-KASRT POSYANDU — RFID SCANNER v4.1 (PLUG & PLAY) ║");
  Serial.println("║   Auto-Detect RST (GPIO 22 / 25) | Max Antenna Gain   ║");
  Serial.println("╚══════════════════════════════════════════════════════╝");
  Serial.printf("   Target Endpoint : %s\n", SERVER_URL);
  Serial.printf("   Target SSID     : %s\n\n", WIFI_SSID_1);

  // Beri daya HIGH ke kedua kandidat pin RST agar RC522 tidak sleep
  pinMode(RST_PIN_A, OUTPUT); digitalWrite(RST_PIN_A, HIGH);
  pinMode(RST_PIN_B, OUTPUT); digitalWrite(RST_PIN_B, HIGH);
  delay(20);

  // Init SPI bus (SCK=18, MISO=19, MOSI=23, SS=5)
  SPI.begin(18, 19, 23, SS_PIN);

  // ── DETEKSI OTOMATIS PIN RST RC522 ──────────────────────────────────
  Serial.println("[RC522] Mendeteksi sensor RFID...");

  // Tes 1: Coba GPIO 22 (Wiring Panduan Default)
  rfid = new MFRC522(SS_PIN, RST_PIN_A);
  rfid->PCD_Init();
  delay(60);
  byte ver = rfid->PCD_ReadRegister(MFRC522::VersionReg);
  Serial.printf("  > Tes GPIO 22: Chip Version = 0x%02X\n", ver);

  if (ver != 0x00 && ver != 0xFF) {
    activeRstPin = RST_PIN_A;
    Serial.printf("  ✅ Sensor RC522 TERDETEKSI pada GPIO 22 (Ver: 0x%02X)!\n", ver);
  } else {
    // Tes 2: Coba GPIO 25 (Alternatif)
    delete rfid;
    rfid = new MFRC522(SS_PIN, RST_PIN_B);
    rfid->PCD_Init();
    delay(60);
    ver = rfid->PCD_ReadRegister(MFRC522::VersionReg);
    Serial.printf("  > Tes GPIO 25: Chip Version = 0x%02X\n", ver);

    if (ver != 0x00 && ver != 0xFF) {
      activeRstPin = RST_PIN_B;
      Serial.printf("  ✅ Sensor RC522 TERDETEKSI pada GPIO 25 (Ver: 0x%02X)!\n", ver);
    } else {
      // Tes 3: Coba Soft Reset tanpa RST pin
      delete rfid;
      rfid = new MFRC522(SS_PIN, MFRC522::UNUSED_PIN);
      rfid->PCD_Init();
      delay(60);
      ver = rfid->PCD_ReadRegister(MFRC522::VersionReg);
      Serial.printf("  > Tes Soft Reset (UNUSED_PIN): Chip Version = 0x%02X\n", ver);

      if (ver != 0x00 && ver != 0xFF) {
        activeRstPin = 255;
        Serial.printf("  ✅ Sensor RC522 TERDETEKSI via Soft Reset (Ver: 0x%02X)!\n", ver);
      } else {
        Serial.println("  ❌ RC522 belum terbaca! Periksa kabel SPI (VCC=3.3V, GND, D5, D18, D19, D23).");
        Serial.println("  ⚠️ Sistem tetap lanjut — sensor akan di-retry pada setiap loop.");
        soundError();
      }
    }
  }

  // Set gain antena ke MAKSIMUM agar e-KTP dan kartu Mifare mudah terbaca
  if (rfid != nullptr) {
    rfid->PCD_SetAntennaGain(MFRC522::RxGain_max);
    rfid->PCD_AntennaOn();
  }

  // Koneksi ke WiFi (non-blocking jika gagal)
  connectWifi();

  // Pastikan LED biru menyala tanda alat STANDBY siap digunakan
  digitalWrite(LED_BLUE, HIGH);
  Serial.println("\n══════════════════════════════════════════════════════");
  Serial.println("  [STANDBY] SIAP SCAN! Silakan tempelkan kartu e-KTP.");
  Serial.println("══════════════════════════════════════════════════════\n");
}

// ======================================================================================
// LOOP UTAMA
// ======================================================================================
void loop() {
  // LED Biru standby ON
  digitalWrite(LED_BLUE, HIGH);

  // Reconnect WiFi berkala jika terputus (tiap 30 detik)
  unsigned long now = millis();
  if (WiFi.status() != WL_CONNECTED && (now - lastWifiCheck > 30000)) {
    lastWifiCheck = now;
    connectWifi();
  }

  // Jika sensor belum terdeteksi saat boot, coba init ulang
  if (rfid == nullptr) {
    delay(500);
    return;
  }

  // Cek keberadaan kartu
  if (!rfid->PICC_IsNewCardPresent()) {
    delay(25);
    return;
  }

  // Baca serial kartu
  if (!rfid->PICC_ReadCardSerial()) {
    delay(25);
    return;
  }

  // Konversi UID ke format HEX Uppercase (cth: "04E99A11B280")
  String uid = "";
  for (byte i = 0; i < rfid->uid.size; i++) {
    if (rfid->uid.uidByte[i] < 0x10) uid += "0";
    uid += String(rfid->uid.uidByte[i], HEX);
  }
  uid.toUpperCase();

  // Debounce (cegah tap berulang dalam 2 detik)
  now = millis();
  if (uid == lastUid && (now - lastTapTime < DEBOUNCE_MS)) {
    rfid->PICC_HaltA();
    rfid->PCD_StopCrypto1();
    return;
  }
  lastUid     = uid;
  lastTapTime = now;

  // VISUAL FEEDBACK LANGSUNG: Matikan LED 150ms saat tap terbaca
  digitalWrite(LED_BLUE, LOW);

  // OUTPUT KE SERIAL DENGAN BERBAGAI FORMAT SUPAYA 100% COCOK KE REGEX WEBSERIAL
  MFRC522::PICC_Type piccType = rfid->PICC_GetType(rfid->uid.sak);
  Serial.println("\n--------------------------------------------------");
  Serial.printf("💳 [TAP RFID TERDETEKSI]\n");
  Serial.printf("Card UID: %s\n", uid.c_str());
  Serial.printf("UID: %s\n", uid.c_str());
  Serial.printf("Tipe: %s\n", rfid->PICC_GetTypeName(piccType));

  // Verifikasi ke server (jika WiFi ada)
  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("  > Mengirim ke server E-KASRT...");
    String resp = sendToServer(uid);
    handleResponse(resp, uid);
  } else {
    Serial.println("  > Mode Serial: Browser akan meneruskan UID ini ke server.");
    soundOK();
  }
  Serial.println("--------------------------------------------------");

  // Bersihkan komunikasi kartu
  rfid->PICC_HaltA();
  rfid->PCD_StopCrypto1();

  delay(150);
  digitalWrite(LED_BLUE, HIGH); // Standby lagi
}
