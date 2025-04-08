<?php
ini_set('display_errors', 1);
require_once '../src/config/config.php';
require_once '../src/database/Database.php';

$db = new Database();

if(isset($_GET['fetchReadings'])) {
	header('Content-Type: application/json');
	echo json_encode([
		'success' => true,
		'message' => '',
		'data' => $db->fetchReadings()
	]);
	return ;
}

$maxTemperatures = $db->getMaxReadings('temperature');
$minTemperatures = $db->getMinReadings('temperature');
$avgTemperatures = $db->getAvgReadings('temperature');

$maxHumidity = $db->getMaxReadings('humidity');
$minHumidity = $db->getMinReadings('humidity');
$avgHumidity = $db->getAvgReadings('humidity');

include '../src/resources/views/home.php';

