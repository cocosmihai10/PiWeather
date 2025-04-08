<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>PiWeather</title>
		<!-- Latest Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Latest Chart.js -->
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<link href="css/piweather.css" rel="stylesheet">
	</head>
    <body>
        <div class="container">
            <h1 class="mt-5 text-center">PiWeather - Temperature and Humidity readings</h1>
            <div class="row mt-5">
				<div class="col-5 d-flex justify-content-center align-items-center">
					<div class="card rounded-circle card-circle">
						<div class="card-body d-flex justify-content-center align-items-center">
							<div class="card-text fs-1" id="live-temperature"></div>
						</div>
					</div>
				</div>
				<div class="col-2 d-flex flex-column justify-content-center align-items-center">
					<div class="card-text fs-2" id="clock"></div>
					<div class="card-text small text-secondary" id="date"></div>
				</div>
				<div class="col-5 d-flex justify-content-center align-items-center">
					<div class="card rounded-circle card-circle">
						<div class="card-body d-flex justify-content-center align-items-center">
							<div class="card-text fs-1" id="live-humidity"></div>
						</div>
					</div>
				</div>
            </div>
            <div class="row mt-5">
				<div class="col-6">
					<canvas id="temperatureChart" width="400" height="200"></canvas>
				</div>
				<div class="col-6">
					<canvas id="humidityChart" width="400" height="200"></canvas>
				</div>
            </div>
        </div>
        <script>
			const labels = [
				<?php foreach($maxTemperatures as $temp): ?>
					"<?php echo $temp['time_range'] ?>",
				<?php endforeach; ?>
			];
			const temperatureDataMax = [
				<?php foreach($maxTemperatures as $temp): ?>
					<?php echo $temp['max_value'] ?>,
				<?php endforeach; ?>
			];
			const temperatureDataMin = [
				<?php foreach($minTemperatures as $temp): ?>
					<?php echo $temp['min_value'] ?>,
				<?php endforeach; ?>
			];
			const temperatureDataAvg = [
				<?php foreach($avgTemperatures as $temp): ?>
					<?php echo $temp['avg_value'] ?>,
				<?php endforeach; ?>
			];
			
			const humidityDataMax = [
				<?php foreach($maxHumidity as $hum): ?>
					<?php echo $hum['max_value'] ?>,
				<?php endforeach; ?>
			];
			const humidityDataMin = [
				<?php foreach($minHumidity as $hum): ?>
					<?php echo $hum['min_value'] ?>,
				<?php endforeach; ?>
			];
			const humidityDataAvg = [
				<?php foreach($avgHumidity as $hum): ?>
					<?php echo $hum['avg_value'] ?>,
				<?php endforeach; ?>
			];
        </script>
        <script src="js/piweather.js"></script>
    </body>
</html>


