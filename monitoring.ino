#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
WiFiClient client;

#include "DHT.h"
#define DHTPIN D8
#define DHTTYPE DHT11   // DHT 11
DHT dht(DHTPIN, DHTTYPE);

/* Set these to your desired credentials. */
const char *ssid = "Andriyan's Galaxy A33 5G";  
const char *password = "aaaaaaaa";

//Web/Server address to read/write from 
const char *host = "kandangayam.komputasi.org";   //https://circuits4you.com website or IP address of server

// Relay control pin
const int relayPin = D7;  // Change this to the pin connected to your relay

//=======================================================================
//                    Power on setup
//=======================================================================
void setup() {
  dht.begin();
  pinMode(relayPin, OUTPUT);
  digitalWrite(relayPin, LOW);  // Turn off the relay initially
  delay(1000);

  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);        //This line hides the viewing of ESP as wifi hotspot
  Serial.begin(9600);
  WiFi.begin(ssid, password);     //Connect to your WiFi router
  Serial.println("");

  Serial.print("Connecting");
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  // If connection successful, show IP address in the serial monitor
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  //IP address assigned to your ESP
}

//=======================================================================
//                    Main Program Loop
//=======================================================================
void loop() {
  HTTPClient http;    // Declare object of class HTTPClient
  String postData, suhu, kelembapan, link;

  float humidity = dht.readHumidity();
  float temperature = dht.readTemperature();

  suhu = String(temperature);   // String to integer conversion
  kelembapan = String(humidity);   // String to integer conversion

  // Post Data
  postData = "&status1=" + suhu + "&status2=" + kelembapan;
  link = "http://kandangayam.komputasi.org/postdemo.php";

  http.begin(client, link);  // Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");  // Specify content-type header

  int httpCode = http.POST(postData);  // Send the request
  String payload = http.getString();  // Get the response payload

  Serial.println(httpCode);   // Print HTTP return code
  Serial.println(payload);    // Print request response payload

  // Control the relay based on the temperature
  if (temperature < 28) {
    digitalWrite(relayPin, HIGH);  // Turn on the relay
    Serial.println("Relay is ON");
  } else {
    digitalWrite(relayPin, LOW);  // Turn off the relay
    Serial.println("Relay is OFF");
  }

  http.end();  // Close connection

  delay(10000);  // Post Data every 10 seconds
}
//=======================================================================
