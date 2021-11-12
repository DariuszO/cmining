<?php
error_reporting(0);
class jsonRPCClient {
	
	/**
	 * Debug state
	 *
	 * @var boolean
	 */
	private $debug;
	
	/**
	 * The server URL
	 *
	 * @var string
	 */
	private $url;
	/**
	 * The request id
	 *
	 * @var integer
	 */
	private $id;
	/**
	 * If true, notifications are performed instead of requests
	 *
	 * @var boolean
	 */
	private $notification = false;
	/** 
	 * Username for http auth
	 * @var string
	 */
	private $username = null;
	/**
	 * Password for http auth
	 * @var string
	 */
	private $password = null;
	
	/**
	 * Takes the connection parameters
	 *
	 * @param string $url
	 * @param boolean $debug
	 */
	public function __construct($url,$debug = false) {
		// server URL
		$this->url = $url;
		// proxy
		empty($proxy) ? $this->proxy = '' : $this->proxy = $proxy;
		// debug state
		empty($debug) ? $this->debug = false : $this->debug = true;
		// message id
		$this->id = 1;
		
		if (!isset($_GLOBALS['jsonRpc-cookies']))
		{
			$_GLOBALS['jsonRpc-cookies'] = array();
		}
	}
	
	/**
	 * Sets the notification state of the object. In this state, notifications are performed, instead of requests.
	 *
	 * @param boolean $notification
	 */
	public function setRPCNotification($notification) {
		empty($notification) ?
							$this->notification = false
							:
							$this->notification = true;
	}
	
	/**
	 * Performs a jsonRCP request and gets the results as an array
	 *
	 * @param string $method
	 * @param array $params
	 * @return array
	 */
	public function __call($method,$params) {
		$debug = null;
		// check
		if (!is_scalar($method)) {
			throw new Exception('Method name has no scalar value');
		}
		
		// check
		if (is_array($params)) {
			// no keys
			$params = array_values($params);
		} else {
			throw new Exception('Params must be given as array');
		}
		
		// sets notification or request task
		if ($this->notification) {
			$currentId = NULL;
		} else {
			$currentId = $this->id;
		}
		
		// prepares the request
		$request = array(
						'method' => $method,
						'params' => $params,
						'jsonrpc'=>	"2.0",
						'id' => $currentId
						);
		$request = json_encode($request);
		$this->debug && $debug.='***** Request *****'."\n".$request."\n".'***** End Of request *****'."\n\n";
		
		// performs the HTTP POST
		$opts = array ('http' => array (
							'method'  => 'POST',
							'header'  => 'Content-type: application/json\r\n',										 
							'content' => $request
		));		
		if ($this->username)
		{
			$opts['http']['header'] .= 'Authorization:Basic '.base64_encode($this->username.':'.$this->password).'\r\n';
		}
		foreach ($_GLOBALS['jsonRpc-cookies'] as $cookieName => $cookieObj)
		{
			$opts['http']['header'] .= 'Cookie:'.$cookeName.'='.$cookieObj[$cookeName].';\r\n';
		}
		
		$context  = stream_context_create($opts);
		if ($fp = fopen($this->url, 'r', false, $context)) {
			
			#$http_response_header;
			$cookies = findq('Set-Cookie:',$http_response_header);
			foreach ($cookies as $cookie)
			{
				$values = split(';',substr($cookie,12));
				$cookieAr = array();
				$cookieArName = null;
				foreach ($values as $idx=>$value) 
				{
					list($key, $val) = split('=',$value);
					if ($idx == 0)
					{
						$cookieArName = $key;
					}
						
					$cookieAr[trim($key)] = trim($val);					
				}
				$_GLOBALS['jsonRpc-cookies'][$cookieArName] = $cookieAr;
			}
#			print_r($_GLOBALS);exit;
			$response = '';
			while($row = fgets($fp)) {
				$response.= trim($row)."\n";
			}
			$this->debug && $debug.='***** Server response *****'."\n".$response.'***** End of server response *****'."\n";
			$response = json_decode($response,true);
		} else {
			throw new Exception('Unable to connect to '.$this->url);
		}
		
		// debug output
		if ($this->debug) {
			print_r($opts);
			echo $debug;
		}
		
		// final checks and return
		if (!$this->notification) {
			// check
			if ($response['id'] != $currentId) {
				throw new Exception('Incorrect response id (request id: '.$currentId.', response id: '.$response->id.')');
			}
			if (isset($response['error']) && !is_null($response->error)) {
				throw new Exception('Request error: '.$response->error);
			}
			
			return $response['result'];
			
		} else {
			return true;
		}
	}
	/**
	 * Set authparams
	 * @param string $username
	 * @param string $password
	 */
	public function setAuthParams($username, $password=null)
	{
		$this->username = $username;		
		$this->password = $passord;
	} 
}


function findq ($string, $array = array ())
{
	foreach ($array as $key => $value) {
		unset ($array[$key]);
		if (strpos($value, $string) !== false) {
			$array[$key] = $value;
		}
	}
	return $array;
}