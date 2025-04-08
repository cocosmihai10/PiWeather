<?php

class Database 
{
	private $connection;

	public function __construct()
	{
		$this->connectDB();
	}
	
	private function connectDB()
	{
		require_once '../src/config/config.php';
		try 
		{
			$con = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
			$this->connection = new PDO($con, DB_USER, DB_PASS);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			die("Connection failed: " . $e->getMessage());
		}
	}
	
	public function getReadings()
	{
		$sql = "SELECT temperature, humidity, created_at FROM readings";
		$query = $this->connection->prepare($sql);
		$query->execute();
		
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function getMaxReadings(string $column)
	{
		$sql = "SELECT DATE(created_at) as date,
					CASE
						WHEN HOUR(created_at) < 3 THEN '00:00'
						WHEN HOUR(created_at) < 6 THEN '03:00'
						WHEN HOUR(created_at) < 9 THEN '06:00'
						WHEN HOUR(created_at) < 12 THEN '09:00'
						WHEN HOUR(created_at) < 15 THEN '12:00'
						WHEN HOUR(created_at) < 18 THEN '15:00'
						WHEN HOUR(created_at) < 21 THEN '18:00'
						else '21:00'
					END as time_range,
					MAX({$column}) as max_value
				FROM readings
				WHERE created_at >= CURDATE()
				GROUP BY date, time_range
				ORDER BY date, time_range;";
		$query = $this->connection->prepare($sql);
		$query->execute();
		
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function getMinReadings(string $column)
	{
		$sql = "SELECT DATE(created_at) as date,
					CASE
						WHEN HOUR(created_at) < 3 THEN '00:00'
						WHEN HOUR(created_at) < 6 THEN '03:00'
						WHEN HOUR(created_at) < 9 THEN '06:00'
						WHEN HOUR(created_at) < 12 THEN '09:00'
						WHEN HOUR(created_at) < 15 THEN '12:00'
						WHEN HOUR(created_at) < 18 THEN '15:00'
						WHEN HOUR(created_at) < 21 THEN '18:00'
						else '21:00'
					END as time_range,
					MIN({$column}) as min_value
				FROM readings
				WHERE created_at >= CURDATE()
				GROUP BY date, time_range
				ORDER BY date, time_range;";
		$query = $this->connection->prepare($sql);
		$query->execute();
		
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function getAvgReadings(string $column)
	{
		$sql = "SELECT DATE(created_at) as date,
					CASE
						WHEN HOUR(created_at) < 3 THEN '00:00'
						WHEN HOUR(created_at) < 6 THEN '03:00'
						WHEN HOUR(created_at) < 9 THEN '06:00'
						WHEN HOUR(created_at) < 12 THEN '09:00'
						WHEN HOUR(created_at) < 15 THEN '12:00'
						WHEN HOUR(created_at) < 18 THEN '15:00'
						WHEN HOUR(created_at) < 21 THEN '18:00'
						else '21:00'
					END as time_range,
					AVG({$column}) as avg_value
				FROM readings
				WHERE created_at >= CURDATE()
				GROUP BY date, time_range
				ORDER BY date, time_range;";
		$query = $this->connection->prepare($sql);
		$query->execute();
		
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
}
