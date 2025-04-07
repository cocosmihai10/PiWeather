# Complete Project Details: https://RandomNerdTutorials.com/raspberry-pi-dht11-dht22-python/
# Based on Adafruit_CircuitPython_DHT Library Example

import datetime
import time
import board
import adafruit_dht

# Sensor data pin is connected to GPIO 4
sensor = adafruit_dht.DHT22(board.D4)
# Uncomment for DHT11
#sensor = adafruit_dht.DHT11(board.D4)

file = open("sensor_data.txt", "a")
print("Reading Temperature and Humidity from DHT22 sensor ... \nTo stop the reading, press CTRL + C")
while True:
    try:
        # Print the values to the serial port
        temperature_c = sensor.temperature
        humidity = sensor.humidity
        current_datetime = datetime.datetime.now()
        current_datetime = current_datetime.strftime('%Y-%m-%d %H:%M:%S')
        file.writelines("{0:0.1f}\t{1:0.1f}\t".format(temperature_c, humidity))
        file.writelines(str(current_datetime))
        file.writelines("\n")

    except RuntimeError as error:
        # Errors happen fairly often, DHT's are hard to read, just keep going
        time.sleep(2.0)
        continue
    except Exception as error:
        sensor.exit()
        raise error

    time.sleep(2.0)
