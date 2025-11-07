#include <WiFi.h>
#include <HTTPClient.h>
#include <Wire.h>
#include <BH1750.h>
#include <DHT.h>

#define DHTTYPE DHT11
const int dhtPin = 25;
const int micPin = 34;

const char* ssid = "Maria Fernanda";
const char* password = "casa31445519";

// URL do endpoint PHP que recebe os dados (mude para seu IP/rota)
const char* serverHost = "http://192.168.0.100/tcc/process/ingest.php";

BH1750 lightMeter;
DHT dht(dhtPin, DHTTYPE);

void setup() {
  Serial.begin(115200);
  delay(500);

  WiFi.begin(ssid, password);
  Serial.print("Conectando WiFi...");
  while (WiFi.status() != WL_CONNECTED) {
    delay(300);
    Serial.print(".");
  }
  Serial.println();
  Serial.print("Conectado. IP: ");
  Serial.println(WiFi.localIP());

  Wire.begin(21,22);
  lightMeter.begin(BH1750::CONTINUOUS_HIGH_RES_MODE);
  dht.begin();
  analogSetPinAttenuation(micPin, ADC_11db);
}

float readNoiseRms(int samples = 200) {
  int val;
  int minVal = 4095, maxVal = 0;
  for (int i=0;i<samples;i++){
    val = analogRead(micPin);
    if (val > maxVal) maxVal = val;
    if (val < minVal) minVal = val;
    delay(2);
  }
  float rms = (maxVal - minVal) / 2.0;
  return rms;
}

void loop() {
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("WiFi desconectado. Tentando reconectar...");
    WiFi.reconnect();
    delay(1000);
    return;
  }

  float lux = lightMeter.readLightLevel(); // lux
  float temp = dht.readTemperature(); // C
  float umid = dht.readHumidity(); // %
  float ruido = readNoiseRms(); // valor relativo

  // ID do dispositivo (preencha com o id que está no banco)
  int dispositivo_id = 7;

  // monta JSON
  String json = "{";
  json += "\"dispositivo_id\": " + String(dispositivo_id) + ",";
  json += "\"temperatura\": " + String(temp, 2) + ",";
  json += "\"umidade\": " + String(umid, 2) + ",";
  json += "\"luz\": " + String(lux, 2) + ",";
  json += "\"ruido\": " + String(ruido, 2);
  json += "}";

  Serial.println("Enviando: " + json);

  HTTPClient http;
  http.begin(serverHost);
  http.addHeader("Content-Type", "application/json");

  int httpCode = http.POST(json);
  String payload = http.getString();
  Serial.print("HTTP code: ");
  Serial.println(httpCode);
  Serial.print("Resposta: ");
  Serial.println(payload);

  http.end();

  delay(10000); // intervalo 10s (ou altere)
}
