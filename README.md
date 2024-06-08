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

#How it works ?

![git_esp32](https://github.com/ringBuffer-TM/iot-mysql-esp32/assets/172147591/e6e31446-5ade-43c0-b845-2efa24561885)

#SQL part 

```bash 

//this table to display realtime data from esp32 I/O
CREATE TABLE `updatedata` (
    `id` varchar(255) NOT NULL,
    `temperature` float(10,2) NOT NULL,
    `humidity` int(3) NOT NULL,
    `status_read_sensor_dht11` varchar(255) NOT NULL,
    `LED_01` varchar(255) NOT NULL,
    `LED_02` varchar(255) NOT NULL,
    `time` time NOT NULL,
    `date` date NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `updatedata`(`id`, `temperature`, `humidity`, `status_read_sensor_dht11`, `LED_01`, `LED_02`, `time`, `date`) VALUES ('esp32_01','0.00','0','SUCCESS','OFF','OFF',NOW(),NOW())


// historical Database to store data
CREATE TABLE `historicaldata` (
    `id` varchar(255) NOT NULL,
    `board` varchar(255) NOT NULL,
    `temperature` float(10,2) NOT NULL,
    `humidity` int(3) NOT NULL,
    `status_read_sensor_dht11` varchar(255) NOT NULL,
    `LED_01` varchar(255) NOT NULL,
    `LED_02` varchar(255) NOT NULL,
    `time` time NOT NULL,
    `date` date NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

```

# Site architechture 

![image](https://github.com/ringBuffer-TM/iot-mysql-esp32/assets/172147591/6ca691e7-7c75-4417-87eb-d29e6354422a)

![image](https://github.com/ringBuffer-TM/iot-mysql-esp32/assets/172147591/339489b6-fdb6-45ea-88fe-5fec653fde72)


# Quick DEMO !!

![image](https://github.com/ringBuffer-TM/iot-mysql-esp32/assets/172147591/9d193989-3a8a-4432-b8c5-52b03e696fdc)











