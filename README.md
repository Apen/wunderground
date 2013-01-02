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
	
current weather object
------------

	stdClass Object
	(
		[response] => stdClass Object
			(
				[version] => 0.1
				[termsofService] => http://www.wunderground.com/weather/api/d/terms.html
				[features] => stdClass Object
					(
						[conditions] => 1
					)

			)

		[current_observation] => stdClass Object
			(
				[image] => stdClass Object
					(
						[url] => http://icons-ak.wxug.com/graphics/wu2/logo_130x80.png
						[title] => Weather Underground
						[link] => http://www.wunderground.com
					)

				[display_location] => stdClass Object
					(
						[full] => Nantes, France
						[city] => Nantes
						[state] => 
						[state_name] => France
						[country] => FR
						[country_iso3166] => FR
						[zip] => 00000
						[latitude] => 47.16999817
						[longitude] => -1.60000002
						[elevation] => 27.00000000
					)

				[observation_location] => stdClass Object
					(
						[full] => Nantes, 
						[city] => Nantes
						[state] => 
						[country] => FR
						[country_iso3166] => FR
						[latitude] => 47.16999817
						[longitude] => -1.60000002
						[elevation] => 89 ft
					)

				[estimated] => stdClass Object
					(
					)

				[station_id] => LFRS
				[observation_time] => Last Updated on janvier 2, 16:00 CET
				[observation_time_rfc822] => Wed, 02 Jan 2013 16:00:00 +0100
				[observation_epoch] => 1357138800
				[local_time_rfc822] => Wed, 02 Jan 2013 16:34:41 +0100
				[local_epoch] => 1357140881
				[local_tz_short] => CET
				[local_tz_long] => Europe/Paris
				[local_tz_offset] => +0100
				[weather] => Nuageux
				[temperature_string] => 52 F (11 C)
				[temp_f] => 52
				[temp_c] => 11
				[relative_humidity] => 71%
				[wind_string] => From the West at 4 MPH
				[wind_dir] => West
				[wind_degrees] => 280
				[wind_mph] => 4
				[wind_gust_mph] => 0
				[wind_kph] => 6
				[wind_gust_kph] => 0
				[pressure_mb] => 1031
				[pressure_in] => 30.45
				[pressure_trend] => 0
				[dewpoint_string] => 43 F (6 C)
				[dewpoint_f] => 43
				[dewpoint_c] => 6
				[heat_index_string] => NA
				[heat_index_f] => NA
				[heat_index_c] => NA
				[windchill_string] => NA
				[windchill_f] => NA
				[windchill_c] => NA
				[feelslike_string] => 52 F (11 C)
				[feelslike_f] => 52
				[feelslike_c] => 11
				[visibility_mi] => 6.2
				[visibility_km] => 10.0
				[solarradiation] => 
				[UV] => 0
				[precip_1hr_string] => -9999.00 in (-9999.00 mm)
				[precip_1hr_in] => -9999.00
				[precip_1hr_metric] => -9999.00
				[precip_today_string] => 0.00 in (0.0 mm)
				[precip_today_in] => 0.00
				[precip_today_metric] => 0.0
				[icon] => mostlycloudy
				[icon_url] => http://icons.wxug.com/i/c/i/mostlycloudy.gif
				[forecast_url] => http://www.wunderground.com/global/stations/07222.html
				[history_url] => http://www.wunderground.com/history/airport/LFRS/2013/1/2/DailyHistory.html
				[ob_url] => http://www.wunderground.com/cgi-bin/findweather/getForecast?query=47.16999817,-1.60000002
				[icon_name] => mostlycloudy.gif
				[icon_name_only] => mostlycloudy
			)

	)
	
forecast object
------------

	stdClass Object
	(
		[response] => stdClass Object
			(
				[version] => 0.1
				[termsofService] => http://www.wunderground.com/weather/api/d/terms.html
				[features] => stdClass Object
					(
						[forecast] => 1
					)

			)

		[forecast] => stdClass Object
			(
				[txt_forecast] => stdClass Object
					(
						[date] => 1:00 AM CET
						[forecastday] => Array
							(
								[0] => stdClass Object
									(
										[period] => 0
										[icon] => partlycloudy
										[icon_url] => http://icons-ak.wxug.com/i/c/k/partlycloudy.gif
										[title] => mercredi
										[fcttext] => Partiellement nuageux. Nappes de brouillard tôt dans la matinée. Température maximale 50F. Vents en provenance du NO à 5-10 mph.
										[fcttext_metric] => Partiellement nuageux. Nappes de brouillard tôt dans la matinée. Température maximale 10C. Vents en provenance du NO à 5-15 km/h.
										[pop] => 0
									)

								[1] => stdClass Object
									(
										[period] => 1
										[icon] => chancerain
										[icon_url] => http://icons-ak.wxug.com/i/c/k/chancerain.gif
										[title] => mercredi soir
										[fcttext] => Couvert avec un risque de pluie dans la soirée, ensuite couvert. Nappes de brouillard pendant la nuit. Température minimale 45F. Vents en provenance du OSO à 5-10 mph. Risques de précipitations 40%.
										[fcttext_metric] => Couvert avec un risque de pluie dans la soirée, ensuite couvert. Nappes de brouillard pendant la nuit. Température minimale 7C. Vents en provenance du OSO à 10-15 km/h. Risques de précipitations 40%.
										[pop] => 40
									)

								[2] => stdClass Object
									(
										[period] => 2
										[icon] => partlycloudy
										[icon_url] => http://icons-ak.wxug.com/i/c/k/partlycloudy.gif
										[title] => jeudi
										[fcttext] => Partiellement nuageux. Nappes de brouillard tôt dans la matinée. Température maximale 55F. Vents en provenance du Ouest à 5-10 mph.
										[fcttext_metric] => Partiellement nuageux. Nappes de brouillard tôt dans la matinée. Température maximale 13C. Vents en provenance du Ouest à 10-15 km/h.
										[pop] => 0
									)

								[3] => stdClass Object
									(
										[period] => 3
										[icon] => partlycloudy
										[icon_url] => http://icons-ak.wxug.com/i/c/k/partlycloudy.gif
										[title] => jeudi soir
										[fcttext] => Partiellement nuageux dans la soirée, ensuite couvert. Nappes de brouillard pendant la nuit. Température minimale 43F. Vent moins de 5 mph.
										[fcttext_metric] => Partiellement nuageux dans la soirée, ensuite couvert. Nappes de brouillard pendant la nuit. Température minimale 6C. Vent moins de 5 km/h.
										[pop] => 0
									)

								[4] => stdClass Object
									(
										[period] => 4
										[icon] => partlycloudy
										[icon_url] => http://icons-ak.wxug.com/i/c/k/partlycloudy.gif
										[title] => vendredi
										[fcttext] => Couvert dans la matinée, ensuite partiellement nuageux. Nappes de brouillard tôt dans la matinée. Température maximale 54F. Vent moins de 5 mph.
										[fcttext_metric] => Couvert dans la matinée, ensuite partiellement nuageux. Nappes de brouillard tôt dans la matinée. Température maximale 12C. Vent moins de 5 km/h.
										[pop] => 0
									)

								[5] => stdClass Object
									(
										[period] => 5
										[icon] => partlycloudy
										[icon_url] => http://icons-ak.wxug.com/i/c/k/partlycloudy.gif
										[title] => vendredi soir
										[fcttext] => Ciel dégagé dans la soirée, ensuite partiellement nuageux. Température minimale 41F. Vent moins de 5 mph.
										[fcttext_metric] => Ciel dégagé dans la soirée, ensuite partiellement nuageux. Température minimale 5C. Vent moins de 5 km/h.
										[pop] => 0
									)

								[6] => stdClass Object
									(
										[period] => 6
										[icon] => partlycloudy
										[icon_url] => http://icons-ak.wxug.com/i/c/k/partlycloudy.gif
										[title] => samedi
										[fcttext] => Couvert dans la matinée, ensuite partiellement nuageux. Nappes de brouillard tôt dans la matinée. Température maximale 52F. Vents en provenance du Est à 5-10 mph.
										[fcttext_metric] => Couvert dans la matinée, ensuite partiellement nuageux. Nappes de brouillard tôt dans la matinée. Température maximale 11C. Vents en provenance du Est à 5-15 km/h.
										[pop] => 0
									)

								[7] => stdClass Object
									(
										[period] => 7
										[icon] => partlycloudy
										[icon_url] => http://icons-ak.wxug.com/i/c/k/partlycloudy.gif
										[title] => samedi soir
										[fcttext] => Ciel dégagé dans la soirée, ensuite partiellement nuageux. Température minimale 41F. Vents en provenance du Est à 5-10 mph.
										[fcttext_metric] => Ciel dégagé dans la soirée, ensuite partiellement nuageux. Température minimale 5C. Vents en provenance du Est à 10-15 km/h.
										[pop] => 0
									)

							)

					)

				[simpleforecast] => stdClass Object
					(
						[forecastday] => Array
							(
								[0] => stdClass Object
									(
										[date] => stdClass Object
											(
												[epoch] => 1357160400
												[pretty] => 10:00 PM CET on January 02, 2013
												[day] => 2
												[month] => 1
												[year] => 2013
												[yday] => 1
												[hour] => 22
												[min] => 00
												[sec] => 0
												[isdst] => 0
												[monthname] => janvier
												[weekday_short] => mer
												[weekday] => mercredi
												[ampm] => PM
												[tz_short] => CET
												[tz_long] => Europe/Paris
											)

										[period] => 1
										[high] => stdClass Object
											(
												[fahrenheit] => 50
												[celsius] => 10
											)

										[low] => stdClass Object
											(
												[fahrenheit] => 45
												[celsius] => 7
											)

										[conditions] => Partiellement nuageux
										[icon] => partlycloudy
										[icon_url] => http://icons.wxug.com/i/c/i/partlycloudy.gif
										[skyicon] => partlycloudy
										[pop] => 0
										[qpf_allday] => stdClass Object
											(
												[in] => 0.02
												[mm] => 0.5
											)

										[qpf_day] => stdClass Object
											(
												[in] => 0
												[mm] => 0
											)

										[qpf_night] => stdClass Object
											(
												[in] => 0.02
												[mm] => 0.5
											)

										[snow_allday] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[snow_day] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[snow_night] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[maxwind] => stdClass Object
											(
												[mph] => 7
												[kph] => 11
												[dir] => NO
												[degrees] => 325
											)

										[avewind] => stdClass Object
											(
												[mph] => 5
												[kph] => 8
												[dir] => Ouest
												[degrees] => 274
											)

										[avehumidity] => 85
										[maxhumidity] => 100
										[minhumidity] => 73
									)

								[1] => stdClass Object
									(
										[date] => stdClass Object
											(
												[epoch] => 1357246800
												[pretty] => 10:00 PM CET on January 03, 2013
												[day] => 3
												[month] => 1
												[year] => 2013
												[yday] => 2
												[hour] => 22
												[min] => 00
												[sec] => 0
												[isdst] => 0
												[monthname] => janvier
												[weekday_short] => jeu
												[weekday] => jeudi
												[ampm] => PM
												[tz_short] => CET
												[tz_long] => Europe/Paris
											)

										[period] => 2
										[high] => stdClass Object
											(
												[fahrenheit] => 55
												[celsius] => 13
											)

										[low] => stdClass Object
											(
												[fahrenheit] => 43
												[celsius] => 6
											)

										[conditions] => Partiellement nuageux
										[icon] => partlycloudy
										[icon_url] => http://icons.wxug.com/i/c/i/partlycloudy.gif
										[skyicon] => partlycloudy
										[pop] => 0
										[qpf_allday] => stdClass Object
											(
												[in] => 0
												[mm] => 0
											)

										[qpf_day] => stdClass Object
											(
												[in] => 0
												[mm] => 0
											)

										[qpf_night] => stdClass Object
											(
												[in] => 0
												[mm] => 0
											)

										[snow_allday] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[snow_day] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[snow_night] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[maxwind] => stdClass Object
											(
												[mph] => 6
												[kph] => 10
												[dir] => ONO
												[degrees] => 290
											)

										[avewind] => stdClass Object
											(
												[mph] => 5
												[kph] => 8
												[dir] => Ouest
												[degrees] => 280
											)

										[avehumidity] => 94
										[maxhumidity] => 100
										[minhumidity] => 90
									)

								[2] => stdClass Object
									(
										[date] => stdClass Object
											(
												[epoch] => 1357333200
												[pretty] => 10:00 PM CET on January 04, 2013
												[day] => 4
												[month] => 1
												[year] => 2013
												[yday] => 3
												[hour] => 22
												[min] => 00
												[sec] => 0
												[isdst] => 0
												[monthname] => janvier
												[weekday_short] => vend
												[weekday] => vendredi
												[ampm] => PM
												[tz_short] => CET
												[tz_long] => Europe/Paris
											)

										[period] => 3
										[high] => stdClass Object
											(
												[fahrenheit] => 54
												[celsius] => 12
											)

										[low] => stdClass Object
											(
												[fahrenheit] => 41
												[celsius] => 5
											)

										[conditions] => Partiellement nuageux
										[icon] => partlycloudy
										[icon_url] => http://icons.wxug.com/i/c/i/partlycloudy.gif
										[skyicon] => mostlysunny
										[pop] => 0
										[qpf_allday] => stdClass Object
											(
												[in] => 0
												[mm] => 0
											)

										[qpf_day] => stdClass Object
											(
												[in] => 0
												[mm] => 0
											)

										[qpf_night] => stdClass Object
											(
												[in] => 0
												[mm] => 0
											)

										[snow_allday] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[snow_day] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[snow_night] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[maxwind] => stdClass Object
											(
												[mph] => 3
												[kph] => 5
												[dir] => ENE
												[degrees] => 76
											)

										[avewind] => stdClass Object
											(
												[mph] => 1
												[kph] => 2
												[dir] => ESE
												[degrees] => 106
											)

										[avehumidity] => 86
										[maxhumidity] => 100
										[minhumidity] => 80
									)

								[3] => stdClass Object
									(
										[date] => stdClass Object
											(
												[epoch] => 1357419600
												[pretty] => 10:00 PM CET on January 05, 2013
												[day] => 5
												[month] => 1
												[year] => 2013
												[yday] => 4
												[hour] => 22
												[min] => 00
												[sec] => 0
												[isdst] => 0
												[monthname] => janvier
												[weekday_short] => sam
												[weekday] => samedi
												[ampm] => PM
												[tz_short] => CET
												[tz_long] => Europe/Paris
											)

										[period] => 4
										[high] => stdClass Object
											(
												[fahrenheit] => 52
												[celsius] => 11
											)

										[low] => stdClass Object
											(
												[fahrenheit] => 41
												[celsius] => 5
											)

										[conditions] => Partiellement nuageux
										[icon] => partlycloudy
										[icon_url] => http://icons.wxug.com/i/c/i/partlycloudy.gif
										[skyicon] => mostlysunny
										[pop] => 0
										[qpf_allday] => stdClass Object
											(
												[in] => 0
												[mm] => 0
											)

										[qpf_day] => stdClass Object
											(
												[in] => 0
												[mm] => 0
											)

										[qpf_night] => stdClass Object
											(
												[in] => 0
												[mm] => 0
											)

										[snow_allday] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[snow_day] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[snow_night] => stdClass Object
											(
												[in] => 0
												[cm] => 0
											)

										[maxwind] => stdClass Object
											(
												[mph] => 6
												[kph] => 10
												[dir] => Est
												[degrees] => 100
											)

										[avewind] => stdClass Object
											(
												[mph] => 4
												[kph] => 6
												[dir] => Est
												[degrees] => 88
											)

										[avehumidity] => 89
										[maxhumidity] => 100
										[minhumidity] => 81
									)

							)

					)

			)

	)