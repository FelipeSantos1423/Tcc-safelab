#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>
#include <DHT.h>

// ==================== CONFIGURAÇÕES WI-FI ====================
const char* ssid = "Maria Fernanda";
const char* password = "casa31445519";
const char* serverName = "http://192.168.5.8/tcc-safelab/tcc/API/api_recebe_leitura.php";
const char* codigo_esp = "ESP001";

// ==================== PINOS ====================
const int dhtPin = 2;

// ==================== OBJETOS ====================
#define DHTTYPE DHT11
DHT dht(dhtPin, DHTTYPE);

// ==================== PARÂMETROS ====================
const int coletaIntervalo = 10000; // 10 segundos

// ==================== SETUP ====================
void setup() {
  Serial.begin(115200);
  delay(500);

  Serial.println("========================================");
  Serial.println("Iniciando sistema SafeLab...");
  Serial.println("========================================");

  // Conectar ao Wi-Fi
  WiFi.begin(ssid, password);
  Serial.print("Conectando ao Wi-Fi ");

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nConectado ao Wi-Fi!");
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());

  // Inicializar DHT11
  dht.begin();
  Serial.println("DHT11 inicializado com sucesso!");
}

// ==================== LOOP ====================
void loop() {
  Serial.println("========================================");
  Serial.println("Coletando dados...");

  // -------- DHT11 --------
  float temp = dht.readTemperature();
  float umid = dht.readHumidity();

  if (isnan(temp) || isnan(umid)) {
    Serial.println("Erro lendo DHT11!");
    delay(coletaIntervalo);
    return;
  }

  Serial.print("Temperatura: ");
  Serial.print(temp);
  Serial.print(" °C | Umidade: ");
  Serial.print(umid);
  Serial.println(" %");

  // ==================== ENVIO PARA O SERVIDOR ====================
  if (WiFi.status() == WL_CONNECTED) {

    HTTPClient http;
    http.begin(serverName);
    http.addHeader("Content-Type", "application/json");

    StaticJsonDocument<200> doc;
    doc["codigo_esp"] = codigo_esp;
    doc["temperatura"] = temp;
    doc["umidade"] = umid;

    String jsonStr;
    serializeJson(doc, jsonStr);

    Serial.println("Enviando JSON para o servidor...");
    int httpResponseCode = http.POST(jsonStr);

    if (httpResponseCode > 0) {
      Serial.print("Dados enviados! Código HTTP: ");
      Serial.println(httpResponseCode);

      String resposta = http.getString();
      Serial.println("Resposta: " + resposta);
    } else {
      Serial.print("Erro no envio! Código: ");
      Serial.println(httpResponseCode);
    }

    http.end();

  } else {
    Serial.println("Sem conexão Wi-Fi. Tentando reconectar...");
    WiFi.reconnect();
  }

  delay(coletaIntervalo);
}