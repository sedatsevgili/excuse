<?php

/**
 * Excuse Generator :)
 * @author Sedat Sevgili
 * @see https://github.com/sedatsevgili/excuse
 */
class ExcuseGenerator{

	/**
	 * Generates an excuse
	 * @return string
	 */
	public static function excuse() {
		$url = "http://developerexcuses.com/";
		$curlHandler = curl_init($url);
		curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curlHandler);
		if(false === $response) {
			curl_close($response);
			return "i am deeply deeply sorry" . PHP_EOL;
		}
		curl_close($curlHandler);
		$count = preg_match_all('/<a[^>]+>([^<]+)</', $response, $matches);
		if($count === 0) {
			return "i could not find any excuse" . PHP_EOL; 
		}
		return $matches[1][0] . PHP_EOL;
	}
}

echo ExcuseGenerator::excuse();