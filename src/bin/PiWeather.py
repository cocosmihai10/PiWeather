# Complete Project Details: https://RandomNerdTutorials.com/raspberry-pi-dht11-dht22-python/
# Based on Adafruit_CircuitPython_DHT Library Example

import datetime
import time
import board
import adafruit_dht
from database import DBClass

# Sensor data pin is connected to GPIO 4
sensor = adafruit_dht.DHT22(board.D4)

database = DBClass()
database.createTableIfNotExists()

print("Reading Temperature and Humidity from DHT22 sensor ... \nTo stop the reading, press CTRL + C")

while True:
    try:
        database.storeData((sensor.temperature, sensor.humidity))

    except RuntimeError as error:
        # Errors happen fairly often, DHT's are hard to read, just keep going
        time.sleep(2.0)
        continue
    except Exception as error:
        sensor.exit()
        raise error

    time.sleep(2.0)
