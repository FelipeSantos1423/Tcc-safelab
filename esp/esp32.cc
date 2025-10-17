#include <WiFi.h>
#include <HTTPClient.h>
#include "DHT.h"

// Credenciais WiFi
const char* ssid = "SUA_REDE_WIFI";
const char* password = "SUA_SENHA_WIFI";

// URL do PHP no servidor
const char* serverName = "http://SEU_SERVIDOR/salvar.php";

// Configuração do sensor DHT
#define DHTPIN 4      // Pino do DHT22
#define DHTTYPE DHT22 // Pode ser DHT11 também
DHT dht(DHTPIN, DHTTYPE);

// Sensores analógicos
int ldrPin = 34;   // Ajuste conforme seu circuito
int micPin = 35;   // Ajuste conforme seu circuito

void setup() {
  Serial.begin(115200);
  dht.begin();

  // Conectar WiFi
  WiFi.begin(ssid, password);
  Serial.print("Conectando ao WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nWiFi conectado!");
}

void loop() {
  // Ler sensores
  float temperatura = dht.readTemperature();
  float umidade = dht.readHumidity();
  int luz = analogRead(ldrPin);
  int ruido = analogRead(micPin);

  // Verificação básica
  if (isnan(temperatura) || isnan(umidade)) {
    Serial.println("Erro ao ler o DHT!");
    return;
  }

  // Montar JSON
  String json = "{\"temperatura\": " + String(temperatura, 2) +
                ", \"umidade\": " + String(umidade, 2) +
                ", \"luz\": " + String(luz) +
                ", \"ruido\": " + String(ruido) + "}";

  Serial.println("Enviando JSON: " + json);

  // Enviar para o servidor
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverName);
    http.addHeader("Content-Type", "application/json");

    int httpResponseCode = http.POST(json);

    if (httpResponseCode > 0) {
      Serial.print("Resposta do servidor: ");
      Serial.println(httpResponseCode);
      String payload = http.getString();
      Serial.println("Resposta: " + payload);
    } else {
      Serial.print("Erro ao enviar POST: ");
      Serial.println(httpResponseCode);
    }

    http.end();
  }

  // Espera antes da próxima leitura (5s)
  delay(5000);
}
