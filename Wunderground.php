<?php

/***************************************************************
 * Copyright notice
 *
 * (c) 2013 Yohann CERDAN <cerdanyohann@yahoo.fr>
 * All rights reserved
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class to get the weather using Wundergroud API
 *
 * @author     Yohann CERDAN <cerdanyohann@yahoo.fr>
 */
class Wunderground
{
	/**
	 * API key (required to use the web service)
	 * @var string
	 */
	protected $apikey;

	/**
	 * API lang
	 * @var string
	 */
	protected $language;

	/**
	 * Path to the icons (default: http://icons-ak.wxug.com/i/c/k/)
	 * @var string
	 */
	protected $iconPath;

	/**
	 * The result of the http call
	 * @var string
	 */
	protected $requestContent;

	/**
	 * Default cache directory is the current
	 * @var string
	 */
	protected $cacheDir = '';

	/**
	 * Cache expiry in seconds
	 * @var int
	 */
	protected $cacheExpiry = 3600;

	const API_URI = 'http://api.wunderground.com/api/';

	/**
	 * Constructor
	 *
	 * @param string $apikey
	 * @param string $language
	 */
	public function __construct($apikey, $language = 'en') {
		$this->apikey = $apikey;
		if (empty($language)) {
			$language = 'en';
		}
		$this->language = $language;
		$this->iconPath = 'http://icons-ak.wxug.com/i/c/k/';
		$this->cacheDir = dirname(__FILE__);
	}

	/**
	 * Get URL content using cURL.
	 *
	 * @param string $url the url
	 * @return string the html code
	 */
	protected function getContent($url) {
		if (!extension_loaded('curl')) {
			die('curl extension is not available');
		}
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_URL, $url);
		$this->requestContent = curl_exec($curl);
		$infos = curl_getinfo($curl);
		curl_close($curl);
		return $infos['http_code'];
	}

	/**
	 * Call the api and return an array
	 *
	 * @param string $method
	 * @param string $city
	 * @param string $country
	 * @return array
	 */
	protected function call($method, $city, $country) {
		$cache = $this->getCache($method, $city, $country);
		if ($cache === NULL) {
			$uri = self::API_URI . $this->apikey . '/' . $method . '/lang:' . strtoupper($this->language) . '/q/' . rawurlencode($country) . '/' . rawurlencode($city) . '.json';
			$getContentCode = $this->getContent($uri);
			if ($getContentCode == 200) {
				$datas = json_decode($this->requestContent);
				if (empty($datas->response->error)) {
					$this->setCache($method, $city, $country, $this->requestContent);
					return $datas;
				} else {
					// city not find
					return NULL;
				}
			} else {
				// network problem
				return NULL;
			}
		} else {
			return json_decode($cache);
		}
	}

	/**
	 * Get data from cache or NULL
	 *
	 * @param string $method
	 * @param string $city
	 * @param string $country
	 * @return string
	 */
	protected function getCache($method, $city, $country) {
		$filename = $this->getFilename($method, $city, $country);
		if (file_exists($filename)) {
			$expiry = filectime($filename) + $this->cacheExpiry;
			if ($expiry > mktime()) {
				return file_get_contents($filename);
			} else {
				return NULL;
			}
		} else {
			return NULL;
		}
	}

	/**
	 * Set data in cache (a json file)
	 *
	 * @param string $method
	 * @param string $city
	 * @param string $country
	 * @param string $content
	 */
	protected function setCache($method, $city, $country, $content) {
		$filename = $this->getFilename($method, $city, $country);
		file_put_contents($filename, $content);
	}

	/**
	 * Generate the filename of the cache file
	 *
	 * @param string $method
	 * @param string $city
	 * @param string $country
	 * @return string
	 */
	protected function getFilename($method, $city, $country) {
		$filename = $method . '-' . $city . '-' . $country . '-' . $this->language;
		$filename = strtolower($filename);
		$filename = $this->stripAccents($filename);
		$filename = preg_replace('/[^\w|-]*/', '', $filename);
		return $this->cacheDir . $filename . '.json';
	}

	/**
	 * Strip all accents from a string
	 *
	 * @param string $str
	 * @return string
	 */
	public function stripAccents($str) {
		$a = array(
			'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ',
			'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď',
			'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ',
			'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś',
			'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ',
			'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ'
		);
		$b = array(
			'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae',
			'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D',
			'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij',
			'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's',
			'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f',
			'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o'
		);
		return str_replace($a, $b, $str);
	}

	/**
	 * Get the current weather
	 *
	 * @param string $city
	 * @param string $country
	 * @return object
	 */
	public function getCurrentWeather($city, $country) {
		$conditions = $this->call('conditions', $city, $country);
		if (!empty($conditions)) {
			$conditions->current_observation->icon_name = basename($conditions->current_observation->icon_url);
			$conditions->current_observation->icon_name_only = basename($conditions->current_observation->icon_url, '.gif');
			$conditions->current_observation->icon_url = $this->iconPath . $conditions->current_observation->icon . '.gif';
			return $conditions;
		} else {
			return NULL;
		}
	}

	/**
	 * Get the forecast weather
	 *
	 * @param string $city
	 * @param string $country
	 * @return object
	 */
	public function getForecast($city, $country) {
		$forecast = $this->call('forecast', $city, $country);
		if (!empty($forecast)) {
			foreach ($forecast->forecast->simpleforecast->forecastday as $keyForecastday => $forecastday) {
				$forecast->forecast->simpleforecast->forecastday[$keyForecastday]->icon_url = $this->iconPath . $forecastday->icon . '.gif';
			}
			return $forecast;
		} else {
			return NULL;
		}
	}

	/**
	 * Set a custom icon path
	 * See http://www.wunderground.com/weather/api/d/docs?d=resources/icon-sets
	 *
	 * @param string $iconPath
	 */
	public function setIconPath($iconPath) {
		$this->iconPath = $iconPath;
	}

	/**
	 * Set a cache time expiration (in sec)
	 *
	 * @param int $cacheExpiry
	 */
	public function setCacheExpiry($cacheExpiry) {
		$this->cacheExpiry = $cacheExpiry;
	}

	/**
	 * Set the cache directory
	 *
	 * @param string $cacheDir
	 */
	public function setCacheDir($cacheDir) {
		$this->cacheDir = $cacheDir;
	}

}
