<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
// Specify domains from which requests are allowed
header('Access-Control-Allow-Origin: *');

// Specify which request methods are allowed
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

// Additional headers which may be sent along with the CORS request
// The X-Requested-With header allows jQuery requests to go through
header('Access-Control-Allow-Headers: X-Requested-With');


App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('Session');
	public $helpers = array('Session');
/**
 * common param for hole site
 */
	//public $CustomerAppkey = "AIzaSyCnTIFQyUNmMTo0MKCo4bdkVybGh2RoT2M";
	//public $DriverAppkey = "AIzaSyCiSStcxtiPYJlrBR3cmJ34EGYXHfUS07I";
	//public $adminToEmail = "samantaray.anup@mindscale.co.in";
	
	//get the map sever key for used the google map functionality
	public $googleServerKey="";//AIzaSyBmoRt5gXU6nGN8AbLGZe3qdDuu4z2nE3s
	public $curentactivecountrycode="ar";
	
	//new section
	public $CustomerAppkey = "";//"AIzaSyDik8e32gJnVMDYJuijG15haLbDMkx-eZk";
	public $DriverAppkey = "";//"AIzaSyCVxWdfffgvWUgw91HtY9CMqM_CpPQuVBc";
	
	public $sitelimit = 0;//15;
	public $adminFromEmail = "taxiceladmin@taxicel.com";//"taxiceladmin@taxicel.com";
	
	public $adminToEmail = "";//"mrintoryal@gmail.com";
	public $usercurrentcreditminlimit=0;//200;
	public $driverfindrange=50000;
	
	public $iosPushInSandBoxMode=1;//1=development mode 0=live mode

/**
 * footer blog method
 *
 * @return void
 */
	
	public function blogFooter(){
		$this->loadModel('Blog');
		$bl=$this->Blog->find('all',array(
			'limit'=>'2',
			'order' => array('Blog.id' => 'DESC')
		));
		$this->set('blogFooter',$bl);
	}
/**
  * appandroidpushnotify
  */
	public function appandroidpushnotify ($registration_ids=array(),$appkey=null,$textmsg='',$custom=array(),$isCancel=0){
	//pr($registration_ids);
	//pr($appkey);
		if(count($registration_ids)>0 && $appkey!=null){
			$push_message = array(
				"notification"=>array(
					"message"=>$textmsg,
					'custom'=>$custom,
					'iscancel'=>$isCancel,
				)
			);
			// uper porsion code come here 
			$url = 'https://android.googleapis.com/gcm/send';

			$fields = array(
				'registration_ids' => $registration_ids,
				'data' => $push_message
			);

			$headers = array(
				'Authorization: key=' .$appkey,
				'Content-Type: application/json'
			);
			// Open connection
			$ch = curl_init();
			// Set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// Disabling SSL Certificate support temporarly
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			// Execute post
			$result = curl_exec($ch);
			//pr($result);
			curl_close($ch);
			//print_r($result);
			if ($result === FALSE) {
				//die('Curl failed: ' . curl_error($ch));
				return false;
			}
				return true;
		}
		return false;
	}
	
/**
  * iospushnotification method
  * @param string $pushid
  */
	public function iospushnotification($pushid="", $alert="", $data=array(), $sound=1,$user_type=0,$company_id='1'){
		//create test notification for ios
		//pem file path
		$pemfilepath = WWW_ROOT."files/iospushnotification/";
		if($company_id==1){
			$development_driver_pemfilename = "development_Driver_Push_Cer.pem";
			$production_driver_pemfilename="production_Driver_Push_Cer.pem";
			$development_customer_pemfilename = "development_Customer_Push_Cer.pem";
			$production_customer_pemfilename="production_Customer_Push_Cer.pem";
			$pempassword = "mindscaleTaxicel";
		}
		else{
			$development_driver_pemfilename = "development_Driver_Push_Cer.pem";
			$production_driver_pemfilename="production_Driver_Push_Cer.pem";
			$development_customer_pemfilename = "development_Customer_Push_Cer.pem";
			$production_customer_pemfilename="production_Customer_Push_Cer.pem";
			$pempassword = "mindscaleTaxicel";
		}
		
		$sandboxSsl = 'ssl://gateway.sandbox.push.apple.com:2195';
		$productssl = 'ssl://gateway.push.apple.com:2195';
		$PEM_FILE='';
		$push_url='';
		if($this->iosPushInSandBoxMode==1){
			//development section
			if($user_type==1){
				//driver get notification
				$PEM_FILE = $pemfilepath.$development_driver_pemfilename;
			}
			elseif($user_type==2){
				//customer get notification
				$PEM_FILE = $pemfilepath.$development_customer_pemfilename;
			}
			else{
				return false;
			}
			$push_url = $sandboxSsl;
		}
		else{
			//live section or production section
			if($user_type==1){
				//driver get notification
				$PEM_FILE = $pemfilepath.$production_driver_pemfilename;
			}
			elseif($user_type==2){
				//customer get notification
				$PEM_FILE = $pemfilepath.$production_customer_pemfilename;
			}
			else{
				return false;
			}
			$push_url = $productssl;
		}
		
		$certificate = $PEM_FILE;
		$devicepushid = $pushid;
		if($certificate=='' || $devicepushid==''){
			return false;
		}
		//echo $certificate;
		
		//message array
		$msg = array(
				'aps'=>array(
				'badge'=>'1',
				'alert'=>$alert //'push notification send'
			)
		);
		//sound
		if($sound){
			$msg['aps']['sound']='1';  
		}
		//hide the notification view in device
		$hidenot = 1;
		if($hidenot){
			//$msg['aps']['content-available'] = 1;
		}

		if(isset($data) && is_array($data) && count($data)>0){
			foreach($data as $key=>$val){
				$msg['aps'][$key]=$val; 
			}
		}
		//main configaration
		$ctx = stream_context_create();
		stream_context_set_option( $ctx, 'ssl', 'local_cert', $certificate );
		// assume the private key passphase was removed.
		stream_context_set_option($ctx, 'ssl', 'passphrase', $pempassword);
		$fp = stream_socket_client( $push_url, $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx );
		if(!$fp){
			//print "Failed to connect $err $errstr";
			//open when used in function
			return false;
		}
		$payload = json_encode($msg);
		$mssg = chr(0).pack("n",32).pack('H*', str_replace(' ', '', $devicepushid )).pack("n",strlen($payload)).$payload;
		//print "sending message :" . $payload . "n";
		$result = fwrite($fp, $mssg,strlen($mssg));
		fclose($fp);
		return true;
		//send message
	}

/**
* Utility method to calculate the distance and duration between two location
*/
	function getDistanceAndDuration( $pick_up_lat, $pick_up_lon, $drop_off_lat, $drop_off_lon, $googlekey='' ){

		if($googlekey!=''){
			$url="https://maps.googleapis.com/maps/api/directions/json?origin=".$pick_up_lat.",".$pick_up_lon."&destination=".$drop_off_lat.",".$drop_off_lon."&mode=driving&key=".$googlekey;
		}
		else{
			$url="https://maps.googleapis.com/maps/api/directions/json?origin=".$pick_up_lat.",".$pick_up_lon."&destination=".$drop_off_lat.",".$drop_off_lon."&sensor=false&mode=driving";
		}
		$result = json_decode(file_get_contents($url));

		// If we got directions, output all of the HTML instructions
		if ($result->status === 'OK') {
			$route = $result->routes[0];
			$dis = $route->legs[0]->distance->value;//meter unit
			$distance = $dis/1000;// in km distance
			$duration = $route->legs[0]->duration->value;// seconds
			
			$hh = intval($duration/3600);
			$remain = intval($duration%3600);
			$mm = intval($remain/60);
			$ss = intval($remain%60);
			$fomrmatDuration = $hh.".".$mm;
			/*$retData=array(
				"status"=>1,
				"duration"=>number_format(round($duration/60),0,'.',''),
				"distance"=>$distance,
				"durationinminit"=>number_format(round($duration/60),0,'.','')
			);*/
			$retData=array(
				"status"=>1,
				"duration"=>round($duration/60),
				"distance"=>round($distance),
				"durationinminit"=>round($duration/60)
			);
		} else {
			$retData=array("status"=>0,"message"=>"faild to fetch data");
		}
		return $retData;
	}
	//nearest driver find 
	public function getNearestdrivers($pickuplat='',$pickuplong='',$radius=10000,$isretrnall=0,$ignoredriverid=0,$company_id=1){
		//radius in meter
		//load driver model
		
		$this->loadModel('DriverCustom');
		if($isretrnall==1){
			//find all nearest drivers
			$selectObj = "SELECT DriverCustom.*,User.*,(ROUND( DEGREES( ACOS( SIN( RADIANS( '".$pickuplat."' ) ) * SIN( RADIANS( DriverCustom.lat ) ) + COS( RADIANS('".$pickuplat."') ) *
			COS( RADIANS( DriverCustom.lat ) ) * COS( RADIANS( '".$pickuplong."' - DriverCustom.long ) ) ) ) , 4 ) *60 * 1.1515 * 1.6*1000) distance";
			
			$from = " FROM tc_driver_customs as DriverCustom,tc_users User";
			$whereObj = " WHERE DriverCustom.user_id=User.id AND DriverCustom.status='1' AND DriverCustom.user_id!='".$ignoredriverid."' AND DriverCustom.vehicle_detail_id>0 AND DriverCustom.device_unique_id!='' AND User.company_id='".$company_id."' HAVING distance < '".$radius."' ORDER BY distance ASC";
		}
		else{
			//find nearest only one driver
			$selectObj = "SELECT DriverCustom.*,(ROUND( DEGREES( ACOS( SIN( RADIANS( '".$pickuplat."' ) ) * SIN( RADIANS( DriverCustom.lat ) ) + COS( RADIANS('".$pickuplat."') ) *
			COS( RADIANS( DriverCustom.lat ) ) * COS( RADIANS( '".$pickuplong."' - DriverCustom.long ) ) ) ) , 4 ) *60 * 1.1515 * 1.6*1000) distance";
			
			$from = " FROM tc_driver_customs as DriverCustom,tc_users User";
			
			$whereObj = " WHERE DriverCustom.user_id=User.id AND DriverCustom.status='1' AND DriverCustom.user_id!='".$ignoredriverid."' AND DriverCustom.vehicle_detail_id>0 AND DriverCustom.device_unique_id!='' AND User.company_id='".$company_id."' HAVING distance < ".$radius." LIMIT 10";
		}
		
		$query = $selectObj.$from.$whereObj;
		
		$drivers = $this->DriverCustom->query($query);
		
		return $drivers;
	}
	
	function clearAllCache(){
		clearCache();
		$files = glob(CACHE.'models/*'); // get all file names
		foreach($files as $file){ // iterate files
		  if(is_file($file)){
			unlink($file);
		  }
		}
	}
	
	//log file genarate
	public function write_log($postdata) {
		// Determine log file
		// checking if the constant for the log file is defined
		//$filepath =  FULL_BASE_URL.$this->base."/logfile/default.log";
		$logfile = "../default.log";
		// Get time of request
		if( ($time = $_SERVER['REQUEST_TIME']) == '') {
		  $time = time();
		}
	       
		// Get IP address
		if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
		  $remote_addr = "REMOTE_ADDR_UNKNOWN";
		}
	       
		// Get requested script
		if( ($request_uri = $_SERVER['REQUEST_URI']) == '') {
		  $request_uri = "REQUEST_URI_UNKNOWN";
		}
	       
		// Format the date and time
		$date = date("Y-m-d H:i:s", $time);
		$message = json_encode($postdata);
		// Append to the log file
		if($fd = @fopen($logfile,"a")) {
			fputcsv($fd, array("\n"));	
		  $result = fputcsv($fd, array($date, $remote_addr, $request_uri,$message));
		  fclose($fd);
		}
	}
	
	//server detect as local
	public function serverDetect(){
		$serverhost = $_SERVER["HTTP_HOST"];
		if($serverhost=="localhost" || $serverhost=="192.168.1.19"){
			return true;	
		}
		else{
			return false;
		}	
	}
	
	//genarate refferal code
	public function generaterefferalcode(){
		$this->loadModel('User');
		// CREATING RANDOM REFERER CODE
		$alpha1 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$ALPHAM1 = $alpha1[array_rand($alpha1, 1)];
		$alpha2 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$ALPHAM2 = $alpha2[array_rand($alpha2, 1)];
		$alpha3 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$ALPHAM3 = $alpha3[array_rand($alpha3, 1)];
		$randCode = $ALPHAM1.$ALPHAM2.$ALPHAM3.rand(99,999);
		$refferalcount = $this->User->find('count',array('recursive'=>'0','conditions'=>array('User.my_refferal_code'=>$randCode)));
		if(isset($refferalcount) && $refferalcount>0){
			$randCode = $this->generaterefferalcode();
		}
		return $randCode;
	}
	
	public function duplicateemail($email=''){
		$this->loadModel('User');
		//email formation validate
		if(filter_var($email,FILTER_VALIDATE_EMAIL)){
			$emailfound = $this->User->find('count',array('recursive'=>'0','conditions'=>array('User.email'=>$email)));
			if(isset($emailfound) && $emailfound>0){
				return true;
			}
		}
		else{
			return true;		
		}
		
		return false;
	}
	
	public function validateCuponCode($user_id=0,$cupon_code=''){
		$this->loadModel('Ride');
		$this->loadModel('Cupon');
		$cuponcond = array(
			'Cupon.cupon_code'=>$cupon_code
		);
		$cuponoption = array(
			'conditions'=>$cuponcond
		);
		$validcupon = $this->Cupon->find('count',$cuponoption);
		if(isset($validcupon) && $validcupon>0){
			$ridecond = array(
				'Ride.user_id'=>$user_id,
				'Ride.cupon_code'=>$cupon_code
			);
			$ridecond = array(
				'conditions'=>$ridecond
			);
			$existingridecount = $this->Ride->find('count',$ridecond);
			/* if(isset($existingridecount) && $existingridecount>0){
				die(json_encode(array('status'=>'0','msg'=>"You've already used this coupon code.")));
			}else{ */
				$cuponDetails = $this->Cupon->find('first',$cuponoption);
				$discount = $cuponDetails['Cupon']['discount'];
				return $discount;
			//}
		}else{
			die(json_encode(array('status'=>'0','msg'=>'Invalid coupon code.')));
		}
	}
	
	public function siteconfiguration($company_id=1){
		//load the model which one required
		$this->loadModel('Configuration');
		$configuration = $this->Configuration->find('first',array('conditions'=>array('Configuration.company_id'=>$company_id)));
		if(is_array($configuration) && count($configuration)>0){
			//pr($configuration);
			$this->googleServerKey=$configuration['Configuration']['googlekey'];
			$this->CustomerAppkey=$configuration['Configuration']['andro_customer_push_key'];
			$this->DriverAppkey=$configuration['Configuration']['andro_driver_push_key'];
			$this->usercurrentcreditminlimit=$configuration['Configuration']['initial_earning'];
			$this->adminFromEmail=$configuration['Configuration']['fromemail'];
			$this->adminToEmail=$configuration['Configuration']['toemail'];
			$this->sitelimit=$configuration['Configuration']['reclimit'];
			$this->driverfindrange=$configuration['Configuration']['driverfindrange'];
		}
	}
	
	public function ridecommitionsetting($company_id=1){
		$this->loadModel('PaymentSetting');
		$ridecommitionsetting = array();
		$ridecommition = $this->PaymentSetting->find('first',array('conditions'=>array('PaymentSetting.company_id'=>$company_id)));
		if(is_array($ridecommition) && count($ridecommition)>0){
			$ridecommitionsetting = array_slice($ridecommition['PaymentSetting'],1);
		}
		return $ridecommitionsetting;
	}
	
	//admin session validation section
	public function adminsessionvalidation(){
		if( !$this->Session->read('admin_id')) {
			$this->redirect( array('controller' => 'Pages', 'action' => 'login','admin' => true) );
		}
	}
	
	//encript the email and id for forgot pass word
	function encriptlinkstr($email='',$encriptbase=''){
		//encode with 64 base encode
		$encriptstr = $encriptbase."-".$email;
		$encriptedstr = base64_encode($encriptstr);
		return $encriptedstr;
	}
	function decriptlinkstr($encriptedlink=''){
		$encriptedlink = (isset($encriptedlink) && $encriptedlink!='')?$encriptedlink:'';
		//$encriptedlink = $_REQUEST['encriptedlink'];
		$encriptstr = base64_decode($encriptedlink);
		$encripteddataarray = explode("-",$encriptstr);
		//die(json_encode($encripteddataarray));
		return $encripteddataarray;
	}
	
	public function userrattingsection($userid=0,$type=0){
		$ratting=0;
		if($userid>0 && $type>0){
			$this->loadModel('UserRideRating');
			//bind and unbind the Model
			$this->UserRideRating->unbindModel(array('belongsTo'=>array('Ride','Driver','Customer')));
			if($type==1){
				//driver
				$fields = array('IFNULL(sum(UserRideRating.driver_rating)/count(UserRideRating.id),0) userratting');
				$cond = array('UserRideRating.driver_id'=>$userid);
			}
			else{
				//customer
				$fields = array('IFNULL(sum(UserRideRating.customer_rating)/count(UserRideRating.id),0) userratting');
				$cond = array('UserRideRating.customer_id'=>$userid);
			}
			$userrating = $this->UserRideRating->find('first',array('recursive'=>'0','conditions'=>$cond,'fields'=>$fields));
			list($userrating) = $userrating;
			if(isset($userrating) && isset($userrating['userratting'])){
				$ratting = number_format($userrating['userratting']>5?5:$userrating['userratting'],1);
			}
			
		}
		return $ratting;
	}
	public function chargecreditcard($card_id=0,$amount=0,$company_id=1){
		$status=0;
		$transactionid=0;
		if($card_id==0 || $amount==0){
			$status=1;	
		}
		return array('status'=>$status,'transactionid'=>$transactionid);
	}
	
	//driver session hanler
	public function driversessionchecked(){
		if( !$this->Session->check('driver_id')) {
			$this->redirect( array('controller' => 'Pages', 'action' => 'login','driver'=>true) );
		}
	}
	public function homepageredirect(){
		$params = $this->params->params;
		$prefix = isset($params['prefix'])?$params['prefix']:'';
		if(strtolower($prefix)=="admin"){
			$this->redirect( array('controller' => 'Dashboards','admin'=>true) );	
		}
		elseif(strtolower($prefix)=="driver"){
			$this->redirect( array('controller' => 'Dashboards','driver'=>true) );	
		}
		else{
			$this->Session->destroy();
			$this->redirect( array('controller' => 'Pages') );
		}
	}
	public function cardinfosavedinpayu($card_id=0){
		//load model
		$status=0;
		$savedcardinfo=array();
		/*$this->loadModel('UserCreditDetail');
		//unbind model
		$this->UserCreditDetail->unbindModel(array('belongsTo'=>array('User')));
		$cardinfo = $this->UserCreditDetail->find('first',array('conditions'=>array('UserCreditDetail.id'=>$card_id)));
		if(is_array($cardinfo) && count($cardinfo)>0){
			//pr($cardinfo);
			$cardno = $cardinfo['UserCreditDetail']['credit_card_no'];
			$holdername = $cardinfo['UserCreditDetail']['holdername'];
			$cardno = "4111111111111111";
			$expirydate = $cardinfo['UserCreditDetail']['expirydate'];
			$cvvno = $cardinfo['UserCreditDetail']['cvvno'];
			$postcode = $cardinfo['UserCreditDetail']['postcode'];
			$address = $cardinfo['UserCreditDetail']['address'];
			$cardtypename = $cardinfo['UserCreditDetail']['cardtypename'];
			$user_id = $cardinfo['UserCreditDetail']['user_id'];
			//marchent detals
			$APILOGIN = "11959c415b33d0c";
			$APIKEY = "6u39nqhq8ftd0hlvnjfs66eh8c";
			//curl implementation
			$testmode = true;
			if($testmode){
				$payuurl = "https://stg.api.payulatam.com/payments-api/4.0/service.cgi";//PAYMENT
				$reporturl = "https://stg.api.payulatam.com/reports-api/4.0/service.cgi";//REPORT
			}
			else{
				$payuurl = "https://api.payulatam.com/payments-api/4.0/service.cgi"; //PAYMENT
				$reporturl = "https://api.payulatam.com/reports-api/4.0/service.cgi"; //report
			}
			//site header set
			$headers = array(
				'Content-Type:application/json ',
				'charset = utf-8 ',
				'Accept:application/json',
				'Content-Length:'
			);
			
			/\*
				Content-Type: application / json; charset = utf-8
Accept: application / json
Content-Length: length
{
"Test": false,
"Language", "in"
"Command": "GET_PAYMENT_METHODS"
"Merchant":
{
"ApiLogin": "xxxxxxxxxxxxx"
"Apikey": "xxxxxxxxxxxxx"
}
			*\/
			//saved card information 
			$postteddata = array(
				"Language"=>"in",
				"Command"=>"CREATE_TOKEN",
				'Test'=>$testmode,
				"Merchant"=>array(
				   "ApiLogin"=>$APILOGIN,
				   "Apikey"=>$APIKEY,
				),
				"CreditCardToken"=>array(
				   "PayerID"=>$user_id,
				   "Name"=>"tetststs ttt",
				   "IdentificationNumber"=>"32144457",
				   "Payment Method"=>"VISA",
				   "Number"=>$cardno,
				   "ExpirationDate"=>"2019/01"
				),
			);
			$addres = array(
				"street1"=>"Viamonte",
				"street2"=>"1366",
				"city"=>"Buenos Aires",
				"state"=>"Buenos Aires",
				"country"=> "AR",
				"postalCode"=>"0000000",
				"phone"=> "7563126"
			);
			//payment section
			$signature = "hfgfh5654juj";//6dcd21f14036ad057988089df9a28434
			$postteddata = array(
				"language"=> "en",
				"command"=> "SUBMIT_TRANSACTION",
				"merchant"=>array(
				       "apiKey"=> $APIKEY,
					"apiLogin"=>$APILOGIN
				),
				"transaction"=>array(
				   "order"=>array(
				      "accountId"=>"509171",
				      "referenceCode"=>"payment_test_00000001",
				      "description"=>"payment test",
				      "language"=>"en",
				      "signature"=>$signature,
				      "notifyUrl"=>"",
				      "additionalValues"=>array(
					 "TX_VALUE"=>array(
					    "value"=>1,
					    "currency"=>"ARS"
					 )
				      ),
				      "buyer"=>array(
					 "merchantBuyerId"=>"1",
					 "fullName"=>"First name and second buyer name",
					 "emailAddress"=>"mrintoryal@gmail.com",
					 "contactPhone"=>"7563126",
					 "dniNumber"=>"",
					 "shippingAddress"=>$addres
				      ),
				      "shippingAddress"=>$addres
				   ),
				   "payer"=>array(
				      "merchantPayerId"=>"1",
				      "fullName"=>"First name and second payer name",
				      "emailAddress"=>"mrintoryal@gmail.com",
				      "contactPhone"=>"7563126",
				      "dniNumber"=>"",
				      "billingAddress"=>$addres
				   ),
				   "creditCard"=>array(
				      "number"=>"4111111111111111",
				      "securityCode"=>"123",
				      "expirationDate"=>"2019/12",
				      "name"=>"mrin test"
				   ),
				   "extraParameters"=>array(
				      "INSTALLMENTS_NUMBER"=>1
				   ),
				   "type"=>"AUTHORIZATION_AND_CAPTURE",
				   "paymentMethod"=>"VISA",
				   "paymentCountry"=> "AR",
			     
				   "deviceSessionId"=> "vghs6tvkcle931686k1900o6e1",
				   "ipAddress"=>"127.0.0.1",
				   "cookie"=>"cookie_52278879710130",
				   "userAgent"=> "Firefox"
				),
				"test"=>true
			);
			$postteddata  = json_encode($postteddata);
			$headers = array(
				'Content-Type:application/json ',
				'charset = utf-8 ',
				'Accept:application/json',
				'Content-Length:'.strlen($postteddata)
			);
			pr($headers);
			pr($postteddata);
			
			
			$ch = curl_init();
			//set option
			curl_setopt($ch,CURLOPT_URL,$payuurl); //url setting
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//hhttp support ssl true
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch,CURLOPT_HEADER,$headers);
			curl_setopt($ch,CURLOPT_POST,true);// servet interaction method
			curl_setopt($ch,CURLOPT_POSTFIELDS,$postteddata);
			$result = curl_exec($ch);
			curl_close($ch);
			pr($result);
			/*
			$fields = array(
				'registration_ids' => $registration_ids,
				'data' => $push_message
			);

			$headers = array(
				'Authorization: key=' .$appkey,
				'Content-Type: application/json'
			);
			// Open connection
			$ch = curl_init();
			// Set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// Disabling SSL Certificate support temporarly
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			// Execute post
			$result = curl_exec($ch);
			//pr($result);
			curl_close($ch);
			*\/
		}*/
		return array('status'=>$status,'savedcardinfo'=>$savedcardinfo);
	}
	//edited on 06072015
	public function admininvalidpath(){
		$this->Session->setFlash(__('Invalid Request'));
		$this->redirect(array('controller'=>'Dashboards','admin'=>true));
	}
	
	public function getNearestcustomers($driverlat='',$driverlong='',$radius=10000,$isretrnall=0,$ignoredriverid=0,$company_id=1){
		//radius in meter
		//load driver model
		
		$this->loadModel('CustomerCustom');
		if($isretrnall==1){
			//find all nearest drivers
			$selectObj = "SELECT CustomerCustom.*,User.*,(ROUND( DEGREES( ACOS( SIN( RADIANS( '".$driverlat."' ) ) * SIN( RADIANS( CustomerCustom.lat ) ) + COS( RADIANS('".$driverlat."') ) *
			COS( RADIANS( CustomerCustom.lat ) ) * COS( RADIANS( '".$driverlong."' - CustomerCustom.long ) ) ) ) , 4 ) *60 * 1.1515 * 1.6*1000) distance";
			
			$from = " FROM tc_customer_customs as CustomerCustom,tc_users User";
			$whereObj = " WHERE CustomerCustom.user_id=User.id AND User.is_active='1' AND CustomerCustom.user_id!='".$ignoredriverid."' AND CustomerCustom.device_unique_id!='' AND User.company_id='".$company_id."' HAVING distance < '".$radius."' ORDER BY distance ASC LIMIT 30";
		}
		else{
			//find nearest only one driver
			$selectObj = "SELECT CustomerCustom.*,User.*,(ROUND( DEGREES( ACOS( SIN( RADIANS( '".$driverlat."' ) ) * SIN( RADIANS( CustomerCustom.lat ) ) + COS( RADIANS('".$driverlat."') ) *
			COS( RADIANS( CustomerCustom.lat ) ) * COS( RADIANS( '".$driverlong."' - CustomerCustom.long ) ) ) ) , 4 ) *60 * 1.1515 * 1.6*1000) distance";
			
			$from = " FROM tc_driver_customs as CustomerCustom,tc_users User";
			
			$whereObj = " WHERE CustomerCustom.user_id=User.id AND CustomerCustom.is_active='1' AND CustomerCustom.user_id!='".$ignoredriverid."' AND CustomerCustom.device_unique_id!='' AND User.company_id='".$company_id."' HAVING distance < ".$radius." LIMIT 10";
		}
		
		$query = $selectObj.$from.$whereObj;
		
		$drivers = $this->CustomerCustom->query($query);
		
		return $drivers;
	}
}
