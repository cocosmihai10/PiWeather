import pymysql

class DBClass:
    def __init__(self):
        self.connection = pymysql.connect(user='weatheruser', password='weatherpassword', host='localhost', database='piweather')
        print("Connection to DB successful...")
        self.cursor = self.connection.cursor()
	
    def createTableIfNotExists(self):
        query = "create table if not exists readings (id int NOT NULL auto_increment,temperature decimal(3,1),humidity decimal(3,1),created_at timestamp default current_timestamp,updated_at datetime default current_timestamp on update current_timestamp,primary key (id));"

        try:
            self.cursor.execute(query)
		
        except Exception as e:
            print(e)

        else:
            print("Table created successfully")

    def storeData(self, data:tuple):
        query = "insert into readings(temperature, humidity) values (%2.1f,%2.1f)" % data
        print(query)

        try:
            self.cursor.execute(query)
            self.connection.commit()

        except Exception as e:
            print(e)

        else:
            print("Data stored successfully")
