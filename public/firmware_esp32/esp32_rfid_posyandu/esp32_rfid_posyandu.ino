/*
 * ======================================================================================
 * PROYEK     : SMART RT & POSYANDU DIGITAL — TAP RFID e-KTP / KARTU WARGA
 * MIKROKONTROLER : NodeMCU ESP32 (ESP-WROOM-32 / 32D / 30-Pin & 38-Pin DevKit)
 * SENSOR RFID: MFRC522 (RC522) 13.56 MHz (Mendukung e-KTP Indonesia & Kartu Mifare)
 * BACKEND    : E-KASRT → https://e-kasrt.unique-monsters.my.id
 * VERSI      : 2.1 (Production — HTTPS + Multi-WiFi Fallback)
 * ======================================================================================
 *
 * ── SKEMA WIRING RC522 ke ESP32 ─────────────────────────────────────────────────────
 *
 * PIN RC522 (RFID)   PIN NODEMCU ESP32   WARNA KABEL   KETERANGAN
 * --------------------------------------------------------------------------------------
 * VCC (3.3V)        3V3                 MERAH         ⚠️ Wajib 3.3V! JANGAN ke 5V/VIN
 * RST               GPIO 22 (D22)       PUTIH/UNGU    Reset Pin
 * GND               GND                 HITAM         Ground
 * MISO              GPIO 19 (D19)       HIJAU         SPI MISO
 * MOSI              GPIO 23 (D23)       BIRU          SPI MOSI
 * SCK               GPIO 18 (D18)       KUNING        SPI Clock
 * SDA (SS)          GPIO 5  (D5)        ORANYE        SPI Chip Select
 * IRQ               (TIDAK TERHUBUNG)   —             Biarkan kosong
 *
 * ── INDIKATOR (OPSIONAL) ─────────────────────────────────────────────────────────────
 * Buzzer (+)        GPIO 4  (D4)        KUNING        Beep sukses / gagal
 * Buzzer (-)        GND                 HITAM         Ground
 * LED Hijau (+)     GPIO 15 (D15)       HIJAU         Absen berhasil
 * LED Merah (+)     GPIO 13 (D13)       MERAH         Belum terdaftar / error
 * Katoda LED (-)    GND via R 220Ω      HITAM         Resistor 220 Ohm
 *
 * ── ARDUINO IDE SETUP ────────────────────────────────────────────────────────────────
 * 1. Tools → Board → Boards Manager → cari "esp32" by Espressif → Install
 * 2. Tools → Board → pilih "ESP32 Dev Module" atau "DOIT ESP32 DEVKIT V1"
 * 3. Sketch → Include Library → Manage Libraries → install:
 *    - "MFRC522" by GithubCommunity (v1.4.x)
 * 4. Upload Speed: 115200
 * 5. Serial Monitor: Baud 115200
 * ======================================================================================
 */

#include <WiFi.h>
#include <HTTPClient.h>
#include <WiFiClientSecure.h>
#include <SPI.h>
#include <MFRC522.h>

// ======================================================================================
// ★ KONFIGURASI — SESUAIKAN BAGIAN INI SEBELUM UPLOAD ★
// ======================================================================================

// ── WiFi Utama (misalnya hotspot HP petugas posyandu) ─────────────────────────────
const char* WIFI_SSID_1     = "NAMA_WIFI_UTAMA";
const char* WIFI_PASS_1     = "PASSWORD_WIFI_UTAMA";

// ── WiFi Cadangan (misalnya WiFi rumah pak RT) ────────────────────────────────────
const char* WIFI_SSID_2     = "NAMA_WIFI_CADANGAN";
const char* WIFI_PASS_2     = "PASSWORD_WIFI_CADANGAN";

// ── URL Endpoint Backend E-KASRT (Production HTTPS) ──────────────────────────────
// Untuk server PRODUCTION (VPS publik):
const char* SERVER_URL = "https://e-kasrt.unique-monsters.my.id/smartrt/posyandu_rfid_tap";

// Untuk testing LOCAL (Laragon di laptop — ESP32 & laptop harus WiFi sama):
// Ganti 192.168.x.x dengan IP laptop kamu (cek via ipconfig di CMD)
// const char* SERVER_URL = "http://192.168.1.10/kasrt/smartrt/posyandu_rfid_tap";

// ── API Key — harus SAMA dengan yang ada di backend ───────────────────────────────
const char* API_KEY = "kasrt2025";

// ── Nonaktifkan verifikasi SSL (untuk HTTPS dengan sertifikat gratis / Let's Encrypt)
// Set ke false hanya jika pakai HTTPS dengan CA root yang diketahui
const bool SKIP_SSL_VERIFY = true;

// ======================================================================================
// 2. PIN HARDWARE
// ======================================================================================
#define SS_PIN      5    // SDA / SS RC522
#define RST_PIN     22   // RST RC522
#define BUZZER_PIN  4    // Buzzer
#define LED_GREEN   15   // LED Hijau
#define LED_RED     13   // LED Merah

MFRC522 rfid(SS_PIN, RST_PIN);
WiFiClientSecure secureClient;

// Kontrol debounce
unsigned long lastTapTime = 0;
String        lastUid     = "";
const unsigned long DEBOUNCE_MS = 3000; // 3 detik antara tap kartu yang sama

// ======================================================================================
// 3. INDIKATOR SUARA & LAMPU
// ======================================================================================
void soundSuccess() {
  digitalWrite(LED_GREEN, HIGH);
  tone(BUZZER_PIN, 2000, 100); delay(130);
  tone(BUZZER_PIN, 2600, 220); delay(260);
  digitalWrite(LED_GREEN, LOW);
}

void soundWarning() {
  digitalWrite(LED_RED, HIGH);
  tone(BUZZER_PIN, 800, 400); delay(450);
  digitalWrite(LED_RED, LOW);
}

void soundError() {
  for (int i = 0; i < 3; i++) {
    digitalWrite(LED_RED, HIGH);
    tone(BUZZER_PIN, 500, 150); delay(200);
    digitalWrite(LED_RED, LOW); delay(100);
  }
}

void soundStartup() {
  tone(BUZZER_PIN, 1500, 80); delay(110);
  tone(BUZZER_PIN, 2000, 80); delay(110);
  tone(BUZZER_PIN, 2600, 150); delay(200);
  digitalWrite(LED_GREEN, HIGH); delay(300);
  digitalWrite(LED_GREEN, LOW);
}

// ======================================================================================
// 4. KONEKSI WIFI (Multi-SSID fallback)
// ======================================================================================
bool connectWifi() {
  WiFi.mode(WIFI_STA);

  // Coba WiFi Utama
  Serial.print("[WiFi] Mencoba SSID: "); Serial.println(WIFI_SSID_1);
  WiFi.begin(WIFI_SSID_1, WIFI_PASS_1);
  for (int i = 0; i < 20 && WiFi.status() != WL_CONNECTED; i++) {
    delay(500); Serial.print(".");
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\n✅ [WiFi] Terhubung ke: " + String(WIFI_SSID_1));
    Serial.println("   IP ESP32  : " + WiFi.localIP().toString());
    return true;
  }

  // Coba WiFi Cadangan
  WiFi.disconnect();
  Serial.print("\n[WiFi] Mencoba SSID cadangan: "); Serial.println(WIFI_SSID_2);
  WiFi.begin(WIFI_SSID_2, WIFI_PASS_2);
  for (int i = 0; i < 20 && WiFi.status() != WL_CONNECTED; i++) {
    delay(500); Serial.print(".");
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\n✅ [WiFi] Terhubung ke: " + String(WIFI_SSID_2));
    Serial.println("   IP ESP32  : " + WiFi.localIP().toString());
    return true;
  }

  Serial.println("\n❌ [WiFi] Semua SSID gagal! Periksa nama/password WiFi.");
  return false;
}

// ======================================================================================
// 5. KIRIM UID KE SERVER
// ======================================================================================
String sendToServer(const String& uid) {
  HTTPClient http;
  String result = "";

  bool isHttps = String(SERVER_URL).startsWith("https");

  if (isHttps) {
    if (SKIP_SSL_VERIFY) secureClient.setInsecure();
    http.begin(secureClient, SERVER_URL);
  } else {
    http.begin(SERVER_URL);
  }

  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  http.addHeader("Accept", "application/json");
  http.setTimeout(8000); // 8 detik timeout

  String postData = "api_key=" + String(API_KEY) + "&uid=" + uid;
  int code = http.POST(postData);

  if (code > 0) {
    result = http.getString();
    Serial.print("  > HTTP Status : "); Serial.println(code);
    Serial.println("  > Respon JSON : " + result);
  } else {
    Serial.println("  > GAGAL: " + http.errorToString(code));
  }

  http.end();
  return result;
}

// ======================================================================================
// 6. SETUP
// ======================================================================================
void setup() {
  Serial.begin(115200);
  delay(800);

  Serial.println("\n╔══════════════════════════════════════════════════════╗");
  Serial.println("║   SISTEM POSYANDU DIGITAL E-KASRT — v2.1 PRODUCTION  ║");
  Serial.println("║   ESP32 + RC522 RFID Reader (13.56 MHz)              ║");
  Serial.println("╚══════════════════════════════════════════════════════╝");
  Serial.println("   Server  : " + String(SERVER_URL));
  Serial.println("   API Key : " + String(API_KEY));
  Serial.println();

  // Init pin output
  pinMode(BUZZER_PIN, OUTPUT);
  pinMode(LED_GREEN,  OUTPUT);
  pinMode(LED_RED,    OUTPUT);
  digitalWrite(LED_GREEN, LOW);
  digitalWrite(LED_RED,   LOW);

  // Init SPI & RC522
  SPI.begin();
  rfid.PCD_Init();
  delay(50);

  byte ver = rfid.PCD_ReadRegister(rfid.VersionReg);
  Serial.print("[RC522] Chip version: 0x"); Serial.println(ver, HEX);

  if (ver == 0x00 || ver == 0xFF) {
    Serial.println("❌ [RC522] Tidak terdeteksi! Periksa kabel SPI.");
    soundError();
  } else {
    Serial.println("✅ [RC522] Siap membaca e-KTP & Kartu RFID!");
  }

  // Koneksi WiFi
  if (connectWifi()) {
    soundStartup();
  } else {
    soundError();
  }

  Serial.println("\n[STANDBY] Silakan tempelkan e-KTP atau Kartu ke sensor RFID...");
  Serial.println("──────────────────────────────────────────────────────");
}

// ======================================================================================
// 7. LOOP UTAMA
// ======================================================================================
void loop() {
  // Rekoneksi WiFi otomatis jika putus
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("⚠️  [WiFi] Terputus! Mencoba rekoneksi...");
    connectWifi();
    delay(1000);
    return;
  }

  // Tunggu kartu baru ditempelkan
  if (!rfid.PICC_IsNewCardPresent()) {
    delay(50);
    return;
  }
  if (!rfid.PICC_ReadCardSerial()) {
    delay(50);
    return;
  }

  // Baca UID → format HEX uppercase (contoh: "3A4F8B2C")
  String uid = "";
  for (byte i = 0; i < rfid.uid.size; i++) {
    if (rfid.uid.uidByte[i] < 0x10) uid += "0";
    uid += String(rfid.uid.uidByte[i], HEX);
  }
  uid.toUpperCase();

  // Debounce — abaikan kartu sama dalam 3 detik
  unsigned long now = millis();
  if (uid == lastUid && (now - lastTapTime < DEBOUNCE_MS)) {
    rfid.PICC_HaltA();
    rfid.PCD_StopCrypto1();
    return;
  }
  lastUid     = uid;
  lastTapTime = now;

  // Log ke Serial Monitor
  MFRC522::PICC_Type type = rfid.PICC_GetType(rfid.uid.sak);
  Serial.println("\n💳 [TAP TERDETEKSI]");
  Serial.println("  > Tipe Kartu : " + String(rfid.PICC_GetTypeName(type)));
  Serial.println("  > UID        : " + uid);
  Serial.print("  > Mengirim ke server... ");

  // Kirim ke server & proses respon
  String response = sendToServer(uid);

  if (response.indexOf("\"success\"") > -1 ||
      response.indexOf("SUCCESS") > -1) {
    Serial.println("  ✅ Absen BERHASIL!");
    soundSuccess();
  } else if (response.indexOf("already_checked") > -1 ||
             response.indexOf("ALREADY_CHECKED") > -1) {
    Serial.println("  ℹ️  Sudah absen sebelumnya.");
    soundWarning();
  } else if (response.indexOf("unregistered") > -1 ||
             response.indexOf("UNREGISTERED") > -1) {
    Serial.println("  ❌ e-KTP belum terdaftar di sistem.");
    soundError();
  } else if (response.indexOf("warning") > -1 ||
             response.indexOf("NO_ACTIVE_SESSION") > -1) {
    Serial.println("  ⚠️  Sesi Posyandu belum diaktifkan!");
    soundWarning();
  } else {
    Serial.println("  ❌ Respon tidak dikenali / gagal koneksi.");
    soundError();
  }

  // Selesai — siap kartu berikutnya
  rfid.PICC_HaltA();
  rfid.PCD_StopCrypto1();
  Serial.println("──────────────────────────────────────────────────────");
}
