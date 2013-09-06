<?php

/**
 * Excuse Generator :)
 * @author Sedat Sevgili
 * @see https://github.com/sedatsevgili/excuse
 */
class ExcuseGenerator{

	private static function _getResponse($url) {
		$curlHandler = curl_init($url);
		curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curlHandler);
		if(false === $response) {
			curl_close($response);
			echo "i am deeply deeply sorry" . PHP_EOL;
			exit;
		}
		curl_close($curlHandler);
		return $response;
	}

	/**
	 * Generates an excuse
	 * @return string
	 */
	public static function excuse() {
		$url = "http://developerexcuses.com/";
		$response = self::_getResponse($url);
		if(false === $response) {
			curl_close($response);
			return "i am deeply deeply sorry" . PHP_EOL;
		}
		$count = preg_match_all('/<a[^>]+>([^<]+)</', $response, $matches);
		if($count === 0) {
			echo "i could not find any excuse" . PHP_EOL; 
			exit;
		}
		return $matches[1][0] . PHP_EOL;
	}
	
	/**
	 * Generates and translates it with google translate
	 * @return string
	 */
	public static function translateAndExcuse($destinationLanguage = "tr") {
		$excuse = self::excuse();
		$url = "http://translate.google.com/translate_a/t?client=t&sl=en&tl=" . $destinationLanguage . "&hl=" . $destinationLanguage . "&sc=2&ie=UTF-8&oe=UTF-8&prev=btn&ssel=0&tsel=0&q=" . urlencode($excuse);
		$response = self::_getResponse($url);
		$count = preg_match_all('/\[\[\["([^"]+)"/', $response, $matches);
		if($count === 0) {
			echo "i could not translate the excuse" . PHP_EOL;
			exit;
		}
		return $matches[1][0] . PHP_EOL;
	}
	
}

echo ExcuseGenerator::translateAndExcuse();
