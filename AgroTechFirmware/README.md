# AgroTech: ESP32 and BME280 Wi-Fi Sensor

AgroTech is a project that demonstrates a simple example of a WiFi-enabled BME280 sensor using an ESP32 or ESP8266 microcontroller. The project focuses on gathering temperature, humidity, and pressure readings from the BME280 sensor and sending them to a server using HTTP POST requests.

## Repository Structure
The repository contains the following files:

1. `bme280.ino`: The main Arduino sketch that runs on the ESP32 or ESP8266 microcontroller. It includes the necessary code for connecting to Wi-Fi, initializing the BME280 sensor, and sending sensor readings to the server.

## Installation

1. Clone the repository: `git clone https://github.com/Arahat002/AgroTech.git`
2. Open the `bme280.ino` file in the Arduino IDE.
3. Configure the sketch with your Wi-Fi credentials and server details.
4. Compile and upload the sketch to your ESP32 or ESP8266 microcontroller.


## Prerequisites

- Arduino IDE
- Libraries:
  - Adafruit BME280 (https://github.com/adafruit/Adafruit_BME280_Library)
  - ESP8266WiFi (for ESP8266) or WiFi (for ESP32)
  - HTTPClient (for ESP8266) or WiFiClient and HTTPClient (for ESP32)

## Hardware Setup

- Connect the BME280 sensor to the microcontroller:
  - ESP32:
    - SDA: Connect to the SDA pin of the ESP32
    - SCL: Connect to the SCL pin of the ESP32
  - ESP8266:
    - SDA: Connect to the SDA pin of the ESP8266
    - SCL: Connect to the SCL pin of the ESP8266
- Connect the moisture sensor:
  - Connect the AOUT pin of the moisture sensor to pin 36 (ADC0) of the ESP32.

## Usage

1. Replace the following placeholders in the code:
   - `<Your Network SSID>`: Replace with your WiFi network name.
   - `<Your Network Password>`: Replace with your WiFi network password.
   - `<Your Server Name>`: Replace with your server's domain name or IP address with the appropriate path.
   - `<Your API Key>`: Replace with the API key for your server.
2. Upload the code to your ESP32 or ESP8266 board using the Arduino IDE.
3. Open the serial monitor at a baud rate of 9600 to view the sensor readings and WiFi connection status.
4. The sensor readings will be sent to the server every 30 seconds via HTTP POST requests.

## License

This project is licensed under the [Apache License 2.0](LICENSE).


