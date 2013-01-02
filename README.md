Wunderground API
------------

Simple PHP api to use Wunderground service.

Usage
------------
	
	// init
	require_once('Wunderground.php');
	$weather = new Wunderground(YOUR_API_KEY, $lang);
	
	// cache dir
	$weather->setCacheDir(MY_PATH . 'temp/');
	$weather->setCacheExpiry(3600);
	
	// get current weather
	$weather->getCurrentWeather($city, $country);
	
	// get forecast
	$weather->getForecast($city, $country);