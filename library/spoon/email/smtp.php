<?php

/**
 *
 * This source file is part of the Spoon Library. More information,
 * documentation and tutorials can be found @ http://www.spoon-library.com
 *
 * @package		spoon
 * @subpackage	email
 *
 *
 * @author		Davy Hellemans <davy@spoon-library.com>
 * @author 		Tijs Verkoyen <tijs@spoon-library.com>
 * @author		Dave Lens <dave@spoon-library.com>
 * @since		1.0.0
 */


/**
 *
 * @package		spoon
 * @subpackage	email
 *
 *
 * @author		Dave Lens <dave@spoon-library.com>
 * @since		1.0.0
 */
class SpoonEmailSMTP
{
	/**
	 *
	 * @var	string
	 */
	const CRLF = "\x0d\x0a";


	/**
	 *
	 * @var	resource
	 */
	private $connection;


	/**
	 *
	 * @var	string
	 */
	private $host = 'localhost';


	/**
	 * Port storage
	 *
	 * @var	int
	 */
	private $port = 25;


	/**
	 *
	 * @var	string
	 */
	private $repliedCode;


	/**
	 *
	 * @var	string
	 */
	private $replies;


	/**
	 *
	 * @var string
	 */
	private $security;


	/**
	 *
	 * @var	int
	 */
	private $timeout = 30;


	/**
	 *
	 * @return	void
	 * @param	string $host
	 * @param	int $port
	 * @param	int $timeout
	 * @param	string[optional] $security
	 */
	public function __construct($host, $port, $timeout, $security = null)
	{
		// set connection related variables
		$this->host = (string) $host;
		$this->port = (int) $port;
		$this->timeout = (int) $timeout;
		$this->security = (string) $security;

		// make connection
		if(!$this->connect()) throw new SpoonEmailException('Connection to host '. $this->host .':'. $this->port .' failed.');

		// say hi to the host
		if(!$this->helo()) throw new SpoonEmailException('HELO went wrong: SMTP code '.$this->repliedCode);

		// initialize security layer
		switch($this->security)
		{
			case 'ssl': break;
			case 'tls': $this->startTLS(); break;
			default: break;
		}
	}


	/**
	 *
	 * @return	void
	 * @param	string $username
	 * @param	string $password
	 */
	public function authenticate($username, $password)
	{
		// check if we have a connection active
		if(!$this->connection) throw new SpoonEmailException('No SMTP connection found.');

		// push the auth login, only continue on code 334
		if($this->say('AUTH LOGIN') === 334)
		{
			// send username
			if($this->say(base64_encode($username)) === 334)
			{
				// send password
				return ($this->say(base64_encode($password)) === 235) ? true : false;
			}

			// authentication failed
			return false;
		}

		// ignore any errors we might have gotten on AUTH LOGIN and let the class continue
		return true;
	}


	/**
	 *
	 * @return	bool
	 */
	private function connect()
	{
		// check if we need to add ssl:// to the host
		if($this->security === 'ssl') $this->host = 'ssl://'. $this->host;

		// open connection
		$this->connection = @fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);

		// connection made
		if(!$this->connection) throw new SpoonEmailException('No connection to the SMTP host could be established.');

		// save the reply
		$this->saveReply();

		// set the time-out on the socket
		socket_set_timeout($this->connection, $this->timeout, 0);

		// report our success
		return true;
	}


	/**
	 *
	 * @return	int
	 * @param	string $reply	The SMTP reply string from any sent request
	 */
	private function getCode($reply)
	{
		// check input
		if($reply === null) throw new SpoonEmailException('No input given for '. __METHOD__ .', fix this.');

		// return the status code
		return (int) substr($reply, 0, 3);
	}


	/**
	 *
	 * @return	string
	 */
	public function getOutput()
	{
		return (string) $this->replies;
	}


	/**
	 *
	 * @return	int
	 */
	public function getRepliedCode()
	{
		return (int) $this->repliedCode;
	}


	/**
	 *
	 * @return	void
	 * @param	string[optional] $host	The host that is sent along with the HELO command. In reality this can be anything, but we use the host as an ID.
	 */
	private function helo($host = null)
	{
		// check input. we won't throw an error on empty input but fill in the http host instead.
		if($host === null) $host = $_SERVER['HTTP_HOST'];

		// push HELO command
		$this->say('HELO '. $host);

		// check if HELO failed
		return ($this->repliedCode === 250) ? true : false;
	}


	/**
	 *
	 * @return	string
	 */
	private function listen()
	{
		return (string) @fgets($this->connection, 515).'<br />';
	}


	/**
	 *
	 * @return	bool
	 * @param	string $email	The sender's e-mail address
	 */
	public function mailFrom($email)
	{
		// check input
		if(!SpoonFilter::isEmail($email)) throw new SpoonEmailException('No valid email given for '. __METHOD__);

		// push MAIL FROM command
		$this->say('MAIL FROM:<'.$email.'>');

		// smtp code 250 means success
		return ($this->repliedCode === 250) ? true : false;
	}


	/**
	 *
	 * @return	void
	 */
	public function quit()
	{
		// push QUIT command
		$this->say('QUIT');

		// smtp code 221 means success
		return ($this->repliedCode === 221) ? true : false;
	}


	/**
	 *
	 * @return	bool
	 * @param	string $email	The recipient's e-mail address
	 */
	public function rcptTo($email)
	{
		// check input
		if(!SpoonFilter::isEmail($email)) throw new SpoonEmailException('No valid email given for '. __METHOD__);

		// push MAIL FROM command
		$this->say('RCPT TO: <'.$email.'>');

		// smtp code 250 means success
		return ($this->repliedCode === 250) ? true : false;
	}


	/**
	 *
	 * @return	void
	 * @param	string[optional] $reply	The host's reply from the last sent request
	 */
	private function saveReply($reply = null)
	{
		// no reply given means we listen for a fresh one
		if($reply === null) $reply = $this->listen();

		// store reply
		$this->replies .= $reply;
	}


	/**
	 *
	 * @return	int
	 * @param	string $message	The command message to send to the SMTP host
	 */
	private function say($message = null)
	{
		// say something to the host
		if(fputs($this->connection, $message . self::CRLF) === false) throw new SpoonEmailException('Failed to communicate with the SMTP server.');

		// listen to the reply and store it
		$reply = $this->listen();

		// save for debugging
		$this->saveReply($reply);

		// update the latest status code and return it
		return (int) $this->repliedCode = $this->getCode($reply);
	}


	/**
	 *
	 * @return	bool
	 * @param	string[optional] $data		The e-mail body to be sent to the SMTP host
	 */
	public function send($data = null)
	{
		// push the DATA command
		$this->say('DATA');

		// code 354 means we can continue
		if($this->repliedCode === 354)
		{
			// push our data
			$this->say($data . self::CRLF . '.');

			// code 250 means the mail has been sent
			return ($this->repliedCode === 250) ? true : false;
		}
	}


	/**
	 *
	 * @return	void
	 * @param string $layer
	 */
	public function setSecurity($layer)
	{
		$this->security = $layer;
	}


	/**
	 *
	 * @return	bool
	 */
	private function startTLS()
	{
		// push STARTTLS command
		$this->say('STARTTLS');

		// stop here if we couldn't initiate TLS
		if($this->repliedCode === 454) throw new SpoonEmailException('TLS is temporarily not available for this host, please try again later.');

		// enable TLS client encrypting for our connection
		if(!stream_socket_enable_crypto($this->connection, true, STREAM_CRYPTO_METHOD_TLS_CLIENT))
		{
			// crypto method not enabled
			throw new SpoonEmailException('TLS encryption failed to initialize, please try again.');
		}

		// smtp code 220 means success
		return ($this->repliedCode === 220) ? true : false;
	}
}

?>