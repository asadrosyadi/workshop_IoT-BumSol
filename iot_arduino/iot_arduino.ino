#include <Wire.h>
#include "esp_http_server.h"
#include <WiFiManager.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

#include "DHT.h"

#define DHTPIN 14
#define DHTTYPE DHT22
DHT dht (DHTPIN, DHTTYPE);

const int lampu = 26;
const int GAS = 34;
int ADC_gas = 0;

String linkGET = "http://192.168.1.20/iot/rest/bacajason/"; // sesuaikan dengan IP laptop masing*
String kirim_server = "http://192.168.1.20/iot/rest/kirimdatasensor"; // sesuaikan dengan IP laptop masing*

void setup() {
  Serial.begin(115200);
  dht.begin();
  pinMode(lampu, OUTPUT);

  // WiFiManager
  WiFi.mode(WIFI_STA);
  WiFiManager wifiManager;
  wifiManager.autoConnect("IoT Bumi Solawat");

  // Set device as a Wi-Fi Station
  Serial.println("Terhubung ke WiFi!");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  baca_kirim_sensor();
  baca_jason();
}

void baca_kirim_sensor(){
  float h = dht.readHumidity();
  float t = dht.readTemperature();


  if (isnan (h) || isnan(t)){
    Serial.print(F("Gagal Mendapatkan nilai suhu dan kelembapan"));
    return;
  }
    Serial.print("Kelembapan: ");
    Serial.println(h);

    Serial.print("Suhu: ");
    Serial.println(t);

    ADC_gas = analogRead(GAS);
    Serial.println(ADC_gas);

    // Kirim data sensor
  if(WiFi.status()== WL_CONNECTED){
      HTTPClient http;
      String serverPath = kirim_server + "?&&suhu=" + t + "&&kelembapan=" + h + "&&gas=" + ADC_gas;
      // Your Domain name with URL path or IP address with path
      http.begin(serverPath.c_str());
      // Send HTTP GET request
      int httpResponseCode = http.GET();
      if (httpResponseCode>0) {
        //Serial.print("HTTP Response code: ");
        //Serial.println(httpResponseCode);
        String payload = http.getString();
        //Serial.println(payload);
      }
      else {
        //Serial.print("Error code: ");
        //Serial.println(httpResponseCode);
      }
      // Free resources
      http.end();
    }
       // else {Serial.println("WiFi Disconnected");}
}

void baca_jason(){
  // Mengambil Data Jason
  // Buat koneksi HTTP
  HTTPClient http;
  http.begin(linkGET);

  // Lakukan permintaan GET
  int httpCode = http.GET();

  // Jika permintaan berhasil
  if (httpCode == HTTP_CODE_OK) {
    String payload = http.getString();
    //Serial.println(payload);

    // Parse data JSON
    DynamicJsonDocument doc(4096);
    deserializeJson(doc, payload);
    JsonObject data = doc["Data"][0];

    // Ambil data yang diperlukan
    String LED = data["LED"];

//Led
if (LED == "ON"){
  digitalWrite(lampu, HIGH);
  Serial.println("ON");
  }
else {
  digitalWrite(lampu, LOW);
  Serial.println("OFF");
  }
  } else {
    Serial.println("Gagal melakukan permintaan HTTP");
  }
  http.end();  // Putuskan koneksi HTTP
}