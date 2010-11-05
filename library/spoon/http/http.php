<?php

/**
 * Spoon Library
 *
 * This source file is part of the Spoon Library. More information,
 * documentation and tutorials can be found @ http://www.spoon-library.com
 *
 * @package		spoon
 * @subpackage	http
 *
 *
 * @author		Davy Hellemans <davy@spoon-library.com>
 * @author 		Tijs Verkoyen <tijs@spoon-library.com>
 * @author		Dave Lens <dave@spoon-library.com>
 * @since		0.1.1
 */


/**
 * This class is used to manipulate raw http headers
 *
 * @package		spoon
 * @subpackage	http
 *
 *
 * @author		Davy Hellemans <davy@spoon-library.com>
 * @since		0.1.1
 */
class SpoonHTTP
{
	/**
	 * Get content from an URL.
	 *
	 * @return	string							The content.
	 * @param	string $URL						The URL of the webpage that should be retrieved.
	 * @param	array[optional] $cURLOptions	Extra options to be passed on with the cURL-request
	 */
	public static function getContent($URL, array $cURLoptions = null)
	{
		// check if curl is available
		if(!function_exists('curl_init')) throw new SpoonFileException('This method requires cURL (http://php.net/curl), it seems like the extension isn\'t installed.');

		// set options
		$options[CURLOPT_URL] = (string) $URL;
		$options[CURLOPT_USERAGENT] = 'Spoon '. SPOON_VERSION;
		if(ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) $options[CURLOPT_FOLLOWLOCATION] = true;
		$options[CURLOPT_RETURNTRANSFER] = true;
		$options[CURLOPT_TIMEOUT] = 10;

		// any extra options provided?
		if($cURLoptions !== null)
		{
			// loop the extra options
			foreach($cURLoptions as $key => $value) $options[$key] = $value;
		}

		// init
		$curl = curl_init();

		// set options
		curl_setopt_array($curl, $options);

		// execute
		$response = curl_exec($curl);

		// fetch errors
		$errorNumber = curl_errno($curl);
		$errorMessage = curl_error($curl);

		// close
		curl_close($curl);

		// validate
		if($errorNumber != '') throw new SpoonHTTPException($errorMessage);

		// return the content
		return (string) $response;
	}


	/**
	 * Retrieve the list with headers that are sent or to be sent.
	 *
	 * @return	array
	 */
	public static function getHeadersList()
	{
		return headers_list();
	}


	/**
	 * Retrieve the ip address.
	 *
	 * @return	string
	 */
	public static function getIp()
	{
		return (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	}


	/**
	 * Checks if any headers were already sent.
	 *
	 * @return	bool	True if the headers were sent, false if not.
	 */
	private static function isSent()
	{
		return headers_sent();
	}


	/**
	 * Redirect the browser with an optional delay and stop script execution.
	 *
	 * @return	void
	 * @param	string $URL				The URL or page to redirect to.
	 * @param	int[optional] $code		The redirect code. Only 301 (moved permanently) and 302 (found) are allowed.
	 * @param	int[optional] $delay	A delay, expressed in seconds.
	 */
	public static function redirect($URL, $code = 302, $delay = null)
	{
		// redefine url
		$URL = (string) $URL;
		$code = SpoonFilter::getValue($code, array(301, 302), 302, 'int');

		// redirect headers
		self::setHeadersByCode($code);

		// delay execution
		if($delay !== null) sleep((int) $delay);

		// redirect
		self::setHeaders("Location: $URL");

		// stop execution
		exit;
	}


	/**
	 * Set one or multiple headers.
	 *
	 * @return	void
	 * @param	mixed $headers		A string or array with headers to send.
	 */
	public static function setHeaders($headers)
	{
		// header already sent
		if(self::isSent()) throw new SpoonHTTPException('Headers were already sent.');

		// loop elements
		foreach((array) $headers as $header)
		{
			// set header
			header((string) $header);
		}
	}


	/**
	 * Parse headers for a given status code.
	 *
	 * @return	void
	 * @param	int[optional] $code		The code to use, possible values are: 200, 301, 302, 304, 307, 400, 401, 403, 404, 410, 500, 501.
	 */
	public static function setHeadersByCode($code = 200)
	{
		// allowed status codes
		$aCodes[200] = '200 OK';
		$aCodes[301] = '301 Moved Permanently';
		$aCodes[302] = '302 Found';
		$aCodes[304] = '304 Not Modified';
		$aCodes[307] = '307 Temporary Redirect';
		$aCodes[400] = '400 Bad Request';
		$aCodes[401] = '401 Unauthorized';
		$aCodes[403] = '403 Forbidden';
		$aCodes[404] = '404 Not Found';
		$aCodes[410] = '410 Gone';
		$aCodes[500] = '500 Internal Server Error';
		$aCodes[501] = '501 Not Implemented';

		// code
		$code = (int) $code;
		if(!isset($aCodes[$code])) $code = 200;

		// set header
		self::setHeaders('HTTP/1.1 '. $aCodes[$code]);
	}
}


/**
 * This exception is used to handle HTTP related exceptions.
 *
 * @package		spoon
 * @subpackage	http
 *
 *
 * @author		Davy Hellemans <davy@spoon-library.com>
 * @since		0.1.1
 */
class SpoonHTTPException extends SpoonException {}

?>