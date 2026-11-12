/*
 * ======================================================================================
 * PROYEK     : SMART RT & POSYANDU DIGITAL — TAP RFID e-KTP / KARTU WARGA
 * MIKROKONTROLER : NodeMCU ESP32 (ESP-WROOM-32 / 32D / 30-Pin & 38-Pin DevKit)
 * SENSOR RFID: MFRC522 (RC522) 13.56 MHz (Mendukung e-KTP Indonesia & Kartu Mifare)
 * DISPLAY    : LCD 16x2 via I2C Module (PCF8574 backpack — Alamat default 0x27 / 0x3F)
 * BACKEND    : E-KASRT → https://e-kasrt.unique-monsters.my.id
 * VERSI      : 3.0 (Production — HTTPS + Multi-WiFi Fallback + LCD 16x2 I2C)
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
 * ── SKEMA WIRING LCD 16x2 I2C ke ESP32 ─────────────────────────────────────────────
 *
 * PIN MODUL I2C LCD  PIN NODEMCU ESP32   WARNA KABEL   KETERANGAN
 * --------------------------------------------------------------------------------------
 * VCC               5V (VIN)            MERAH         LCD butuh 5V
 * GND               GND                 HITAM         Ground
 * SDA               GPIO 21 (D21)       BIRU          I2C Data
 * SCL               GPIO 22 (D22)       KUNING        I2C Clock
 *
 * ⚠️  CATATAN PENTING:
 *   • Modul I2C LCD biasanya sudah ada resistor pull-up bawaan — tidak perlu tambah.
 *   • Jika layar gelap/blank, putar trimpot biru di belakang modul I2C untuk kontras.
 *   • Jika alamat I2C tidak 0x27, coba 0x3F — atau jalankan I2C Scanner sketch dulu.
 *
 * ── PERHATIAN KONFLIK PIN ───────────────────────────────────────────────────────────
 *   • RC522 RST di GPIO 22 → SAMA dengan SCL I2C!
 *   • Solusi: Pindahkan RST RC522 ke GPIO 4, lalu update RST_PIN di bawah.
 *   • Atau gunakan pin RST GPIO 25 / GPIO 26 / GPIO 27 (bebas konflik)
 *
 *   REKOMENDASI WIRING FINAL (bebas konflik):
 *   RC522 RST  → GPIO 25     (ganti dari 22)
 *   LCD SDA    → GPIO 21
 *   LCD SCL    → GPIO 22
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
 *    - "LiquidCrystal I2C" by Frank de Brabander (v1.1.2)
 * 4. Upload Speed: 115200
 * 5. Serial Monitor: Baud 115200
 * ======================================================================================
 */

#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <WiFiClientSecure.h>
#include <SPI.h>
#include <MFRC522.h>

// ======================================================================================
// ★ KONFIGURASI — SESUAIKAN BAGIAN INI SEBELUM UPLOAD ★
// ======================================================================================

// ── WiFi Utama ───────────────────────────────────────────────────────────────
const char* WIFI_SSID_1     = "FATIMAH";
const char* WIFI_PASS_1     = "1819122024";

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
#define RST_PIN     25   // RST RC522 ← PINDAH ke GPIO 25 agar tidak konflik dengan SCL LCD (GPIO 22)
#define BUZZER_PIN  4    // Buzzer
#define LED_GREEN   15   // LED Hijau
#define LED_RED     13   // LED Merah

// I2C LCD — SDA: GPIO 21, SCL: GPIO 22 (default I2C ESP32)
// Ganti 0x27 → 0x3F jika layar tidak nyala (tergantung chip PCF8574 yang dipakai)
#define LCD_I2C_ADDR 0x27
#define LCD_COLS     16
#define LCD_ROWS     2

// ======================================================================================
// 3. INISIALISASI OBJEK
// ======================================================================================
MFRC522 rfid(SS_PIN, RST_PIN);
WiFiClientSecure secureClient;
LiquidCrystal_I2C lcd(LCD_I2C_ADDR, LCD_COLS, LCD_ROWS);
bool lcdAvailable = false;

// Kontrol debounce
unsigned long lastTapTime = 0;
String        lastUid     = "";
const unsigned long DEBOUNCE_MS = 2500; // 2.5 detik antara tap kartu yang sama

// ======================================================================================
// 4. KARAKTER CUSTOM LCD
// ======================================================================================
// Ikon centang ✓ (slot 0)
byte iconCheck[8] = {
  0b00000,
  0b00001,
  0b00011,
  0b10110,
  0b11100,
  0b01000,
  0b00000,
  0b00000
};

// Ikon silang ✗ (slot 1)
byte iconCross[8] = {
  0b00000,
  0b10001,
  0b01010,
  0b00100,
  0b01010,
  0b10001,
  0b00000,
  0b00000
};

// Ikon jam / kembali (slot 2) — untuk "sudah absen"
byte iconClock[8] = {
  0b01110,
  0b10101,
  0b10111,
  0b10001,
  0b01110,
  0b00000,
  0b00000,
  0b00000
};

// Ikon sinyal WiFi (slot 3)
byte iconWifi[8] = {
  0b00000,
  0b01110,
  0b10001,
  0b00100,
  0b01010,
  0b00000,
  0b00100,
  0b00000
};

// ======================================================================================
// 5. FUNGSI HELPER LCD (AMBIL PENANGANAN FAIL-SAFE AGAR TIDAK FREEZE)
// ======================================================================================

// Tampilkan 2 baris di LCD — otomatis padding spasi sampai 16 karakter
void lcdShow(const String& baris1, const String& baris2 = "") {
  if (!lcdAvailable) return;
  lcd.clear();
  lcd.setCursor(0, 0);
  String b1 = baris1; b1 = b1.substring(0, 16); // maks 16 karakter
  while (b1.length() < 16) b1 += " ";
  lcd.print(b1);

  lcd.setCursor(0, 1);
  String b2 = baris2; b2 = b2.substring(0, 16);
  while (b2.length() < 16) b2 += " ";
  lcd.print(b2);
}

// Tampilkan baris 1 & 2 dengan ikon custom di awal baris 1
void lcdShowIcon(byte iconSlot, const String& baris1, const String& baris2 = "") {
  if (!lcdAvailable) return;
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.write(iconSlot);  // cetak ikon
  lcd.print(" ");

  String b1 = baris1.substring(0, 14); // 1 ikon + 1 spasi = 2 char, sisa 14
  while (b1.length() < 14) b1 += " ";
  lcd.print(b1);

  lcd.setCursor(0, 1);
  String b2 = baris2.substring(0, 16);
  while (b2.length() < 16) b2 += " ";
  lcd.print(b2);
}

// Efek animasi loading dots di baris 2
void lcdLoading(const String& baris1, int dots = 3) {
  if (!lcdAvailable) return;
  lcd.clear();
  lcd.setCursor(0, 0);
  String b1 = baris1.substring(0, 16);
  while (b1.length() < 16) b1 += " ";
  lcd.print(b1);

  lcd.setCursor(0, 1);
  lcd.print("Mengirim");
  for (int i = 0; i < dots && i < 8; i++) {
    delay(250);
    lcd.print(".");
  }
}

// ======================================================================================
// 6. INDIKATOR SUARA & LAMPU
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
// 7. KONEKSI WIFI (Multi-SSID fallback)
// ======================================================================================
bool connectWifi() {
  WiFi.mode(WIFI_STA);

  // Coba WiFi Utama
  lcdShow("Konek WiFi...", String(WIFI_SSID_1).substring(0, 16));
  Serial.print("[WiFi] Mencoba SSID: "); Serial.println(WIFI_SSID_1);
  WiFi.begin(WIFI_SSID_1, WIFI_PASS_1);
  for (int i = 0; i < 20 && WiFi.status() != WL_CONNECTED; i++) {
    delay(500); Serial.print(".");
    // animasi titik di LCD
    lcd.setCursor(i % 16, 1);
    lcd.print(".");
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\n✅ [WiFi] Terhubung ke: " + String(WIFI_SSID_1));
    lcdShowIcon(3, "WiFi Terhubung!", String(WIFI_SSID_1).substring(0, 16));
    delay(1200);
    return true;
  }

  // Coba WiFi Cadangan
  WiFi.disconnect();
  Serial.print("\n[WiFi] Mencoba SSID cadangan: "); Serial.println(WIFI_SSID_2);
  lcdShow("Coba WiFi 2...", String(WIFI_SSID_2).substring(0, 16));
  WiFi.begin(WIFI_SSID_2, WIFI_PASS_2);
  for (int i = 0; i < 20 && WiFi.status() != WL_CONNECTED; i++) {
    delay(500); Serial.print(".");
    lcd.setCursor(i % 16, 1);
    lcd.print(".");
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\n✅ [WiFi] Terhubung ke: " + String(WIFI_SSID_2));
    lcdShowIcon(3, "WiFi Terhubung!", String(WIFI_SSID_2).substring(0, 16));
    delay(1200);
    return true;
  }

  Serial.println("\n❌ [WiFi] Semua SSID gagal! Periksa nama/password WiFi.");
  lcdShowIcon(1, "WiFi GAGAL!", "Cek SSID/pass");
  return false;
}

// ======================================================================================
// 8. KIRIM UID KE SERVER
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
// 9. PROSES RESPON SERVER & TAMPILKAN DI LCD
// ======================================================================================
// Fungsi ekstrak nilai JSON sederhana (tanpa library ArduinoJson)
// Contoh: extractJson("{\"nama\":\"Budi\"}", "nama") → "Budi"
String extractJson(const String& json, const String& key) {
  String searchKey = "\"" + key + "\":\"";
  int start = json.indexOf(searchKey);
  if (start == -1) return "";
  start += searchKey.length();
  int end = json.indexOf("\"", start);
  if (end == -1) return "";
  return json.substring(start, end);
}

void handleResponse(const String& response) {
  // ── BERHASIL ABSEN ────────────────────────────────────────────────────────────
  if (response.indexOf("\"success\"") > -1 ||
      response.indexOf("SUCCESS") > -1) {

    String nama = extractJson(response, "nama");
    if (nama.length() == 0) nama = "Warga";
    // Ambil 16 char pertama nama (muat di LCD)
    String namaLcd = nama.substring(0, 15);

    Serial.println("  ✅ Absen BERHASIL! Nama: " + nama);

    // LCD baris 1: ✓ Absen Berhasil
    // LCD baris 2: nama warga
    lcdShowIcon(0, "Absen Berhasil!", namaLcd);
    soundSuccess();

    delay(3000); // tampil 3 detik
  }

  // ── SUDAH ABSEN SEBELUMNYA ────────────────────────────────────────────────────
  else if (response.indexOf("already_checked") > -1 ||
           response.indexOf("ALREADY_CHECKED") > -1) {

    String nama = extractJson(response, "nama");
    if (nama.length() == 0) nama = "Warga";
    String namaLcd = nama.substring(0, 15);

    Serial.println("  ℹ️  Sudah absen sebelumnya. Nama: " + nama);

    lcdShowIcon(2, "Sudah Absen!", namaLcd);
    soundWarning();

    delay(3000);
  }

  // ── KARTU BELUM TERDAFTAR ─────────────────────────────────────────────────────
  else if (response.indexOf("unregistered") > -1 ||
           response.indexOf("UNREGISTERED") > -1) {

    Serial.println("  ❌ e-KTP belum terdaftar di sistem.");

    lcdShowIcon(1, "Tidak Terdaftar", "Hubungi Petugas");
    soundError();

    delay(3000);
  }

  // ── SESI POSYANDU BELUM AKTIF ─────────────────────────────────────────────────
  else if (response.indexOf("warning") > -1 ||
           response.indexOf("NO_ACTIVE_SESSION") > -1) {

    Serial.println("  ⚠️  Sesi Posyandu belum diaktifkan!");

    lcdShowIcon(2, "Sesi Belum Buka", "Tunggu Petugas");
    soundWarning();

    delay(3000);
  }

  // ── ERROR / TIMEOUT / RESPON TAK DIKENAL ──────────────────────────────────────
  else {
    Serial.println("  ❌ Respon tidak dikenali / gagal koneksi.");

    lcdShowIcon(1, "Koneksi Error!", "Coba Lagi...");
    soundError();

    delay(3000);
  }
}

// ======================================================================================
// 10. SETUP
// ======================================================================================
void setup() {
  Serial.begin(115200);
  delay(500);

  Serial.println("\n╔══════════════════════════════════════════════════════╗");
  Serial.println("║   SISTEM POSYANDU DIGITAL E-KASRT — v3.0 FAIL-SAFE   ║");
  Serial.println("║   ESP32 + RC522 RFID + LCD 16x2 I2C                  ║");
  Serial.println("╚══════════════════════════════════════════════════════╝");
  Serial.println("   Server  : " + String(SERVER_URL));
  Serial.println("   API Key : " + String(API_KEY));
  Serial.println();

  // ── Init pin output ──────────────────────────────────────────────────────────
  pinMode(BUZZER_PIN, OUTPUT);
  pinMode(LED_GREEN,  OUTPUT);
  pinMode(LED_RED,    OUTPUT);
  digitalWrite(LED_GREEN, LOW);
  digitalWrite(LED_RED,   LOW);

  // ── Deteksi I2C & LCD secara AMAN (Tidak akan hang bila LCD belum dicolok) ───
  Wire.begin(21, 22);
  Wire.setTimeOut(80);
  Wire.beginTransmission(LCD_I2C_ADDR);
  if (Wire.endTransmission() == 0) {
    lcdAvailable = true;
  } else {
    // Coba alamat alternatif 0x3F
    Wire.beginTransmission(0x3F);
    if (Wire.endTransmission() == 0) {
      lcdAvailable = true;
    }
  }

  if (lcdAvailable) {
    lcd.init();
    lcd.backlight();
    lcd.createChar(0, iconCheck);
    lcd.createChar(1, iconCross);
    lcd.createChar(2, iconClock);
    lcd.createChar(3, iconWifi);
    lcdShow(" E-KASRT v3.0 ", " Posyandu RFID");
    delay(1000);
    Serial.println("✅ [LCD] Layar LCD 16x2 I2C terdeteksi dan aktif!");
  } else {
    Serial.println("ℹ️  [LCD] Modul LCD I2C tidak terdeteksi (sistem tetap jalan via RFID).");
  }

  // ── Init SPI & RC522 RFID ────────────────────────────────────────────────────
  SPI.begin(); // SCK=18, MISO=19, MOSI=23, SS=5
  rfid.PCD_Init();
  delay(100);

  byte ver = rfid.PCD_ReadRegister(rfid.VersionReg);
  Serial.print("[RC522] Register Version: 0x"); Serial.println(ver, HEX);

  // Jika belum terbaca, coba init ulang dengan gain antena maksimal
  if (ver == 0x00 || ver == 0xFF) {
    Serial.println("⚠️  [RC522] Chip RFID belum terdeteksi (0x00/0xFF). Mencoba reset ulang pin...");
    pinMode(RST_PIN, OUTPUT);
    digitalWrite(RST_PIN, LOW);
    delay(50);
    digitalWrite(RST_PIN, HIGH);
    delay(50);
    rfid.PCD_Init();
    delay(100);
    ver = rfid.PCD_ReadRegister(rfid.VersionReg);
    Serial.print("[RC522] Register Version Coba 2: 0x"); Serial.println(ver, HEX);
  }

  if (ver == 0x00 || ver == 0xFF) {
    Serial.println("❌ [RC522] SENSOR RFID GAGAL TERDETEKSI!");
    Serial.println("   Periksa kabel: 3V3, GND, D5 (SDA), D25 (RST), D19 (MISO), D23 (MOSI), D18 (SCK)");
    soundError();
    if (lcdAvailable) lcdShowIcon(1, "RFID Error!", "Cek Kabel SPI");
  } else {
    Serial.println("✅ [RC522] Sensor RFID SUKSES TERDETEKSI & SIAP MEMBACA KARTU!");
    rfid.PCD_SetAntennaGain(rfid.RxGain_max); // Maksimalkan jarak baca antena
    if (lcdAvailable) lcdShowIcon(0, "RFID Siap!", "");
    delay(500);
  }

  // ── Koneksi WiFi ─────────────────────────────────────────────────────────────
  if (connectWifi()) {
    soundStartup();
  } else {
    soundError();
  }

  // ── Standby screen ───────────────────────────────────────────────────────────
  lcdShow("> Tempel Kartu <", " e-KTP / RFID  ");
  Serial.println("\n[STANDBY] Silakan tempelkan e-KTP atau Kartu ke sensor RFID sekarang...");
  Serial.println("──────────────────────────────────────────────────────");
}

// ======================================================================================
// 11. LOOP UTAMA
// ======================================================================================
void loop() {
  // Rekoneksi WiFi otomatis jika putus
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("⚠️  [WiFi] Terputus! Mencoba rekoneksi...");
    lcdShow("WiFi Terputus!", "Reconnecting...");
    connectWifi();
    delay(1000);

    // Kembali ke standby jika sudah reconnect
    if (WiFi.status() == WL_CONNECTED) {
      lcdShow("> Tempel Kartu <", " e-KTP / RFID  ");
    }
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

  // LCD: tampilkan UID saat sedang kirim ke server
  String uidShort = uid.substring(0, 12);
  lcdShow("Memproses...", uidShort);

  // Kirim ke server & proses respon
  String response = sendToServer(uid);

  // Proses respon + tampil di LCD
  handleResponse(response);

  // Selesai — kembali ke standby
  rfid.PICC_HaltA();
  rfid.PCD_StopCrypto1();
  lcdShow("> Tempel Kartu <", " e-KTP / RFID  ");
  Serial.println("──────────────────────────────────────────────────────");
}
