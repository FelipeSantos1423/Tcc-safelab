#include <Wire.h>
#include <BH1750.h>
#include <DHT.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h> // Biblioteca para manipular JSON //ArduinoJson library
#include <math.h>

// ==================== CONFIGURAÇÕES WI-FI ====================
const char* ssid = "Maria Fernanda";           
const char* password = "casa31445519";     
const char* serverName = "http://192.168.5.8/tcc-safelab/tcc/API/api_recebe_leitura.php"; 
const char* codigo_esp = "ESP001";       

// ==================== PINOS ====================
const int micPin = 34;   // MAX9814 - entrada analógica
const int dhtPin = 2;   // DHT11 - pino de dados

// ==================== OBJETOS ====================
BH1750 lightMeter;
#define DHTTYPE DHT11
DHT dht(dhtPin, DHTTYPE);

// ==================== PARÂMETROS ====================
const int numAmostrasMAX = 1000;
const int coletaIntervalo = 10000; // intervalo de 10 segundos

// ==================== SETUP ====================
void setup() {
  Serial.begin(115200);
  delay(500);

  Serial.println("========================================");
  Serial.println("Iniciando sistema SafeLab...");
  Serial.println("========================================");

  // Conectar ao Wi-Fi
  WiFi.begin(ssid, password);
  Serial.print("🔌 Conectando ao Wi-Fi ");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\n✅ Conectado ao Wi-Fi!");
  Serial.print("📡 IP: ");
  Serial.println(WiFi.localIP());

  // Inicializar sensores
  Wire.begin(21, 22); // SDA=21, SCL=22
  delay(200);

  if (lightMeter.begin(BH1750::CONTINUOUS_HIGH_RES_MODE)) {
    Serial.println("✅ BH1750 inicializado com sucesso!");
  } else {
    Serial.println("❌ Falha ao inicializar BH1750!");
  }

  dht.begin();
  Serial.println("✅ DHT11 inicializado com sucesso!");

  analogSetAttenuation(ADC_11db);
  Serial.println("✅ MAX9814 pronto!");
}

// ==================== LOOP ====================
void loop() {
  Serial.println("========================================");
  Serial.println("📊 Coletando dados...");

  // -------- MAX9814 --------
  int val, minVal = 4095, maxVal = 0;
  for (int i = 0; i < numAmostrasMAX; i++) {
    val = analogRead(micPin);
    if (val > maxVal) maxVal = val;
    if (val < minVal) minVal = val;
  }
  float rms = (maxVal - minVal) / 2.0;
  float dB_rel = (rms / 2048.0) * 100.0;

  Serial.print("🎤 Ruído: ");
  Serial.print(dB_rel);
  Serial.println(" dB (relativo)");

  // -------- BH1750 --------
  float lux = lightMeter.readLightLevel();
  if (lux < 0) lux = 0;
  Serial.print("💡 Luminosidade: ");
  Serial.print(lux);
  Serial.println(" lx");

  // -------- DHT11 --------
  float temp = dht.readTemperature();
  float umid = dht.readHumidity();

  if (isnan(temp) || isnan(umid)) {
    Serial.println("❌ Erro lendo DHT11!");
    delay(coletaIntervalo);
    return;
  }

  Serial.print("🌡️ Temperatura: ");
  Serial.print(temp);
  Serial.print(" °C | 💧 Umidade: ");
  Serial.print(umid);
  Serial.println(" %");

  // ==================== ENVIO PARA O SERVIDOR ====================
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverName);
    http.addHeader("Content-Type", "application/json"); // importante: enviar JSON

    // Criar objeto JSON
    StaticJsonDocument<200> doc;
    doc["codigo_esp"] = codigo_esp;
    doc["temperatura"] = temp;
    doc["umidade"] = umid;
    doc["luz"] = lux;
    doc["ruido"] = dB_rel;

    String jsonStr;
    serializeJson(doc, jsonStr);

    Serial.println("📡 Enviando JSON para o servidor...");
    int httpResponseCode = http.POST(jsonStr);

    if (httpResponseCode > 0) {
      Serial.print("✅ Dados enviados! Código HTTP: ");
      Serial.println(httpResponseCode);
      String resposta = http.getString();
      Serial.println("📨 Resposta: " + resposta);
    } else {
      Serial.print("❌ Erro no envio! Código: ");
      Serial.println(httpResponseCode);
    }

    http.end();
  } else {
    Serial.println("⚠️ Sem conexão Wi-Fi, tentando reconectar...");
    WiFi.reconnect();
  }

  delay(coletaIntervalo);
}
