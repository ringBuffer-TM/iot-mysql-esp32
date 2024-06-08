# iot-mysql-esp32
In this project you will learn how to get data from an ESP32 sensors data and storing them to a MySQL data base and displaying through a web interface and also sending command signal through a web interface also .

# Hardware needed for this project 
Our main focuse is to impliment this technique which is suppervising/controling and ESP32 I/O via a web interface .
So in this project we kept it simple !
We just use  : 

**ESP32 

**DHT11/DHT22 to get the data from

**2 LED's with 2 1.5 kOhm resistors to just send commands to the ESP32 via the web .

# Software needed for the implementation 
## WEB SIDE 
**XAMPP for localhost developement 

**VSCODE with live server plugin installed (optional but to make life easier)

## ESP32 SIDE
** Arduino IDE 

Install the following libraries 

```bash 
#include <WiFi.h>
#include <HTTPClient.h>
#include <Arduino_JSON.h>
#include <DHT.h>
```




