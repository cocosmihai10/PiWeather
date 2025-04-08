document.addEventListener("DOMContentLoaded", () => {
	
	displayClock();
	displayDate();
	
	//polling readings every 5 seconds
	setInterval(fetchReadings, 5000);	

	const DATA_COUNT = 8;
	const NUMBER_CFG = {count: DATA_COUNT, min: -10, max: 50};

	const temperatureElement = document.getElementById('temperatureChart').getContext('2d');
	const temperatureChart = new Chart(temperatureElement, {
		type: 'line',
		data: {
			labels: labels,
			datasets: [
				{
					label: 'Max',
					data: temperatureDataMax,
					borderColor: 'rgba(255, 99, 132, 1)',
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					fill: false,
					tension: 0.1
				},
				{
					label: 'Min',
					data: temperatureDataMin,
					borderColor: 'rgba(54, 162, 235, 1)',
					backgroundColor: 'rgba(54, 162, 235, 0.2)',
					fill: false,
					tension: 0.1
				},
				{
					label: 'Average',
					data: temperatureDataAvg,
					borderColor: 'rgba(249, 156, 4, 1)',
					backgroundColor: 'rgba(241, 249, 4, 0.2)',
					fill: false,
					tension: 0.1
				}
			]
		},
		options: {
			responsive: true,
			scales: {
				x: {
					title: { display: true, text: 'Hours' }
				},
				y: {
					title: { display: true, text: '[°] Celsius' }
				}
			}
		}
	});

	const humidityElement = document.getElementById('humidityChart').getContext('2d');
	const humidityChart = new Chart(humidityElement, {
		type: 'line',
		data: {
			labels: labels,
			datasets: [
				{
					label: 'Max',
					data: humidityDataMax,
					borderColor: 'rgba(255, 99, 132, 1)',
					backgroundColor: 'rgba(255, 0, 0, 0.2)',
					fill: false,
					tension: 0.1
				},
				{
					label: 'Min',
					data: humidityDataMin,
					borderColor: 'rgba(54, 162, 235, 1)',
					backgroundColor: 'rgba(54, 162, 235, 0.2)',
					fill: false,
					tension: 0.1
				},
				{
					label: 'Average',
					data: humidityDataAvg,
					borderColor: 'rgba(249, 156, 4, 1)',
					backgroundColor: 'rgba(241, 249, 4, 0.2)',
					fill: false,
					tension: 0.1
				}
			]
		},
		options: {
			responsive: true,
			scales: {
				x: {
					title: { display: true, text: 'Hours' }
				},
				y: {
					title: { display: true, text: '[%] Percentage' }
				}
			}
		}
	});
});

function displayClock(){
  var display = new Date().toLocaleString('en-US',{hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false});
  var clock = document.getElementById('clock');
  clock.innerHTML = display;
  setTimeout(displayClock, 1000); 
}

function displayDate(){
  var display = new Date().toLocaleString('en-US',{weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'});
  var clock = document.getElementById('date');
  date.innerHTML = display;
}

function fetchReadings(){
  var url = '/?fetchReadings';
  fetch(url)
    .then(response => {
      if(!response.ok) {
        throw new Error('Network response error: ' + response.message)
      }
      return response.json();
    })
    .then(data => {
      var liveTemperature = document.getElementById('live-temperature');
      var liveHumidity = document.getElementById('live-humidity');
      liveTemperature.innerHTML = data.data[0].temperature + ' °C';
      liveHumidity.innerHTML = data.data[0].humidity + ' %';
    })
    .catch(error => {
      console.log('Error fetching readings: ', error);
    });
}

