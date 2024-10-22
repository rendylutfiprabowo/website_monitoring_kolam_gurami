#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <OneWire.h>
#include <DallasTemperature.h>

// Inisialisasi LCD I2C (alamat 0x27)
LiquidCrystal_I2C lcd(0x27, 20, 4);

// Wi-Fi credentials
const char * ssid = "339 Caffee & Eatery 2";
const char * pass = "39coffee";

// Host untuk server pengumpulan data
const char* host = "192.168.68.104"; // Sesuaikan dengan alamat IP server Anda

// Definisi pin I2C SDA dan SCL
#define I2C_SDA 21
#define I2C_SCL 22

// Inisialisasi sensor OneWire dan DallasTemperature
const int oneWireBus = 15;
OneWire oneWire(oneWireBus);
DallasTemperature sensors(&oneWire);

// Definisi pin sensor pH dan TDS
#define PH_PIN 34
#define VREF 3.3 // Menggunakan referensi tegangan sesuai dengan ESP32
float pHOffset = 0.0;
#define TdsSensorPin 27

void setup() {
  Serial.begin(115200);

  lcd.begin(); // Jika perlu, gunakan init() jika begin() tidak efektif
  lcd.backlight();
  lcd.setCursor(0, 0);
  lcd.print("System Ready");
  delay(2000);
  lcd.clear();

  sensors.begin();

  Serial.println("Connecting to Wi-Fi...");
  WiFi.begin(ssid, pass);
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }
  Serial.println("Connected!");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  sensors.requestTemperatures(); 
  float temperatureC = sensors.getTempCByIndex(0); 

  int analogValuePH = analogRead(PH_PIN);
  float voltagePH = analogValuePH * (VREF / 4095.0);
  float pHValue = 3.5 * voltagePH + pHOffset;

  int tdsValue = analogRead(TdsSensorPin);
  float tds = ((0.5406 * tdsValue) + 125.74);
  tds = max(tds, 0.0f); // Memastikan TDS tidak negatif

  int sensorValueMQ135 = analogRead(32);
  float voltageMQ135 = (VREF * sensorValueMQ135) / 4095.0; // Menggunakan VREF yang sesuai
  float ammonia = (-0.3335 * pow(voltageMQ135, 3)) + (-0.2473 * pow(voltageMQ135, 2)) + (0.982 * voltageMQ135) + 0.8953;
  ammonia = max(ammonia, 0.0f); // Pastikan amonia tidak negatif

  // Update LCD
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("pH: ");
  lcd.print(pHValue, 2);
  lcd.setCursor(0, 1);
  lcd.print("TDS: ");
  lcd.print(tds, 0);
  lcd.setCursor(0, 2);
  lcd.print("NH3: ");
  lcd.print(ammonia, 2);
  lcd.setCursor(0, 3);
  lcd.print("Temp: ");
  lcd.print(temperatureC, 1);
  lcd.print(" C");

  // Kirim data ke server
  WiFiClient client;
  if (!client.connect(host, 80)) {
    Serial.println("Connection failed!");
    return;
  }

  String url = "http://" + String(host) + "/monitoring/api/receive_data.php?suhu=" + String(temperatureC) + "&amonia=" + String(ammonia) + "&tds=" + String(tds) + "&ph=" + String(pHValue);
  HTTPClient http;
  http.begin(url);
  int httpCode = http.GET();

  if (httpCode > 0) {
    String response = http.getString();
    Serial.println("Response: " + response);
  } else {
    Serial.println("Error on HTTP request");
  }
  http.end();

  delay(3000); // Delay sebelum loop berikutnya
}
