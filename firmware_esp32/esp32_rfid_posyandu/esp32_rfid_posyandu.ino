/*
 * ======================================================================================
 * PROYEK     : SMART RT & POSYANDU DIGITAL — TAP RFID e-KTP / KARTU WARGA
 * MIKROKONTROLER : NodeMCU ESP32 (ESP-WROOM-32 / 32D / 30-Pin & 38-Pin DevKit)
 * SENSOR RFID: MFRC522 (RC522) 13.56 MHz (Mendukung e-KTP Indonesia & Kartu Mifare)
 * BACKEND    : E-KASRT Sistem Informasi Keuangan & Layanan Warga RT
 * ======================================================================================
 * 
 * ── SKEMA WIRING & REKOMENDASI WARNA KABEL ──────────────────────────────────────────
 * 
 * PIN RC522 (RFID)   PIN NODEMCU ESP32   WARNA KABEL   KETERANGAN
 * --------------------------------------------------------------------------------------
 * VCC (3.3V)        3V3                 MERAH         Wajib 3.3V (JANGAN KE 5V/VIN!)
 * RST               GPIO 22 (D22)       PUTIH / UNGU  Reset Pin
 * GND               GND                 HITAM         Ground Daya
 * MISO              GPIO 19 (D19)       HIJAU         SPI Master In Slave Out
 * MOSI              GPIO 23 (D23)       BIRU          SPI Master Out Slave In
 * SCK               GPIO 18 (D18)       KUNING        SPI Serial Clock
 * SDA (SS)          GPIO 5  (D5)        ORANYE        SPI Slave Select / Chip Select
 * IRQ               (TIDAK TERHUBUNG)   -             Biarkan kosong
 * 
 * ── KOMPONEN INDIKATOR TAMBAHAN (OPSIONAL) ──────────────────────────────────────────
 * Buzzer (+)        GPIO 4  (D4)        KUNING        Nada Beep Tap Berhasil / Gagal
 * Buzzer (-)        GND                 HITAM         Ground
 * LED Hijau (+)     GPIO 15 (D15)       HIJAU         Indikator e-KTP Terdaftar & Sukses
 * LED Merah (+)     GPIO 13 (D13)       MERAH         Indikator Kartu Belum Terdaftar
 * Katoda LED (-)    GND (via R 220Ω)    HITAM         Resistor 220 Ohm ke Ground
 * 
 * ======================================================================================
 * PANDUAN ARDUINO IDE:
 * 1. Tambahkan Board ESP32: Tools -> Board -> Boards Manager -> cari "esp32" by Espressif.
 * 2. Install Library: Sketch -> Include Library -> Manage Libraries:
 *    - "MFRC522" by GithubCommunity (Versi terbaru)
 * 3. Pilih Board: "ESP32 Dev Module" atau "DOIT ESP32 DEVKIT V1".
 * 4. Upload Speed: 921600 atau 115200.
 * ======================================================================================
 */

#include <WiFi.h>
#include <HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>

// ======================================================================================
// 1. PENGATURAN KONEKSI WIFI & SERVER
// ======================================================================================

// Ganti dengan Nama dan Password WiFi / Hotspot HP Anda
const char* ssid     = "NAMA_WIFI_ANDA";
const char* password = "PASSWORD_WIFI_ANDA";

// URL Endpoint Server E-KASRT
// Jika Server di Komputer Lokal (XAMPP / Laragon):
// Ganti 192.168.1.10 dengan IP lokal Komputer/Laptop Anda (cek via 'ipconfig' di CMD).
// Pastikan ESP32 dan Laptop terhubung ke WiFi / Hotspot yang SAMA!
//
// Jika Server di VPS / Hosting Publik:
// Contoh: "http://43.157.230.29/kasrt/smartrt/posyandu_rfid_tap" atau nama domain Anda.
const char* serverUrl = "http://192.168.1.10/kasrt/smartrt/posyandu_rfid_tap";

// API Key Pengaman Sistem E-KASRT (Wajib cocok dengan backend di SmartRT.php)
const char* apiKey    = "kasrt2025";

// ======================================================================================
// 2. DEFINISI PINOUT HARDWARE
// ======================================================================================
#define SS_PIN      5   // SDA / SS (RC522)
#define RST_PIN     22  // RST (RC522)
#define BUZZER_PIN  4   // Buzzer Aktif / Pasif
#define LED_GREEN   15  // LED Hijau (Absen Berhasil)
#define LED_RED     13  // LED Merah (Gagal / Belum Terdaftar)

// Objek RFID MFRC522
MFRC522 rfc(SS_PIN, RST_PIN);

// Variabel Kontrol Debounce (Mencegah tap ganda tidak sengaja)
unsigned long lastTapTime = 0;
String lastUid = "";

// ======================================================================================
// 3. FUNGSI INDIKATOR SUARA & LAMPU
// ======================================================================================

// Nada Beep Sukses (2x nada tinggi ceria)
void soundSuccess() {
  digitalWrite(LED_GREEN, HIGH);
  tone(BUZZER_PIN, 2000, 100);
  delay(120);
  tone(BUZZER_PIN, 2500, 200);
  delay(250);
  digitalWrite(LED_GREEN, LOW);
}

// Nada Beep Peringatan / Error (1x nada rendah panjang)
void soundWarning() {
  digitalWrite(LED_RED, HIGH);
  tone(BUZZER_PIN, 800, 350);
  delay(400);
  digitalWrite(LED_RED, LOW);
}

// Nada Saat ESP32 Baru Nyala & Siap
void soundStartup() {
  tone(BUZZER_PIN, 1500, 80);
  delay(100);
  tone(BUZZER_PIN, 2200, 120);
  delay(150);
}

// ======================================================================================
// 4. SETUP SISTEM
// ======================================================================================
void setup() {
  Serial.begin(115200);
  delay(1000);
  
  Serial.println("\n========================================================");
  Serial.println("  SISTEM POSYANDU & LAYANAN WARGA DIGITAL E-KASRT       ");
  Serial.println("  Mikrokontroler: NodeMCU ESP32-WROOM-32D               ");
  Serial.println("  Modul RFID    : MFRC522 (RC522 13.56 MHz)             ");
  Serial.println("========================================================");

  // Inisialisasi Pin Output
  pinMode(BUZZER_PIN, OUTPUT);
  pinMode(LED_GREEN, OUTPUT);
  pinMode(LED_RED, OUTPUT);
  digitalWrite(LED_GREEN, LOW);
  digitalWrite(LED_RED, LOW);

  // Inisialisasi Bus SPI & Modul RC522
  SPI.begin();
  rfc.PCD_Init();
  delay(50);
  
  // Periksa versi firmware modul RC522
  byte v = rfc.PCD_ReadRegister(rfc.VersionReg);
  Serial.print("[RC522] Versi Chip: 0x");
  Serial.println(v, HEX);
  if (v == 0x00 || v == 0xFF) {
    Serial.println("⚠️ [PERINGATAN] RC522 tidak terdeteksi! Periksa kembali kabel wiring.");
    soundWarning();
  } else {
    Serial.println("✅ [RC522] Modul terdeteksi & siap membaca kartu!");
  }

  // Menghubungkan ke Jaringan WiFi
  Serial.print("[WiFi] Menghubungkan ke SSID: ");
  Serial.println(ssid);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  int attempt = 0;
  while (WiFi.status() != WL_CONNECTED && attempt < 30) {
    delay(500);
    Serial.print(".");
    attempt++;
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\n✅ [WiFi] Berhasil Terhubung!");
    Serial.print("   IP ESP32   : ");
    Serial.println(WiFi.localIP());
    Serial.print("   Server URL : ");
    Serial.println(serverUrl);
    soundStartup();
  } else {
    Serial.println("\n❌ [WiFi] Gagal terhubung ke WiFi! Periksa SSID & Password.");
    soundWarning();
  }

  Serial.println("\n[STANDBY] Silakan tempelkan e-KTP atau Kartu RFID ke sensor...");
  Serial.println("--------------------------------------------------------");
}

// ======================================================================================
// 5. LOOP UTAMA
// ======================================================================================
void loop() {
  // Cek koneksi WiFi berkala; sambungkan ulang jika terputus
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("⚠️ [WiFi] Koneksi terputus! Mencoba rekoneksi...");
    WiFi.reconnect();
    delay(1000);
    return;
  }

  // 1. Cek apakah ada kartu baru di dekat sensor
  if (!rfc.PICC_IsNewCardPresent()) {
    delay(50);
    return;
  }

  // 2. Baca serial UID dari kartu
  if (!rfc.PICC_ReadCardSerial()) {
    delay(50);
    return;
  }

  // 3. Ekstrak UID kartu ke dalam format string HEX (Huruf Besar, contoh: "3A4F8B2C")
  String uid = "";
  for (byte i = 0; i < rfc.uid.size; i++) {
    if (rfc.uid.uidByte[i] < 0x10) {
      uid += "0";
    }
    uid += String(rfc.uid.uidByte[i], HEX);
  }
  uid.toUpperCase();

  // 4. Debounce Filter (Kartu yang sama tidak boleh trigger berulang dalam jeda 3 detik)
  if (uid == lastUid && (millis() - lastTapTime < 3000)) {
    rfc.PICC_HaltA();
    rfc.PCD_StopCrypto1();
    return;
  }

  lastUid = uid;
  lastTapTime = millis();

  Serial.println("\n[TAP TERDETEKSI] 💳 Kartu Ditempelkan!");
  Serial.print("  > Tipe Kartu : ");
  MFRC522::PICC_Type piccType = rfc.PICC_GetType(rfc.uid.sak);
  Serial.println(rfc.PICC_GetTypeName(piccType));
  Serial.print("  > UID Kartu  : ");
  Serial.println(uid);

  // 5. Kirim UID ke Backend E-KASRT via HTTP POST
  HTTPClient http;
  http.begin(serverUrl);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  String postData = "api_key=" + String(apiKey) + "&uid=" + uid;
  
  Serial.print("  > Mengirim ke Server... ");
  int httpResponseCode = http.POST(postData);

  if (httpResponseCode > 0) {
    String response = http.getString();
    Serial.print("Status: ");
    Serial.println(httpResponseCode);
    Serial.println("  > Respon Web: " + response);

    // HTTP 200 = Sukses Terabsen / Dikenali
    if (httpResponseCode == 200) {
      Serial.println("  ✅ SUKSES: Warga / Balita terabsen!");
      soundSuccess();
    } else {
      // HTTP 404 / 400 / 403 = Kartu belum terdaftar atau sesi tidak aktif
      Serial.println("  ⚠️ PERHATIAN: Kartu belum terdaftar atau sesi belum aktif!");
      soundWarning();
    }
  } else {
    Serial.print("GAGAL KONEKSI! Kode Error: ");
    Serial.println(http.errorToString(httpResponseCode).c_str());
    soundWarning();
  }
  http.end();

  // 6. Matikan komunikasi kartu untuk siap membaca kartu berikutnya
  rfc.PICC_HaltA();
  rfc.PCD_StopCrypto1();
  Serial.println("--------------------------------------------------------");
}

