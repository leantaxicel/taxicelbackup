<?PHP
App::uses('Component', 'Controller');
//App::import('Vendor','Thumbnail' ,array('file'=>'thumbnail.class.php'));
#################################################################################
## Developed by Mind Scale Technologies Pvt. Ltd.                              	##
## http://www.mindscale.co.in                                          			##
#################################################################################

/**
 * @category Apple Push Notification Service using PHP & MySQL
 * @package EasyAPNs
 * @author Peter Schmalfeldt <manifestinteractive@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link http://code.google.com/p/easyapns/
 */

/**
 * Begin Document
 */

class DhubiosComponent extends Component {
	/**
	* Production or Sandbox app
	* @var string
	* @access private
	*/	       
	private $DEVELOPMENT = 'sandbox'; // or 'sandbox/production'
	
	/**
	* PEM file for both users
	*/ 
	private $customerPEM = 'push_dev.pem';
	private $customerPassword = '12345abcd';
	
	private $driverPEM = 'Push_Driver.pem'; // 
	private $driverPassword = '#abcd123'; //
	private $siteurl = "http://localhost/DHub/Website";
	
	/**
	* Production Credentials
	*
	* @var string
	* @access private
	*/
	//private $certificate = 'typo3conf/ext/dash_limo_service/Classes/APNS/';				      
	private $certificate = 'http://localhost/DHub/Website/app/Controller/Component/';			      
	private $ssl = 'ssl://gateway.push.apple.com:2195';

	/**
	* Sandbox Credentials
	*
	* @var string
	* @access private
	*/
	//private $sandboxCertificate = 'typo3conf/ext/dash_limo_service/Classes/APNS/'; 
	// http://localhost/DashLS/push_dev.pem	      
	private $sandboxCertificate = 'http://localhost/DHub/Website/app/Controller/Component/';
	// http://localhost/DashLS/push_dev.pem	      
	private $sandboxSsl = 'ssl://gateway.sandbox.push.apple.com:2195';
	
	
	private $receiver;
	private $body = array();
	
	function __construct() {
		
	}
	
	// Array format have to be
	# devicetype => 1,
	# devicepushid => 2542tgetfgerg242casdasd23412334,
	# deviceuniquid => 3452345345345345435435367568
	# type => CUSTOMER/DRIVER
	public function to( $userdata ) {
		$this->receiver = $userdata;
	}
	
	public function addMessageAlert( $message, $badge = null, $sound = null ) {
		$this->body = array();
		$this->body['aps'] = array('alert' => $message);
		if ($badge)
			$this->body['aps']['badge'] = "1";
		if ($sound)
			$this->body['aps']['sound'] = "g"; //no need to send, iphone developers playing the sound;
			
	}
	
	public function addMessageCustom( $key, $val ) {
		$this->body['aps'][$key] = $val;
	}
	
	public function process() {
		
		# Validate, whether to use certificate for customer or driver
		$PEM_FILE = '';
		switch( $this->receiver['type'] ) {
			
			case "CUSTOMER":
				$PEM_FILE = $this->customerPEM;
				$pass = $this->customerPassword;
				break;
			case "DRIVER":
				$PEM_FILE = $this->driverPEM;
				$pass = $this->driverPassword;
				break;
		}
		
		$push_url = $this->sandboxSsl;
		$certificate = PATH_site.$this->sandboxCertificate.$PEM_FILE;
		//$pass = $this->sandboxPassphrase;
		
		if( $this->DEVELOPMENT == 'production' ) {
			$push_url = $this->ssl;
			$certificate = PATH_site.$this->certificate.$PEM_FILE;
			//$pass = $this->passphrase;
		}
		
		/* print_r( $this->body );
		echo PATH_site.'#'.$push_url.'#'.$certificate.'#'.$pass.'#'.$this->receiver['devicepushid'];
		die(); */
		
		/* End of Configurable Items */
		$ctx = stream_context_create();
		stream_context_set_option( $ctx, 'ssl', 'local_cert', $certificate );
		
		// assume the private key passphase was removed.
		stream_context_set_option($ctx, 'ssl', 'passphrase', $pass);
		$fp = stream_socket_client( $push_url, $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx );

		if (!$fp) {
			//print "Failed to connect $err $errstr";
			return false;
		} 
		$payload = json_encode($this->body);

		$msg = chr(0) . pack("n",32) . pack('H*', str_replace( ' ', '', $this->receiver['devicepushid'] )) . pack("n",strlen($payload)) . $payload;
		//print "sending message :" . $payload . "n";
		fwrite($fp, $msg);
		fclose($fp);
		
		return true;
		
	}

}
?>