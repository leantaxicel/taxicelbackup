<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'Fpdf', array('file' => 'fpdf/fpdf.php'));

/**
 * Services Controller
 *
 * @property Service $Service
 */
class ServicesController extends AppController {

/**
 * Components
 *
 * @var array
 */
//AIzaSyDBbZ0cQXfyrQbESRu3e0d_r18943MXQKk
	public $components = array('Paginator','Session','Thumb');
	public $helpers = array ('Session','App','Html');
	/*
	public $CustomerAppkey = "AIzaSyDik8e32gJnVMDYJuijG15haLbDMkx-eZk";
	public $DriverAppkey = "AIzaSyCVxWdfffgvWUgw91HtY9CMqM_CpPQuVBc";
	
	public $sitelimit = 15;
	public $adminFromEmail = "taxiceladmin@taxicel.com";
	
	public $adminToEmail = "mrintoryal@gmail.com";
	public $usercurrentcreditminlimit=200;
	public $googleServerKey="AIzaSyBmoRt5gXU6nGN8AbLGZe3qdDuu4z2nE3s";
	*/
	
/**
 * Configuration method
 *
 * @return void
 */
	
	public function configuration(){
		header('Content-Type: application/json');
		$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
		//clear cach files
		$congiggallery = $this->configurationall($company_id);
		die(json_encode($congiggallery));
	}
	
	public function configurationall($company_id=1){
		$this->loadModel('Configuration');
		$this->loadModel('AppGallery');
		$this->loadModel('City');
		$fields = array('id','andversion','iosversion','ride_later_limit','googlekey','website_url','initial_earning','fromemail','toemail','reclimit','withdraw_limit');
		$config = $this->Configuration->find('first',array('conditions'=>array('Configuration.company_id'=>$company_id),'fields'=>$fields));
		$appgalleries = $this->AppGallery->find('all',array('conditions'=>array('AppGallery.company_id'=>$company_id)));
		
		$cities = $this->City->find('list',array('conditions'=>array('City.company_id'=>$company_id,'City.is_active'=>'1')));
		
		$galleries = array();
		
		if(isset($appgalleries) && is_array($appgalleries) && count($appgalleries)>0){
			//
			foreach($appgalleries as $appgallery){
				$data = array(
					'iosimg'=>FULL_BASE_URL.$this->base."/appPic/".$appgallery['AppGallery']['ios_image'],
					'andimg'=>FULL_BASE_URL.$this->base."/appPic/".$appgallery['AppGallery']['android_image'],
					'text'=>$appgallery['AppGallery']['gallery_text'],
					'isbackgroundimg'=>$appgallery['AppGallery']['is_background_image']
				);
				array_push($galleries,$data);
			}
		}
		$config = (isset($config['Configuration']))?$config['Configuration']:array();
		return array("Configuration"=>$config,"gallery"=>$galleries,'cities'=>$cities);
	}
/**
 * customer registration method
 *
 * @return void
 */
	public function customer_registration(){
		header('Content-Type: application/json');
		$this->loadModel('User');
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
			$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
			// CREATING RANDOM REFERER CODE
			/*$alpha1 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$ALPHAM1 = $alpha1[array_rand($alpha1, 1)];
			$alpha2 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$ALPHAM2 = $alpha2[array_rand($alpha2, 1)];
			$alpha3 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$ALPHAM3 = $alpha3[array_rand($alpha3, 1)];
			$randCode = $ALPHAM1.$ALPHAM2.$ALPHAM3.rand(99,999);*/
			
			$isduplicateemail = $this->duplicateemail($this->request->data['email']);
			if($isduplicateemail){
				die(json_encode(array('status'=>'0','msg'=>'Email already present')));	
			}
			
			$randCode = $this->generaterefferalcode();
			//database validate the refferal code
			
			// ENDS HERE
			$refer_code = $randCode;
			$saveData['User']['reg_date'] 	= date("Y-m-d G:i:s");
			$saveData['User']['f_name'] 	= $this->request->data['f_name'];
			$saveData['User']['l_name'] 	= $this->request->data['l_name'];
			$saveData['User']['mobile'] 	= $this->request->data['mobile'];
			$saveData['User']['email'] 		= $this->request->data['email'];
			$saveData['User']['pass'] 		= $this->request->data['pass'];
			$saveData['User']['user_type'] 	= '2';
			$saveData['User']['username'] 	= $this->request->data['f_name'].' '.$this->request->data['l_name'];
			$saveData['User']['company_id'] = $company_id;
			$saveData['User']['is_active'] = '1';
			
			if(isset($this->request->data['ref_code']) && $this->request->data['ref_code']!=''){
				$option = array(
					'conditions'=>array(
						'User.my_refferal_code'=>$this->request->data['ref_code']
					),
				);
				$userData = $this->User->find('first',$option);
				$userCount = $this->User->find('count',$option);
				
				if($userCount>0)
					$saveData['User']['reffered_by'] = $userData['User']['id'];
			}
			$saveData['User']['my_refferal_code'] = $refer_code;
			if(isset($_FILES['user_image']) && $_FILES['user_image']['name']!=''){
				$filename = trim(time().str_replace(' ','_',$_FILES['user_image']['name']));
				if(move_uploaded_file($_FILES['user_image']['tmp_name'],WWW_ROOT."userPic/".$filename)){
					$source = WWW_ROOT."userPic/".$filename;
					$destination = WWW_ROOT."userPic/thumb_".$filename;
					$this->Thumb->createthumbs($source,$destination,100,80);
				}
				else{
					$filename='';
				}
			}else{
				$filename='';
			}
			if($filename!=''){
				$userPic = FULL_BASE_URL.$this->base."/userPic/".$filename;
			}else{
				$userPic ='';
			}
			//get old password
			$password  = $saveData['User']['pass'];
			//encript the password
			$saveData['User']['pass']=md5($password);
			//set user basic credit
			$this->User->create();
			if ($this->User->save($saveData)) {
				$user_id = $this->User->id;
				//$this->loadModel('CustomerCustom');
				$saveCustom['CustomerCustom']['user_image'] 		= $filename;
				$saveCustom['CustomerCustom']['device_type'] 		= $this->request->data['device_type'];
				$saveCustom['CustomerCustom']['user_id'] 		= $user_id;
				$saveCustom['CustomerCustom']['device_unique_id'] 	= $this->request->data['device_unique_id'];
				
				if ($this->User->CustomerCustom->save($saveCustom)) {
					/*$userFetch = $this->User->find('first',array(
						'conditions'=>array('User.id'=>$user_id)
					));*/
				
					$credit_cards = null;
					
					$name 	   = ucwords( $saveData['User']['f_name']." ".$saveData['User']['l_name']);
					$fname 	   = ucwords($saveData['User']['f_name']);
					$email 	   = $saveData['User']['email'];
					$contactno = $saveData['User']['mobile'];
					
					$refercode = $saveData['User']['my_refferal_code'];
					
					$serverIsLocalHost = $this->serverDetect();
					
					if(!$serverIsLocalHost && filter_var($email, FILTER_VALIDATE_EMAIL)){
						//set servet variables
						$this->siteconfiguration();
						// Email to user and admin 
						// admin email
						$Email = new CakeEmail();
						$Email->from(array($email => $name));
						$Email->to($this->adminToEmail);// admin email address
						$Email->subject('New user have registered successfully');
						$body='Hello Admin ,
								Following user newly register with you. Please find below the details.
							Name : '.$name.'
							Email : '.$email.'
							Contact No : '.$contactno.'
							
							Thanks,
							'.$name.'
							';	
							
						$Email->send($body);
						
						
						// User email
						$Email = new CakeEmail();
						$Email->template('user_register','complaint_email');
						$Email->viewVars(array(
								'email' 		=> $email,
								'name' 			=> $name,
								'fname' 		=> $fname,
								'password' 		=> $password,
								'contact_no'	=> $contactno,
								'refer_code'	=> $refercode
							));
						$Email->emailFormat('html');
						
						$Email->from(array($this->adminFromEmail=>'TaxiCel Team'));// admin email
						$Email->to(array($email=>$name));
						$Email->subject('Thanks for register with TaxiCel.');
						$Email->send();	
						// end email section
					}
					
					$data = array(
						'user_id'=>$user_id,
						'f_name'=>$fname,
						'l_name'=>$saveData['User']['l_name'],
						'email'=>$email,
						'mobile'=>$contactno,
						'profile_img'=>$userPic,
						'refferal_code'=>$refercode,
						'credit_cards'=>$credit_cards,
						'rating'=>'0'
					);
					die(json_encode(array('data'=>$data,'status'=>'1','msg'=>'The customer has been saved.')));
				}else{
					die(json_encode(array('status'=>'0','msg'=>'Something went wrong.')));
				}
			} else {
				die(json_encode(array('status'=>'0','msg'=>'The customer could not be saved. Please, try again.')));
			}
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
		
		die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
	}
	
/**
 * customer login method
 *
 * @return void
 */
	public function customer_login(){
		header('Content-Type: application/json');
		$this->loadModel('User');
		//$this->loadModel('CustomerCustom');
		if( (isset($this->request->data['device_type']) && $this->request->data['device_type']>0) ){
			$email				= $this->request->data['email'];
			$pass				= $this->request->data['pass'];
			$device_unique_id	= $this->request->data['device_unique_id'];
			$lat				= $this->request->data['lat'];
			$lon				= $this->request->data['lon'];
			$device_type		= $this->request->data['device_type'];
			$ride_id = (isset($this->request->data['ride_id']) && $this->request->data['ride_id'])?$this->request->data['ride_id']:0;
			
			//unbind the model
			$this->User->unbindModel(array(
				'hasMany'=>array('DriverRide','CustomerRide','UserCreditDetail'),
				'hasOne'=>array('DriverCustom','VehicleDetail')
			));
			$result = $this->User->find('first',array(
				'conditions'=>array('User.email'=>$email, 'User.pass'=>md5($pass), 'User.user_type'=>'2','User.is_active'=>'1')
			));
			//pr($result);
			//die();
			if( $result ){
				// Updating customer location 
				$user_id = $result['User']['id'];
				//validate if custome set or not in signup processes
				if(isset($result['CustomerCustom']['id'])){
					$this->User->CustomerCustom->updateAll(
						array('CustomerCustom.device_unique_id'=>"'".$device_unique_id."'", 'CustomerCustom.lat'=>"'".$lat."'", 'CustomerCustom.long'=>"'".$lon."'",'CustomerCustom.device_type'=>"'".$device_type."'"),
						array( 'CustomerCustom.user_id' => $user_id )
					);	
				}
				else{
					$custome = array(
						'CustomerCustom'=>array(
							'user_id'=>$user_id,
							'device_unique_id'=>$device_unique_id,
							'lat'=>$lat,
							'long'=>$lon,
							'device_type'=>$device_type
							)
						);
					$this->User->CustomerCustom->save($custome);
				}
				//advart
				//card details
				$credit_cards = $this->usercreditcard($user_id);
				if(isset($result['CustomerCustom']['user_image']) && $result['CustomerCustom']['user_image']!=''){
					$userPic = FULL_BASE_URL.$this->base."/userPic/".$result['CustomerCustom']['user_image'];
				}else{
					$userPic ='';
				}
				//get user ratting
				$rating = $this->userrattingsection($user_id,2);
				
				$data = array(
					'user_id'=>$user_id,
					'f_name'=>$result['User']['f_name'],
					'l_name'=>$result['User']['l_name'],
					'email'=>$result['User']['email'],
					'mobile'=>$result['User']['mobile'],
					'profile_img'=>$userPic,
					'refferal_code'=>$result['User']['my_refferal_code'],
					'credit_cards'=>$credit_cards,
					'rating'=>$rating
				);
				//if ride id present then get the ride status
				$custom = $this->usercurrentrideinformation($user_id,$ride_id,2);
				//add this param to the retun ogject
				if(is_array($custom) && count($custom)>0){
					$data['ride']=$custom;
				}
				
				//pr($data);
				die(json_encode(array('data'=>$data,'status'=>'1','msg'=>'The customer has successfully logged in.')));
			}else{
				die(json_encode(array('status'=>'0','msg'=>'Invalid Customer.')));
			}
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}
/**
 * driver login method
 *
 * @return void
 */
	public function drivers_login(){
		header('Content-Type: application/json');
		$this->loadModel('User');
		//$this->loadModel('DriverCustom');
		//$this->write_log($this->request->data);
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
			$email			= isset($this->request->data['email'])?$this->request->data['email']:'';
			$pass			= $this->request->data['pass'];
			$device_unique_id	= $this->request->data['device_unique_id'];
			$lat			= $this->request->data['lat'];
			$lon			= $this->request->data['lon'];
			$device_type		= $this->request->data['device_type'];
			$ride_id = (isset($this->request->data['ride_id']) && $this->request->data['ride_id'])?$this->request->data['ride_id']:0;
			
			$licensedoc=array('docpath'=>'','expdate'=>'');
			$insurancedoc=array('docpath'=>'','expdate'=>'');
			$authdoc=array('docpath'=>'','expdate'=>'');
			$operatordoc=array('docpath'=>'','expdate'=>'');
			$payingcommisionpercent = 0;
			//bind model
			$this->User->bindModel(array(
				'hasOne'=>array(
					'DriverDocument'=>array(
						'className' => 'DriverDocument',
						'foreignKey' => 'user_id',
					)
				)
			));
			//unbind models
			$this->User->unbindModel(
				array(
					'hasOne'=>array('CustomerCustom','VehicleDetail'),
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
				)
			);
			$result = $this->User->find('first',array(
				'conditions'=>array('User.email'=>$email, 'User.pass'=>md5($pass), 'User.user_type'=>'1','User.is_active'=>'1')
			));
			//pr($result);
			if( $result ){
				// Updating customer location 
				$user_id = $result['User']['id'];
				//validate if not custom set
				if(isset($result['DriverCustom']['id'])){
					$this->User->DriverCustom->updateAll(array('DriverCustom.device_unique_id'=>"'".$device_unique_id."'", 'DriverCustom.lat'=>"'".$lat."'", 'DriverCustom.long'=>"'".$lon."'",'DriverCustom.device_type'=>"'".$device_type."'",'DriverCustom.status'=>'0'),array( 'DriverCustom.user_id' => $user_id ));
				}
				else{
					//create record
					$custome = array(
						'DriverCustom'=>array(
							'user_id'=>$user_id,
							'device_unique_id'=>$device_unique_id,
							'lat'=>$lat,
							'long'=>$lon,
							'device_type'=>$device_type,
							'status'=>'0'
							)
						);
					$this->User->DriverCustom->save($custome);
				}
				
				//advart
				
				$credit_cards = null;

				if(isset($result['DriverCustom']['user_pic']) && $result['DriverCustom']['user_pic']!='' && $result['DriverCustom']['user_pic']!='mm'){
					$userPic = FULL_BASE_URL.$this->base."/userPic/".$result['DriverCustom']['user_pic'];
				}else{
					$userPic ='';
				}
				//driver cards
				$credit_cards = $this->usercreditcard($user_id);
				$vehicles = $this->driverallvehicles($user_id);
				//driver doc details
				if(isset($result['DriverDocument'])){
					$baseflpath = FULL_BASE_URL.$this->base."/userDoc/";
					// insurance
					if(isset($result['DriverDocument']['filename']) && $result['DriverDocument']['filename']!=''){
						$insurancedoc=array(
							'docpath'=>$baseflpath.$result['DriverDocument']['filename'],
							'expdate'=>$result['DriverDocument']['expiry_date']
						);	
					}
					// authorization doc
					if(isset($result['DriverDocument']['filename_auth']) && $result['DriverDocument']['filename_auth']!=''){
						$authdoc=array(
							'docpath'=>$baseflpath.$result['DriverDocument']['filename_auth'],
							'expdate'=>$result['DriverDocument']['expiry_date_auth']
						);	
					}
					// license doc
					if(isset($result['DriverDocument']['filename_lic']) && $result['DriverDocument']['filename_lic']!=''){
						$licensedoc=array(
							'docpath'=>$baseflpath.$result['DriverDocument']['filename_lic'],
							'expdate'=>$result['DriverDocument']['expiry_date_lic']
						);	
					}
					// vehicle operator doc
					if(isset($result['DriverDocument']['filename_oper']) && $result['DriverDocument']['filename_oper']!=''){
						$operatordoc=array(
							'docpath'=>$baseflpath.$result['DriverDocument']['filename_oper'],
							'expdate'=>$result['DriverDocument']['expiry_date_oper']
						);	
					}
				}
				
				// commisson pay due calculation
				/*//menual query
				$paingamount=0;
				$payingridecost = $this->User->query("SELECT sum(`Ride`.`commission_cost`) commissioncost FROM `tc_rides` `Ride` WHERE `Ride`.`driver_id`='".$user_id."' AND `Ride`.`commission_paid`='0'");
				//pr($payingridecost);
				if(isset($payingridecost) && is_array($payingridecost) && count($payingridecost)>0){
					foreach($payingridecost[0] as $totalcostarray){
						$paingamount = isset($totalcostarray['commissioncost'])?$totalcostarray['commissioncost']:0;
					}
				}
				if($paingamount>0){
					$currentcredit = $result['User']['currentcredit'];
					if($currentcredit>0){
						$payingcommisionpercent = (($paingamount/$currentcredit)*100);
					}
				}*/
				//user current status of creadit after recharge
				$usercreditperandbuycredit = $this->getpayingpercentageandbuycredit($user_id);
				$payingcommisionpercent = $usercreditperandbuycredit['payingcommisionpercent'];
				$buycreadit = $usercreditperandbuycredit['buycreadit'];
				$credit_warning = $usercreditperandbuycredit['credit_warning'];
				//get driver ratting
				$rating = $this->userrattingsection($user_id,1);
				$data = array(
					'user_id'=>$user_id,
					'f_name'=>$result['User']['f_name'],
					'l_name'=>$result['User']['l_name'],
					'email'=>$result['User']['email'],
					'mobile'=>$result['User']['mobile'],
					'profile_img'=>$userPic,
					'refferal_code'=>$result['User']['my_refferal_code'],
					'credit_cards'=>$credit_cards,
					'insurance_doc'=>$insurancedoc,
					'authority_card_doc'=>$authdoc,
					'license_doc'=>$licensedoc,
					'vehicle_operator_doc'=>$operatordoc,
					'payingcommisionpercent'=>$payingcommisionpercent,
					'buycreadit'=>$buycreadit,
					'credit_warning'=>$credit_warning,
					'rating'=>$rating,
					'vehicles'=>$vehicles,
					'status'=>'0'
				);
				die(json_encode(array('data'=>$data,'status'=>'1','msg'=>'The driver has successfully logged in.')));
			}else{
				die(json_encode(array('status'=>'0','msg'=>'Invalid Driver.')));
			}
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}
	
/**
 * Check City method service
 *
 * @return void
 */
	public function checkCityService(){
		header('Content-Type: application/json');
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
			$pickup_lat = $this->request->data['lat'];
			$pickup_lon = $this->request->data['long'];
			$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
			$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$pickup_lat.",".$pickup_lon."&sensor=true";
			//server settings
			$this->siteconfiguration();
			if($this->googleServerKey!=''){
				$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$pickup_lat.",".$pickup_lon."&sensor=true&key=".$this->googleServerKey;	
			}
			
			$data = @file_get_contents($url);
			$jsondata = json_decode($data,true);

			$picupcityname  = ''; // cityname
			$picuppostcode = '';
			$isairport = 0;
			$city='';
			foreach ($jsondata["results"] as $result) {
				foreach ($result["address_components"] as $address) {
					if (in_array("locality", $address["types"])) {
						$city = $address["long_name"];
					}
					if (in_array("country", $address["types"])) {
						$country = $address["long_name"];
					}
				}
			}
			// Creating the array and sending to the device
			$data=array(
				'cityname'=>$city,
				'country'=>$country,
			);
			die(json_encode(array('data'=>$data,'is_exist'=>'1','status'=>'1','msg'=>'City exists.')));
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
		
	}

/**
 * Ride Save method service
 *
 * @return void
 */
	public function new_order(){
		header('Content-Type: application/json');
		$this->loadModel('Ride');
		$this->loadModel('Cupon');
		//$this->write_log($this->request->data);
		if($this->request->is('post')){
			if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
				$picupcityname  = '';
				$pick_up = ' '; 
				$picupWithCity = (isset($this->request->data['pick_up']) && $this->request->data['pick_up']!='')?explode('*',$this->request->data['pick_up']):array();
				if(is_array($picupWithCity) && count($picupWithCity)>0){
					$pick_up = $picupWithCity['0'];
					$picupcityname = (isset($picupWithCity['1']))?$picupWithCity['1']:'';
				}
				$pick_up_lat = (isset($this->request->data['pick_up_lat']) && $this->request->data['pick_up_lat']!='')?$this->request->data['pick_up_lat']:' ';
				$pick_up_lon = (isset($this->request->data['pick_up_lon']) && $this->request->data['pick_up_lon']!='')?$this->request->data['pick_up_lon']:' ';
				$drop_off = (isset($this->request->data['drop_off']) && $this->request->data['drop_off']!='')?$this->request->data['drop_off']:' ';
				$drop_off_lat = (isset($this->request->data['drop_off_lat']) && $this->request->data['drop_off_lat']!='')?$this->request->data['drop_off_lat']:' ';
				$drop_off_lon = (isset($this->request->data['drop_off_lon']) && $this->request->data['drop_off_lon']!='')?$this->request->data['drop_off_lon']:' ';
				$user_id = (isset($this->request->data['user_id']) && $this->request->data['user_id']!='')?$this->request->data['user_id']:' ';
				$instruction = (isset($this->request->data['instruction']) && $this->request->data['instruction']!='')?$this->request->data['instruction']:' ';
				$ride_date_time = (isset($this->request->data['ride_date_time']) && $this->request->data['ride_date_time']!='')?date("Y-m-d G:i",strtotime($this->request->data['ride_date_time'])):date("Y-m-d G:i");
				$payment_type = (isset($this->request->data['payment_type']) && $this->request->data['payment_type']!='')?$this->request->data['payment_type']:'0';
				$ride_type  = (isset($this->request->data['ride_type']) && $this->request->data['ride_type']!='')?$this->request->data['ride_type']:'0';
				//new addition address information send by customer
				$street_address = (isset($this->request->data['street_address']) && $this->request->data['street_address']!='')?$this->request->data['street_address']:'';
				$nearby_address = (isset($this->request->data['nearby_address']) && $this->request->data['nearby_address']!='')?$this->request->data['nearby_address']:'';
				$cupon_code = (isset($this->request->data['cupon_code']) && $this->request->data['cupon_code']!='')?$this->request->data['cupon_code']:'';
				//creadit card
				$creditcard_id = (isset($this->request->data['creditcardid']) && $this->request->data['creditcardid']>0)?$this->request->data['creditcardid']:'0';
				$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
				//validation card info
				if($payment_type==1 && $creditcard_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Card not selected')));
				}
				
				//unbind the user models
				$this->Ride->User->unbindModel(array(
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
					'hasOne'=>array('DriverCustom','VehicleDetail'),
				));
				$userdetails = $this->Ride->User->find('first',array('recursive'=>'0','conditions'=>array('User.id'=>$user_id)));
				
				if(is_array($userdetails) && count($userdetails)>0){
					
					$userName = $userdetails['User']['username'];
					$userName = ucwords($userdetails['User']['f_name']." ".$userdetails['User']['l_name']);
					$userMobileNo = $userdetails['User']['mobile'];
					
					if(isset($userdetails['User']['CustomerCustom']['user_image']) && $userdetails['User']['CustomerCustom']['user_image']!=''){
						$userPic = FULL_BASE_URL.$this->base."/userPic/".$userdetails['User']['CustomerCustom']['user_image'];
					}else{
						$userPic ='';
					} 
				}
				else{
					die(json_encode(array('status'=>'0','msg'=>'Invalied Account.')));
				}
				//now get setver setting
				$this->siteconfiguration($company_id);
				
				// city id fetching from lat and long
				if($picupcityname ==''){
					
					$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$pick_up_lat.",".$pick_up_lon."&sensor=true";
					if($this->googleServerKey!=''){
						$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$pick_up_lat.",".$pick_up_lon."&sensor=true&key=".$this->googleServerKey;
					}
					$data = @file_get_contents($url);
					$jsondata = json_decode($data,true);
					 // cityname
					if($jsondata["status"]=="OK" || $jsondata["status"]=="ok"){
						foreach ($jsondata["results"] as $result) {
							foreach ($result["address_components"] as $address) {
								if (in_array("locality", $address["types"])) {
									$picupcityname = $address["long_name"];
								}
							}
						}
					}
				}
				//get city address
				$cityresult = $this->Ride->City->find('first',array(
				   'conditions'=>array('City.name LIKE'=>'%'.$picupcityname.'%','City.company_id'=>$company_id,'City.is_active'=>'0')
				));

				if(is_array($cityresult) && count($cityresult)>0 && isset($cityresult['City'])){
				}
				else{
					$cityresult = $this->Ride->City->find('first',array(
					   'conditions'=>array('City.is_active'=>'0','City.company_id'=>$company_id)
					));
				}
				
				$cityid  = (isset($cityresult['City']['id']))?$cityresult['City']['id']:0;
				
				//Code for cupon
				$discount = 0;
				if(isset($cupon_code) && $cupon_code!=''){
					$discount = $this->validateCuponCode($user_id,$cupon_code);
				}
				
				//$range = (isset($cityresult['CityConfiguration']['inter_fare_distance']))?$cityresult['CityConfiguration']['inter_fare_distance']:5000; // get from city config	
				
				$range=50000;
				$this->Ride->create();
				//$this->request->data['Ride']['card_id'] = $this->request->data['creditcardid'];
				$savedata['Ride']['pick_up'] = $pick_up;
				$savedata['Ride']['pick_lat'] = $pick_up_lat;
				$savedata['Ride']['pick_long'] = $pick_up_lon;
				$savedata['Ride']['drop_off'] = $drop_off;
				$savedata['Ride']['drop_lat'] = $drop_off_lat;
				$savedata['Ride']['drop_long'] = $drop_off_lon;
				$savedata['Ride']['user_id'] = $user_id;
				$savedata['Ride']['instruction'] = $instruction;
				$savedata['Ride']['payment_option'] = $payment_type;
				$savedata['Ride']['ride_type'] = $ride_type ;
				$savedata['Ride']['date_time'] = $ride_date_time ;
				$savedata['Ride']['city_id'] = $cityid ;
				//additional new param
				$savedata['Ride']['street_address']=$street_address;
				$savedata['Ride']['nearby_address']=$nearby_address;
				//New code for cupon_code
				$savedata['Ride']['cupon_code']=$cupon_code;
				$savedata['Ride']['discount']=$discount;
				$savedata['Ride']['card_id']=$creditcard_id;
				$savedata['Ride']['ordercreatetime']=date("Y-m-d G:i:s");
				$savedata['Ride']['company_id']=$company_id;
				//pr($savedata);
				$device_type = $this->request->data['device_type'];
				if ($this->Ride->save($savedata)) {	
					$ride_id = $this->Ride->id;
					
					$this->Ride->User->CustomerCustom->updateAll(array('CustomerCustom.device_unique_id'=>"'".$this->request->data['device_unique_id']."'",'CustomerCustom.device_type'=>"'".$device_type."'"), array( 'CustomerCustom.user_id'=>$user_id ));
					
					if($ride_type!=1){ //ride now 
						$estTime = "0 Min";
						$dDetails = $this->getNearestdrivers($pick_up_lat, $pick_up_lon,$this->driverfindrange,0,0,$company_id);
						//pr($dDetails);
						// Searching for the nearest driver online
						$devicetype = 0;
						if(is_array($dDetails) && count($dDetails)>0){
							//get user rating
							$rating = $this->userrattingsection($user_id,2);
							$textmsg = "New Ride";
							foreach($dDetails as $driver){
								//$driver = $dDetails['0'];
								//find estimation time beetween driver and the user
								$driverlat = $driver['DriverCustom']['lat'];
								$driverlon = $driver['DriverCustom']['long'];
								$distanceDuration  = $this->getDistanceAndDuration($pick_up_lat,$pick_up_lon,$driverlat,$driverlon,$this->googleServerKey);
								//pr($distanceDuration);
								if(isset($distanceDuration['status']) && $distanceDuration['status']==1){
									$driverdeatils = array_slice($distanceDuration,1);
								}
								else{
									$distance = isset($driver['0']['distance'])?($driver['0']['distance']/1000):0; //km
									$distance = round($distance);
									$timeneed = (($distance*60)/40); //minute
									$timeneed = round($timeneed);
									
									$driverdeatils['duration']=$timeneed;
									$driverdeatils['distance']=$distance;
									$driverdeatils['durationinminit']=$timeneed;
								}
								
								$estTime = $driverdeatils['durationinminit'];
								
								//push dat related section
								$devicetype = $driver['DriverCustom']['device_type'];
								//push data create section
								
								$custom = array( 
									'estTime'=>$estTime,
									'c_name'=>$userName,
									'c_rating'=>$rating,
									'c_address'=>$pick_up,
									'c_lat'=>$pick_up_lat,
									'c_long'=>$pick_up_lon,
									'c_mobile'=>$userMobileNo,
									'c_dropaddress'=>$drop_off,
									'c_pic'=>$userPic,
									'ride_id'=> $ride_id,
									'text'=>$textmsg,
									'street_address'=>$street_address,
									'nearby_address'=>$nearby_address,
									'status'=>'0',
									'c_drop_lat'=>$drop_off_lat,
									'c_drop_lon'=>$drop_off_lon
								);
								//pr($custom);
								$pushid = $driver['DriverCustom']['device_unique_id'];
								if($pushid!=''){
									if($devicetype=='1'){
										//send android notifications
										$registration_ids = array($pushid);
										$this->appandroidpushnotify($registration_ids,$this->DriverAppkey,$textmsg,$custom);
									}
									elseif($devicetype=='2'){
										$this->iospushnotification($pushid,$textmsg,$custom,1,1,$company_id);
									}
								}
							}
							die(json_encode(array('ride_id'=>$ride_id,'status'=>'1','msg'=>'Ride has been saved and push has been send to the driver.')));
						}
						else{
							//no driver found
							$driver=null;
							die(json_encode(array('ride_id'=>$ride_id,'status'=>'0','msg'=>'Ride saved but no drivers found nearby.')));
						}
					}
					die(json_encode(array('ride_id'=>$ride_id,'status'=>'1','msg'=>'Ride has been saved as ride later.')));
				}else{
					die(json_encode(array('status'=>'0','msg'=>'Ride cannot be save, please try again.')));
				}
			}else{
				//error message
				die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalied.')));
	}
	
/**
 * Go On Duty method service
 *
 * @return void
 */
	public function go_on_duty(){
		header('Content-Type: application/json');
		$this->loadModel('DriverCustom');
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
			$lat 			= (isset($this->request->data['lat']) && $this->request->data['lat']!='')?$this->request->data['lat']:'22.56';
			$lon 			= (isset($this->request->data['lon']) && $this->request->data['lon']!='')?$this->request->data['lon']:'88.123';
			$device_unique_id 	= (isset($this->request->data['device_unique_id']) && $this->request->data['device_unique_id']!='')?$this->request->data['device_unique_id']:'';
			$user_id 		= (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:'0';
			$device_type 		= (isset($this->request->data['device_type']))?$this->request->data['device_type']:'0';
			if($device_type==1 || $device_type==2){
				if($user_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid driver id')));	
				}
				//get user rating
				$rating = $this->userrattingsection($user_id,1);
				
				//unbind the model
				//now validate the user has anough creadit for go on duty
				$condisions = array('DriverCustom.user_id'=>$user_id);
				$driverCustomData = $this->DriverCustom->find('first',array('recursive'=>'0','conditions'=>$condisions));
				//pr($driverCustomData);
				$currentcredit = 0;
				$company_id='1';
				if(isset($driverCustomData) && is_array($driverCustomData) && isset($driverCustomData['User']) && count($driverCustomData['User'])>0){
					$currentcredit = $driverCustomData['User']['currentcredit'];
					$company_id = $driverCustomData['User']['company_id'];
				}
				else{
					die(json_encode(array('status'=>'0','msg'=>'Invalid driver id')));
				}
				//get site config got
				$this->siteconfiguration($company_id);
				
				if($currentcredit>=$this->minimumcreditforride){
					//now able to go on line
					$this->DriverCustom->updateAll(array('DriverCustom.device_unique_id'=>"'".$device_unique_id."'", 'DriverCustom.lat'=>"'".$lat."'", 'DriverCustom.long'=>"'".$lon."'", 'DriverCustom.status'=>'1', 'DriverCustom.device_type'=>"'".$device_type."'"), array( 'DriverCustom.user_id' => $user_id ));		
					//send push in nearest customers
					$this->sendonlinenotificationtocustomers($lat,$lon,$this->driverfindrange,$this->googleServerKey,$this->CustomerAppkey,$company_id);
					die(json_encode(array('status'=>'1','msg'=>'Driver in now online.','buycreadit'=>'0','rating'=>$rating)));
				}
				else{
					die(json_encode(array('status'=>'1','msg'=>'Need to recharge','buycreadit'=>'1','rating'=>$rating)));
				}
			}
			else{
				die(json_encode(array('status'=>'0','msg'=>'Device type parameter invalid.')));
			}
			
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}
	
	public function  sendonlinenotificationtocustomers($driverlat='',$driverlon='',$findrange=10000,$googlekey='', $androcusappkey='',$company_id=1){
		$customers=array();
		if($driverlat!='' && $driverlon!=''){
			//now get 30 nearest customers and send push notification to the customers
			$customers = $this->getNearestcustomers($driverlat,$driverlon,$findrange,1,0,$company_id);
			//pr($customers);
		}
		if(is_array($customers) && count($customers)>0 ){
			foreach($customers as $customer){
				$pushid = $customer['CustomerCustom']['device_unique_id'];
				if($pushid!=''){
					$devicetype=0;
					//now create the push send data
					$driverdeatils=array(
						"duration" => 0,
						"distance" => 0,
						"durationinminit" => 0,
						'dlat'=>$driverlat,
						'dlon'=>$driverlon,
						'isnearest'=>'0',
						'status'=>'10'
					);
					$customerlat = $customer['CustomerCustom']['lat'];
					$customerlon = $customer['CustomerCustom']['long'];
					$devicetype = $customer['CustomerCustom']['device_type'];
					//$distanceDuration  = $this->getDistanceAndDuration($driverlat,$driverlon,$customerlat,$customerlon,$googlekey);
					//pr($distanceDuration);
					$distanceDuration['status']=0;
					if(isset($distanceDuration['status']) && $distanceDuration['status']==1){
						$driverdeatils = array_slice($distanceDuration,1);
					}
					else{
						$distance = isset($customer['0']['distance'])?($customer['0']['distance']/1000):0; //km
						$distance = round($distance);
						$timeneed = (($distance*60)/40); //minute
						$timeneed = round($timeneed);
						
						$driverdeatils['duration']=$timeneed;
						$driverdeatils['distance']=$distance;
						$driverdeatils['durationinminit']=$timeneed;
					}
					//add driver lat lon
					$driverdeatils['dlat']=$driverlat;
					$driverdeatils['dlon']=$driverlon;
					
					
					$textmsg='';
					if($devicetype=='1' && $androcusappkey!=''){
						//send android notifications
						$registration_ids = array($pushid);
						$this->appandroidpushnotify($registration_ids,$androcusappkey,$textmsg,$driverdeatils);
					}
					elseif($devicetype=='2'){
						$this->iospushnotification($pushid,$textmsg,$driverdeatils,0,2,$company_id);
					}
				}
			}
		}
	}
	
	//work end from here on 20-05-15
	
	//work start on 21-05-15
	
/**
 * Save card information method service
 *
 * @return void
 */
	public function save_card_information(){
		header('Content_Type:application/json');
		$this->loadModel('UserCreditDetail');
		//$this->loadModel('CustomerCustom');
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
			$userid = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
			//validate user id
			if($userid==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid User.')));	
			}
			//card informations
			$saveData['UserCreditDetail']['user_id'] 	= $userid;
			$saveData['UserCreditDetail']['credit_card_no'] = isset($this->request->data['cardno'])?$this->request->data['cardno']:0;
			$saveData['UserCreditDetail']['holdername'] 	= isset($this->request->data['holdername'])?$this->request->data['holdername']:'';
			$saveData['UserCreditDetail']['expirydate'] 	= isset($this->request->data['expirydate'])?$this->request->data['expirydate']:'';
			$saveData['UserCreditDetail']['cvvno'] 		= isset($this->request->data['cvvno'])?$this->request->data['cvvno']:'';
			$saveData['UserCreditDetail']['cardtype'] 	= isset($this->request->data['cardtype'])?$this->request->data['cardtype']:'';
			$saveData['UserCreditDetail']['postcode'] 	= isset($this->request->data['postcode'])?$this->request->data['postcode']:'';
			$saveData['UserCreditDetail']['address'] 	= isset($this->request->data['address'])?$this->request->data['address']:'';
			
			$usertype = (isset($this->request->data['user_type']))?$this->request->data['user_type']:0;
			//validate expiry date format
			$expiryarray = explode("/",$saveData['UserCreditDetail']['expirydate']);
			if(is_array($expiryarray) && count($expiryarray)==2){
				$month = $expiryarray['0'];
				$year = substr($expiryarray['1'],-2);
				//validate month
				if($month<1 || $month>12){
					die(json_encode(array('status'=>'0','msg'=>'Invalid Expiry month format')));
				}
				$curyear = date("y");
				if($year<$curyear){
					die(json_encode(array('status'=>'0','msg'=>'Invalid Expiry year format')));
				}
			}
			else{
				die(json_encode(array('status'=>'0','msg'=>'Invalid Expiry date format')));
			}
			//get to know the card type
			$cardname = $this->cardtypename($saveData['UserCreditDetail']['credit_card_no']);
			$saveData['UserCreditDetail']['cardtypename']=$cardname;
			//now saved the ard info
			$this->UserCreditDetail->create();
			if ($this->UserCreditDetail->save($saveData)) {
				$card_id = $this->UserCreditDetail->id;
				$msg = "Users card information saved successfully";
				$savedcardpayuinfo = $this->cardinfosavedinpayu($card_id);
				//get user all card and return to the user
				$cards = $this->usercreditcard($userid);
				if(is_array($cards) && count($cards)>0){
					die(json_encode(array('status'=>'1','credit_cards'=>$cards,'msg'=>$msg)));	
				}
				else{
					die(json_encode(array('status'=>'1','credit_cards'=>null,'msg'=>$msg)));
				}
				
			}else{
				die(json_encode(array('status'=>'0','msg'=>'Card cannot be save, please try again.')));
			}
		}
		else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}

/**
 * Customer Credit Card List method service
 *
 * @return void
 */
	public function savedcards_old(){
		$this->loadModel('User');
		$user_id = isset($this->request->data['user_id'])?$this->request->data['user_id']:0;
		
		$this->User->unbindModel(array('hasMany'=>array('CustomerRide','DriverRide'),'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail')));
		$findCustCustom = $this->User->find('first',array(
			'conditions'=>array('User.id'=>$user_id)
		));
		
		//pr($findCustCustom);
		$cards = array();
		if( $findCustCustom && isset($findCustCustom['UserCreditDetail']) ){
			/*foreach($findCustCustom as $key=>$val){
				$card_id = $val['UserCreditDetail']['id'];
				$default = $val['UserCreditDetail']['is_active'];
				$card_display = $val['UserCreditDetail']['credit_card_no'];
				$card_type = $val['UserCreditDetail']['cardtype'];
				$cardtypename = $val['UserCreditDetail']['cardtypename'];
				$data=array(
					'card_id'=>$card_id,
					'default'=>$default,
					'card_display'=>$card_display,
					'card_type'=>$card_type,
					'cardtypename'=>$cardtypename
				);
				
				array_push($cards,$data);
			} */
			$cards = $this->makecardarray($findCustCustom['UserCreditDetail']);
			die(json_encode(array('status'=>'1','credit_cards'=>$cards,'msg'=>'Card fetched successfully.')));
		}else{
			die(json_encode(array('status'=>'0','credit_cards'=>null,'msg'=>'No cards available.')));
		}
	}
	
	public function savedcards(){
		header('Content-Type:application/json');
		if($this->request->is('post')){
			if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
				$user_id = isset($this->request->data['user_id'])?$this->request->data['user_id']:0;
				if($user_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid use details')));
				}
				$cards = $this->usercreditcard($user_id);
				if(is_array($cards) && count($cards)>0){
					die(json_encode(array('status'=>'1','credit_cards'=>$cards,'msg'=>'Card fetched successfully.')));
				}
				else{
					die(json_encode(array('status'=>'0','credit_cards'=>null,'msg'=>'No cards available.')));
				}
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
	}
/**
 * Get ride details method service
 *
 * @return void
 */
	public function get_ride_details(){
		if($this->request->is('post')){
			if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
				$this->loadModel('Ride');
				$ride_id = isset($this->request->data['ride_id'])?$this->request->data['ride_id']:0;
				if($ride_id<=0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid Information Of ride')));
				}
				
				//unbind the model 
				$this->Ride->User->unbindModel(array('hasMany'=>array('CustomerRide','DriverRide','UserCreditDetail'),'hasOne'=>array('DriverCustom','VehicleDetail')));
				$this->Ride->Driver->unbindModel(array('hasMany'=>array('CustomerRide','DriverRide'.'UserCreditDetail'),'hasOne'=>array('CustomerCustom','VehicleDetail')));
				$findRide = $this->Ride->find('first',array(
					'recursive'=>2,
					'conditions'=>array('Ride.id'=>$ride_id,'Ride.user_id >'=>'0')
				));
				//pr($findRide);
				if(is_array($findRide) && count($findRide)>0){
					$basefilepath = FULL_BASE_URL.$this->base."/userPic/";
					//configure data of the customer
					$customer = array();
					if(isset($findRide['User']['CustomerCustom']['id'])){
						$cus_id 	= $findRide['User']['id'];
						$cus_f_name 	= $findRide['User']['f_name'];
						$cus_l_name 	= $findRide['User']['l_name'];
						$user_image 	= $findRide['User']['CustomerCustom']['user_image'];
						if($user_image!='' && count(explode('.',$user_image))>1){
							$user_image = $basefilepath.$user_image;
						}
						$rating = $this->userrattingsection($cus_id);
						$cus_lat = $findRide['User']['CustomerCustom']['lat'];
						$cus_lon = $findRide['User']['CustomerCustom']['long'];
						$customer = array(
							'first_name'=>$cus_f_name,
							'last_name'=>$cus_l_name,
							'profile_image'=>$user_image,
							'rating'=>$rating,
							'lat'=>$cus_lat,
							'lon'=>$cus_lon
						);
					}
					//driver array
					$driver = array();
					if(isset($findRide['Driver']['DriverCustom']['id'])){
						$drv_id 	= $findRide['Driver']['id'];
						$cus_f_name 	= $findRide['Driver']['f_name'];
						$cus_l_name 	= $findRide['Driver']['l_name'];
						$user_image 	= $findRide['Driver']['DriverCustom']['user_pic'];
						if($user_image!='' && count(explode('.',$user_image))>1){
							$user_image = $basefilepath.$user_image;
						}
						$rating = $this->userrattingsection($drv_id);
						$cus_lat = $findRide['User']['CustomerCustom']['lat'];
						$cus_lon = $findRide['User']['CustomerCustom']['long'];
						$driver = array(
							'first_name'=>$cus_f_name,
							'last_name'=>$cus_l_name,
							'profile_image'=>$user_image,
							'rating'=>$rating,
							'lat'=>$cus_lat,
							'lon'=>$cus_lon
						);
					}
					//ride array
					$ride=array();
					// Ride Data
					$ride_id 		= $findRide['Ride']['id'];
					$pickup 		= $findRide['Ride']['pick_up'];
					$pick_lat 		= $findRide['Ride']['pick_lat'];
					$pick_lon 		= $findRide['Ride']['pick_long'];
					$drop 			= $findRide['Ride']['drop_off'];
					$drop_lat 		= $findRide['Ride']['drop_lat'];
					$drop_lon 		= $findRide['Ride']['drop_long'];
					$date 			= $findRide['Ride']['date_time'];
					$instruction 		= $findRide['Ride']['instruction'];
					$ride_cost 		= $findRide['Ride']['distance_cost'];
					//ride array set
					$ride = array(
						'ride_id'=>$ride_id,
						'pickup'=>$pickup,
						'pick_lat'=>$pick_lat,
						'pick_lon'=>$pick_lon,
						'drop'=>$drop,
						'drop_lat'=>$drop_lat,
						'drop_lon'=>$drop_lon,
						'date'=>$date,
						'instruction'=>$instruction,
						'ride_cost'=>$ride_cost,
					);
					//city details
					$city=array();
					if(isset($findRide['City']["id"])){
						$city = array(
							'name'=>$findRide['City']["name"],
							'lat'=>$findRide['City']["center_lat"],
							'lon'=>$findRide['City']["center_lon"],
							'country'=>isset($findRide['City']["Country"]['name'])?$findRide['City']["Country"]['name']:''
						);
					}
					//vehicle details
					$vehicle=array();
					$data=array(
						'status'=>'1',
						'msg'=>'Ride details',
						'customer'=>$customer,
						"driver"=>$driver,
						'ride'=>$ride,
						'city'=>$city,
						'vehicle'=>$vehicle
					);
					die(json_encode($data));
				}
				die(json_encode(array('status'=>'0','msg'=>'Ride Not found')));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
	}
	
/**
 * Accept ride method service
 *
 * @return void
 */
	public function accept_ride(){
		header('Content-Type:application/json');
		$this->clearAllCache();
		$this->loadModel('Ride');
		//$this->loadModel('DriverCustom');
		$this->loadModel('Car');
		if(!$this->request->is('post')){
			die(json_encode(array('status'=>'0','message'=>'Authentication Error!')));
		}
		$this->write_log($this->request->data);
		$ride_id 	= (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0)?$this->request->data['ride_id']:0;
		$driver_lat = (isset($this->request->data['driver_lat']) && $this->request->data['driver_lat']!='')?$this->request->data['driver_lat']:0;
		$driver_lon = (isset($this->request->data['driver_lon']) && $this->request->data['driver_lon']!='')?$this->request->data['driver_lon']:0;
		$driver_id 	= (isset($this->request->data['driver_id']) && $this->request->data['driver_id']>0)?$this->request->data['driver_id']:0;
		$devicetype 	= (isset($this->request->data['device_type']) && $this->request->data['device_type']!='')?$this->request->data['device_type']:0;
		$text		= "Ride has been accepted.";
		$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
		//device type validate
		if($devicetype==0){
			die(json_encode(array('status'=>'0','message'=>'Invalid request')));
		}
		//validate data according to our secvice
		if($ride_id==0){
			die(json_encode(array('status'=>'0','message'=>'Ride Info missing')));
		}
		if($driver_id==0){
			die(json_encode(array('status'=>'0','message'=>'Driver Info missing')));
		}
		//update database
		
		// Updating the fields
		
		$this->Ride->updateAll(array('Ride.status'=>'1','Ride.driver_id'=>$driver_id, 'Ride.total_time'=>'0'),array('Ride.id'=>$ride_id,'Ride.user_id >'=>'0','Ride.status'=>'0'));
		
		//un bind model
		$this->Ride->User->unbindModel(array(
			'hasOne'=>array('DriverCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		
		//for driver
		$this->Ride->Driver->unbindModel(array(
			'hasOne'=>array('CustomerCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		$rDetails = $this->Ride->find('first',array(
			'recursive'=>2,
			'conditions'=>array('Ride.id'=>$ride_id,'Ride.user_id >'=>'0','Ride.driver_id'=>$driver_id)
		));
		/*//bind Driver model with selected vehicles
		$this->Ride->Driver->bindModel(array(
			'belongsTo'=>array(
				'SelectedVehicle'=>array(
					'className' => 'VehicleDetail',
					'foreignKey' => 'vehicle_detail_id',
					'conditions' => array('SelectedVehicle.isdefault'=>'1','SelectedVehicle.isapproved'=>'1','SelectedVehicle.user_id'=>$driver_id),
				)
			)
		));*/
		//pr($rDetails);
		//ride validation 
		if(!isset($rDetails) || !is_array($rDetails) || count($rDetails)==0){
			die(json_encode(array('status'=>'2','msg'=>'Ride Not found or accept by other driver')));
		}
		//status checking for cancellation
		if($rDetails['Ride']['status']==5){
			die(json_encode(array('status'=>'-1','msg'=>'Ride cancelled')));
		}
		//status checking for cancellation
		if($rDetails['Ride']['status']!=1){
			die(json_encode(array('status'=>'0','msg'=>'Ride Not found')));
		}
		//car basic info
		$vhcmanufacdate = "2003";
		$vhcplateno = 'UN02 2312';
		$vhcname = 'Ferrari';
		$vhcmodelname = 'Ambassador';
		
		// get drier vehicled details
		$vehicleid = $rDetails['Driver']['DriverCustom']['vehicle_detail_id'];
		$vehiclecon = array('VehicleDetail.user_id'=>$driver_id);
		$this->Ride->Driver->VehicleDetail->unbindModel(array('belongsTo'=>array('User')));
		$selectedVehicle = $this->Ride->Driver->VehicleDetail->find('first',array('conditions'=>$vehiclecon,'order'=>array('VehicleDetail.isdefault'=>'DESC','VehicleDetail.id'=>'DESC'),'limit'=>'1'));
		//pr($selectedVehicle);
		if(is_array($selectedVehicle) && count($selectedVehicle)>0){
			$vehicleid = $selectedVehicle['VehicleDetail']['id'];
			$vhcmanufacdate = date("Y",strtotime($selectedVehicle['VehicleDetail']['manufactureing_date']));
			$vhcplateno = $selectedVehicle['VehicleDetail']['vehicle_no'];
			$vhcname = isset($selectedVehicle['Car']['name'])?$selectedVehicle['Car']['name']:'';
			$vhcmodelname =  isset($selectedVehicle['CarModel']['name'])?$selectedVehicle['CarModel']['name']:'';
		}
		$vehicleinfo = $vhcname." ".$vhcmodelname." ".$vhcmanufacdate." ".$vhcplateno." ".$vehicleid;
		//now update the ride with driver vehicles details
		//un bind model
		$this->Ride->unbindModel(array(
			'belongsTo'=>array('User','Driver','City')
		));
		$this->Ride->updateAll(array('Ride.vehicleinfo'=>'"'.$vehicleinfo.'"'),array('Ride.id'=>$ride_id,'Ride.user_id >'=>'0','Ride.status'=>'1','Ride.driver_id'=>$driver_id));
		
		//die();
		//update driver position
		$this->Ride->Driver->DriverCustom->updateAll(array('DriverCustom.status'=>'2','DriverCustom.lat'=>$driver_lat,'DriverCustom.long'=>$driver_lon,'DriverCustom.vehicle_detail_id'=>$vehicleid),
		array('DriverCustom.user_id'=>$driver_id));
		
		// SENDING PUSH NOTIFICATIONS
		
		//Sending android notifications
		$textmsg = "Order accepted";
		
		/*if(isset($rDetails['Driver']['VehicleDetail']) && is_array($rDetails['Driver']['VehicleDetail']) && count($rDetails['Driver']['VehicleDetail'])>0){
			$vehicle = $rDetails['Driver']['VehicleDetail'];
			
			$vhcmanufacdate = $vehicle['manufactureing_date'];
			$vhcplateno = $vehicle['vehicle_no'];
			$vhcid = $vehicle['car_id'];
			//get car name from the table 
			$car = $this->Car->find('first',array('recursive'=>'0','conditions'=>array('Car.id'=>$vhcid)));
			if(isset($car) && is_array($car) && count($car)>0){
				$vhcname = $car['Car']['name'];
				$vhcmodelname = $car['CarModel']['name'];
			}
		}*/
		//driver image 
		$driverimg = '';
		$dlat =$driver_lat ;
		$dlon =$driver_lon;
		$companyname = "";
		$drating = $this->userrattingsection($driver_id,'1');
		
		if(isset($rDetails['Driver']['DriverCustom']) && is_array($rDetails['Driver']['DriverCustom']) && count($rDetails['Driver']['DriverCustom'])>0){
			$driverCustome = $rDetails['Driver']['DriverCustom'];
			$companyname = $driverCustome['company_name'];
			if($driverCustome['user_pic']!=''){
				$driverimg = FULL_BASE_URL.$this->base."/userPic/thumb_".$driverCustome['user_pic'];
				//$dlat = $driverCustome['lat'];
				//$dlon = $driverCustome['long'];
			}
		}
		//driver details
		$drivername = '';
		$drivermobileno = '';
		if(isset($rDetails['Driver']) && is_array($rDetails['Driver']) && count($rDetails['Driver'])>0){
			$drivername = ucwords($rDetails['Driver']['f_name']." ".$rDetails['Driver']['l_name']);
			$drivermobileno = $rDetails['Driver']['mobile'];
		}
		//customer custome sedails
		$pushid='';
		$cuslon=0;
		$cuslat = 0;
		$userdevicetype=0;
		if(isset($rDetails['User']['CustomerCustom']) && is_array($rDetails['User']['CustomerCustom']) && count($rDetails['User']['CustomerCustom'])>0){
			$customerCustome = $rDetails['User']['CustomerCustom'];
			$pushid = $customerCustome['device_unique_id'];
			$cuslat = $customerCustome['lat'];
			$cuslon = $customerCustome['long'];
			$userdevicetype = $customerCustome['device_type'];
		}
		//get pick up location distance
		$pickuplat = $rDetails['Ride']['pick_lat'];
		$pickuplon = $rDetails["Ride"]['pick_long'];
		
		//get estimated time
		$estTime = "0";
		if($pushid!=''){
			$this->siteconfiguration($company_id);
			$distanceDuration  = $this->getDistanceAndDuration($pickuplat,$pickuplon,$driver_lat,$driver_lon,$this->googleServerKey);
			//pr($distanceDuration);
			if(isset($distanceDuration['status']) && $distanceDuration['status']==1){
				$driverdeatils = array_slice($distanceDuration,1);
				$estTime = $driverdeatils['duration'];
				//$estTime = $driverdeatils['durationinminit'];
			}
		}
		
		//push custom
		$custom = array( 
			'ride_id'=> $ride_id,
			'drid'=> $driver_id,
			'drname'=> $drivername,
			'drtel'=> $drivermobileno,
			'drmfd'=> $vhcmanufacdate,
			'drplateno'=> $vhcplateno,
			'drcarnm'=> $vhcname,
			'drcarmodel'=>$vhcmodelname,
			'drimg'=> $driverimg,
			'taktm'=> $estTime,
			'text'=> $text,
			'status'=> 1,
			'dlat'=> $dlat,
			'dlon'=> $dlon,
			'clat'=> $cuslat,
			'clon'=> $cuslon,
			'companynm'=> $companyname,
			'drating'=>$drating
		);
		//pr($custom);
		//send push 
		if($userdevicetype=='1'){
			if($pushid!=''){
				$registration_ids = array($pushid);
				$this->appandroidpushnotify($registration_ids, $this->CustomerAppkey, $textmsg, $custom);
			}
		}
		elseif($userdevicetype==2){
			//ios section
			if($pushid!=''){
				$this->iospushnotification($pushid, $textmsg, $custom,1,2,$company_id);
			}
		}
		else{
			// Sending IPhone notification
		}
		//return to the driver section 
		die(json_encode(array('status'=>'1','msg'=>'You accepted the ride and notification send to the customer successfully.')));
	}
/**
 * Arriving now method service
 *
 * @return void
 */
	public function arriving_now(){
		header('Content-Type:application/json');
		$this->loadModel('Ride');
		//$this->loadModel('DriverCustom');
		if(!$this->request->is('post')){
			die(json_encode(array('status'=>'0','msg'=>'Authentication Error!.')));
		}
		$this->write_log($this->request->data);
		$ride_id 	= (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0)?$this->request->data['ride_id']:0;
		$driver_lat = (isset($this->request->data['driver_lat']) && $this->request->data['driver_lat']!='')?$this->request->data['driver_lat']:0;
		$driver_lon = (isset($this->request->data['driver_lon']) && $this->request->data['driver_lon']!='')?$this->request->data['driver_lon']:0;
		$driver_id 	= (isset($this->request->data['driver_id']) && $this->request->data['driver_id']>0)?$this->request->data['driver_id']:0;
		$devicetype 	= (isset($this->request->data['device_type']) && $this->request->data['device_type']!='')?$this->request->data['device_type']:0;
		$text		= "Driver is arriving.";
		$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
		//device type validate
		if($devicetype==0){
			die(json_encode(array('status'=>'0','message'=>'Invalid request')));
		}
		//validate data according to our secvice
		if($ride_id==0){
			die(json_encode(array('status'=>'0','message'=>'Ride Info missing')));
		}
		if($driver_id==0){
			die(json_encode(array('status'=>'0','message'=>'Driver Info missing')));
		}
		//ride valied conditions
		$ridecon = array('Ride.id'=>$ride_id,'Ride.driver_id'=>$driver_id,'Ride.user_id >'=>'0','Ride.status'=>'1');
		//ride update
		$this->Ride->updateAll(array('Ride.status'=>'2'),$ridecon);
		
		//driver update
		$this->Ride->Driver->DriverCustom->updateAll(array('DriverCustom.lat'=>$driver_lat,'DriverCustom.long'=>$driver_lon),array('DriverCustom.user_id'=>$driver_id));
		
		//get ride details
		//un bind model
		$this->Ride->User->unbindModel(array(
			'hasOne'=>array('DriverCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		
		//for driver
		$this->Ride->Driver->unbindModel(array(
			'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		//ride fetch condition change
		unset($ridecon['Ride.status']);
		$ridecon['Ride.status >']='1';
		//pr($ridecon);
		$rDetails = $this->Ride->find('first',array(
			'recursive'=>2,
			'conditions'=>$ridecon
		));
		if(is_array($rDetails) && count($rDetails)==0){
			die(json_encode(array('status'=>'0','msg'=>'Invalid ride details')));
		}
		//status checking for cancellation
		if($rDetails['Ride']['status']==5){
			die(json_encode(array('status'=>'-1','msg'=>'Ride cancelled')));
		}
		
		if($rDetails['Ride']['status']!=2){
			die(json_encode(array('status'=>'0','msg'=>'Invalid ride status details')));
		}
		//pr($rDetails);
		//customer section
		$customerdevicetype=0;
		$pushid='';
		if(isset($rDetails['User']['CustomerCustom']) && is_array($rDetails['User']['CustomerCustom']) && count($rDetails['User']['CustomerCustom'])>0){
			$customerCusDetails = $rDetails['User']['CustomerCustom'];
			$customerdevicetype = $customerCusDetails['device_type'];
			$pushid = $customerCusDetails['device_unique_id'];
		}
		
		//DRIver details
		$estTime=0;
		$drating=0;
		$companyname='';
		$driverimg="";
		$drivermobileno='';
		$drivername='';
		
		$vhcmodelname='';
		$vhcname='';
		$vhcplateno='';
		$vhcmanufacdate='';
		
		if(isset($rDetails['Driver']) && is_array($rDetails['Driver']) && count($rDetails['Driver'])>0){
			$drating = $this->userrattingsection($driver_id,'1');
			$drivername = ucwords($rDetails['Driver']['f_name']." ".$rDetails['Driver']['l_name']);
			$drivermobileno = $rDetails['Driver']['mobile'];
			$driverCustome = (isset($rDetails['Driver']['DriverCustom']['company_name']))?$rDetails['Driver']['DriverCustom']:'';
			if($driverCustome!=''){
				$companyname = $driverCustome['company_name'];
				if($driverCustome['user_pic']!=''){
					$driverimg = FULL_BASE_URL.$this->base."/userPic/thumb_".$driverCustome['user_pic'];
				}
			}
			
		}
		//vehicle information of the ride
		if($rDetails['Ride']['vehicleinfo']!=''){
			$vehiclDtl = explode(" ",$rDetails['Ride']['vehicleinfo']);
			if(is_array($vehiclDtl) && count($vehiclDtl)>1){
				$vhcname = isset($vehiclDtl[0])?$vehiclDtl[0]:'';
				$vhcmodelname = isset($vehiclDtl[1])?$vehiclDtl[1]:'';
				$vhcmanufacdate = isset($vehiclDtl[2])?$vehiclDtl[2]:'';
				$vhcplateno = isset($vehiclDtl[3])?$vehiclDtl[3]:'';
			}
		}
		else{
			// get drier vehicled details
			$vehiclecon = array('VehicleDetail.user_id'=>$driver_id);
			$this->Ride->Driver->VehicleDetail->unbindModel(array('belongsTo'=>array('User')));
			$selectedVehicle = $this->Ride->Driver->VehicleDetail->find('first',array('conditions'=>$vehiclecon,'order'=>array('VehicleDetail.isdefault'=>'DESC','VehicleDetail.id'=>'DESC'),'limit'=>'1'));
			//pr($selectedVehicle);
			if(is_array($selectedVehicle) && count($selectedVehicle)>0){
				//$vehicleid = $selectedVehicle['VehicleDetail']['id'];
				$vhcmanufacdate = date("Y",strtotime($selectedVehicle['VehicleDetail']['manufactureing_date']));
				$vhcmodelname =  isset($selectedVehicle['CarModel']['name'])?$selectedVehicle['CarModel']['name']:'';
				$vhcplateno = $selectedVehicle['VehicleDetail']['vehicle_no'];
				$vhcname = isset($selectedVehicle['Car']['name'])?$selectedVehicle['Car']['name']:'';
			}	
		}
		
		//customer position or pickup position
		//get pick up location distance
		$pickuplat = $rDetails['Ride']['pick_lat'];
		$pickuplon = $rDetails["Ride"]['pick_long'];
		//if push present then
		if($pushid!=''){
			$this->siteconfiguration($company_id);
			$distanceDuration  = $this->getDistanceAndDuration($pickuplat,$pickuplon,$driver_lat,$driver_lon,$this->googleServerKey);
			//pr($distanceDuration);
			if(isset($distanceDuration['status']) && $distanceDuration['status']==1){
				$driverdeatils = array_slice($distanceDuration,1);
				$estTime = $driverdeatils['duration'];
				//$estTime = $driverdeatils['durationinminit'];
			}
		}
		//push custome data
		//send android notifications
		$custom = array( 
			'text'=> $text,
			'dlat'=> $driver_lat,
			'status'=> 2,
			'dlon'=> $driver_lon,
			'taktm'=> $estTime,
			'ride_id'=>$ride_id,
			'clat'=>$pickuplat,
			'clon'=>$pickuplon,
			'drating'=>$drating,
			'companynm'=> $companyname,
			'drid'=> $driver_id,
			'drname'=> $drivername,
			'drimg'=> $driverimg,
			'drtel'=> $drivermobileno,
			'drcarmodel'=>$vhcmodelname,
			'drcarnm'=> $vhcname,
			'drplateno'=> $vhcplateno,
			'drmfd'=> $vhcmanufacdate
		);
		//pr($custom);
		//die();
		//push send
		if($customerdevicetype=='1'){
			
			if($pushid!=''){
				$registration_ids = array($pushid);
				$this->appandroidpushnotify($registration_ids,$this->CustomerAppkey,$text,$custom);
			}
		}
		elseif($customerdevicetype==2){
			//ios section
			if($pushid!=''){
				$this->iospushnotification($pushid, $text, $custom, 1, 2,$company_id);
			}
		}
		else{
		}
		
		//driver get the alert
		die(json_encode(array('status'=>'1','msg'=>'Your arriving status Notify to the customer.')));
	}
	
/**
 * Update driver position for tracking method service
 *
 * @return void
 */
	public function driverss_ride_tracking(){
		$this->loadModel('RideTrace');
		//$this->loadModel('DriverCustom');
		$this->RideTrace->create();
		$saveData['RideTrace']['ride_id'] 		= $this->request->data['ride_id'];
		$saveData['RideTrace']['lat'] 			= $this->request->data['driver_lat'];
		$saveData['RideTrace']['long'] 			= $this->request->data['driver_lon'];
		$saveData['RideTrace']['ride_status'] 	= $this->request->data['ride_status'];
		//now update the driver position also
		
		if ($this->RideTrace->save($saveData)) {
			die(json_encode(array('status'=>'1','msg'=>'Traced Successfully.')));
		}else{
			die(json_encode(array('status'=>'0','msg'=>'Cannot trace, please try again later.')));
		}
	}
	
/**
 * Start trip method service
 *
 * @return void
 */
	public function start_trip(){
		header('Content-Type:application/json');
		$this->loadModel('Ride');
		if(!$this->request->is('post')){
			die(json_encode(array('status'=>'0','msg'=>'Authentication Error!.')));
		}
		//write log for test
		$this->write_log($this->request->data);
		
		$driver_lat = (isset($this->request->data['driver_lat']) && $this->request->data['driver_lat']!='')?$this->request->data['driver_lat']:'0';
		$driver_lon = (isset($this->request->data['driver_lon']) && $this->request->data['driver_lon']!='')?$this->request->data['driver_lon']:'0';
		$ride_id 	= (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0)?$this->request->data['ride_id']:0;
		$driver_id 	= (isset($this->request->data['driver_id']) && $this->request->data['driver_id']>0)?$this->request->data['driver_id']:0;
		$devicetype 	= (isset($this->request->data['device_type']) && $this->request->data['device_type']!='')?$this->request->data['device_type']:0;
		$text = "Trip Started";
		$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
		//device type validate
		if($devicetype==0){
			die(json_encode(array('status'=>'0','message'=>'Invalid request')));
		}
		//validate data according to our secvice
		if($ride_id==0){
			die(json_encode(array('status'=>'0','message'=>'Ride Info missing')));
		}
		if($driver_id==0){
			die(json_encode(array('status'=>'0','message'=>'Driver Info missing')));
		}
		
		// new logic for get city configuration
		$ridecon = array('Ride.id'=>$ride_id,'Ride.driver_id'=>$driver_id,'Ride.user_id >'=>'0','Ride.status'=>'2');
		//update the ride
		$this->Ride->updateAll(array('Ride.status'=>'3'),$ridecon);
		//driver update
		$this->Ride->Driver->DriverCustom->updateAll(array('DriverCustom.lat'=>$driver_lat,'DriverCustom.long'=>$driver_lon),array('DriverCustom.user_id'=>$driver_id));
		
		//un bind model
		$this->Ride->User->unbindModel(array(
			'hasOne'=>array('DriverCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		//for driver
		$this->Ride->Driver->unbindModel(array(
			'hasOne'=>array('CustomerCustom'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		//aftrer update ride condition change
		unset($ridecon['Ride.status']);
		$ridecon['Ride.status >']='2';
		$rDetails = $this->Ride->find('first',array(
			'recursive'=>2,
			'conditions'=>$ridecon
		));
		
		//pr($rDetails);
		if(!isset($rDetails) || !is_array($rDetails) || count($rDetails)==0){
			die(json_encode(array('status'=>'0','msg'=>'Invalid Information of the ride')));
		}
		//status checking for cancellation
		if($rDetails['Ride']['status']==5){
			die(json_encode(array('status'=>'-1','msg'=>'Ride cancelled')));
		}
		if($rDetails['Ride']['status']!=3){
			die(json_encode(array('status'=>'0','msg'=>'Invalid Status of the ride')));
		}
		
		//set site configuration setting
		$this->siteconfiguration($company_id);
		
		//validate if the city has ride configaration
		$cityid=0;
		$cityPricesetting = array();
		if(isset($rDetails['City']['PriceSetting']) && count($rDetails['City']['PriceSetting'])>0){
			$cityPricesetting = $rDetails['City']['PriceSetting'];
		}
		else{
			//if city id not found in the ride info then
			$cityresult=array();
			$picupcityname  = ''; // cityname
			if($driver_lat!='' && $driver_lon!=''){
				// city id fetching from lat and long
				$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$driver_lat.",".$driver_lon;
				if($this->googleServerKey!=''){
					$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$driver_lat.",".$driver_lon."&key=".$this->googleServerKey;
				}
				$data = @file_get_contents($url);
				$jsondata = json_decode($data,true);
				//pr($jsondata);
				//die();
				if($jsondata["status"]=='OK' || $jsondata["status"]=='ok'){
				  foreach ($jsondata["results"] as $result) {
					foreach ($result["address_components"] as $address) {
						if (in_array("locality", $address["types"])) {
							$picupcityname = $address["long_name"];
						}
					}
				  }
				}
			}
			//get the city name is present or not into the server
			
			if($picupcityname!=''){
				$cityresult = $this->Ride->City->find('first',array(
				   'conditions'=>array('City.name LIKE'=>'%'.$picupcityname.'%','City.is_active'=>'0','City.company_id'=>$company_id)
				));
			}
			if(isset($cityresult)&& count($cityresult) > 0){
				$cityid  = $cityresult['City']['id'];
				$cityPricesetting = $cityresult['PriceSetting'];
			}
		}
		//if price setting not found then get defaul one setting
		if(is_array($cityPricesetting) && count($cityPricesetting)==0){
			$defaultCity = $this->Ride->City->PriceSetting->find('first',array('conditions'=>array('PriceSetting.company_id'=>$company_id)));
			if(is_array($defaultCity) && count($defaultCity)>0){
				$cityid  = $defaultCity['City']['id'];
				$cityPricesetting = $defaultCity['PriceSetting'];
			}
		}
		//get driver details with vehicle information
		
		$drating=0;
		$companyname='';
		$driverimg="";
		$drivermobileno='';
		$drivername='';
		
		$vhcmodelname='';
		$vhcname='';
		$vhcplateno='';
		$vhcmanufacdate='';
		
		if(isset($rDetails['Driver']) && is_array($rDetails['Driver']) && count($rDetails['Driver'])>0){
			$drating = $this->userrattingsection($driver_id,'1');
			$drivername = ucwords($rDetails['Driver']['f_name']." ".$rDetails['Driver']['l_name']);
			$drivermobileno = $rDetails['Driver']['mobile'];
			$driverCustome = (isset($rDetails['Driver']['DriverCustom']['company_name']))?$rDetails['Driver']['DriverCustom']:'';
			if($driverCustome!=''){
				$companyname = $driverCustome['company_name'];
				if($driverCustome['user_pic']!=''){
					$driverimg = FULL_BASE_URL.$this->base."/userPic/thumb_".$driverCustome['user_pic'];
				}
			}
			
		}
		//vehicle information of the ride
		if($rDetails['Ride']['vehicleinfo']!=''){
			$vehiclDtl = explode(" ",$rDetails['Ride']['vehicleinfo']);
			if(is_array($vehiclDtl) && count($vehiclDtl)>1){
				$vhcname = isset($vehiclDtl[0])?$vehiclDtl[0]:'';
				$vhcmodelname = isset($vehiclDtl[1])?$vehiclDtl[1]:'';
				$vhcmanufacdate = isset($vehiclDtl[2])?$vehiclDtl[2]:'';
				$vhcplateno = isset($vehiclDtl[3])?$vehiclDtl[3]:'';
			}
		}
		else{
			// get drier vehicled details
			$vehiclecon = array('VehicleDetail.user_id'=>$driver_id);
			$this->Ride->Driver->VehicleDetail->unbindModel(array('belongsTo'=>array('User')));
			$selectedVehicle = $this->Ride->Driver->VehicleDetail->find('first',array('conditions'=>$vehiclecon,'order'=>array('VehicleDetail.isdefault'=>'DESC','VehicleDetail.id'=>'DESC'),'limit'=>'1'));
			//pr($selectedVehicle);
			if(is_array($selectedVehicle) && count($selectedVehicle)>0){
				//$vehicleid = $selectedVehicle['VehicleDetail']['id'];
				$vhcmanufacdate = date("Y",strtotime($selectedVehicle['VehicleDetail']['manufactureing_date']));
				$vhcmodelname =  isset($selectedVehicle['CarModel']['name'])?$selectedVehicle['CarModel']['name']:'';
				$vhcplateno = $selectedVehicle['VehicleDetail']['vehicle_no'];
				$vhcname = isset($selectedVehicle['Car']['name'])?$selectedVehicle['Car']['name']:'';
			}	
		}
		$pickuplat = $rDetails['Ride']['pick_lat'];
		$pickuplon = $rDetails["Ride"]['pick_long'];
		//now final validate
		if( count($cityPricesetting) > 0){
			//if city id present then update the ride
			if($cityid>0){
				$this->Ride->updateAll(array('Ride.city_id'=>$cityid),$ridecon);
			}
			
			$driver_id = $rDetails['Driver']['id'];
			$devicetype = $rDetails['User']['CustomerCustom']['device_type'];
			$pushid = $rDetails['User']['CustomerCustom']['device_unique_id'];
			/*if(isset($rDetails['City']['CityConfiguration']) && is_array($rDetails['City']['CityConfiguration']) && count($rDetails['City']['CityConfiguration'])>0){
				$cityConfigArray = $rDetails['City']['CityConfiguration'];
				$farepermeter	= $cityConfigArray['fare_per_kilometer'];
				$interfaredistance= $cityConfigArray['inter_fare_distance'];//minimun distance in meter
				$basefare	= $cityConfigArray['base_fare'];
				$basedistance	= $cityConfigArray['base_distance'];
				$fareperminute	= $cityConfigArray['fare_per_minute'];
				$interfaretime	= $cityConfigArray['inter_fare_time'];
				$basewaittime	= $cityConfigArray['base_wait_time'];
				$addwaittm 	= $cityConfigArray['additional_wait_time'];
				$addwaitamount	= $cityConfigArray['additional_wait_amount'];
			}
			else{
				$farepermeter = "20"; // per kilometer
				$interfaredistance= "5000"; //minimun distance in meter
				$basefare = "20";
				$basedistance = "1000";//meter
				$fareperminute="2";
				$interfaretime="0";
				$basewaittime="0";
				$addwaittm="60"; //second
				$addwaitamount="1";
			} */
			//now set the value of the param
			
			$farepermeter		= $cityPricesetting['fare_per_meter'];
			$interfaredistance	= $cityPricesetting['inter_fare_distance'];//minimun distance in meter
			$basefare		= $cityPricesetting['base_fare'];
			$basedistance		= $cityPricesetting['base_distance'];
			$fareperminute		= $cityPricesetting['fare_per_minute'];
			$interfaretime		= $cityPricesetting['inter_fare_time'];
			$basewaittime		= $cityPricesetting['base_waiting_time'];
			$addwaittm 		= $cityPricesetting['additional_wait_time'];
			$addwaitamount		= $cityPricesetting['additional_wait_amount'];
			
			//$resultperkm  = (($farepermeter/1000) * $interfaredistance);
			//make sendigng data for boyh type of app
			if($driver_lat=='' || $driver_lon==''){
				$driver_lat = $rDetails['Driver']['DriverCustom']['lat'];
				$driver_lon = $rDetails['Driver']['DriverCustom']['long'];
			}
			$custom = array( 
				'text'=> $text,
				'dlat'=> $driver_lat,
				'dlon'=> $driver_lon,
				/*'cityname'=> $rDetails['City']['name'],
				'basefare'=> $basefare,
				'basedistance'=> $basedistance,
				'farepermeter'=> $farepermeter,
				'fareperminute'=> $fareperminute,
				'interfaredistance'=> $interfaredistance,
				'interfaretime'=> $interfaretime,
				'basewaittime'=>$basewaittime,
				'additionalwaitingtime'=>$addwaittm,
				'additionalwaitingamount'=>$addwaitamount,*/
				'status'=> $rDetails['Ride']['status'],
				'taktm'=>'0',
				'ride_id'=>$ride_id,
				'drid'=> $driver_id,
				'drname'=> $drivername,
				'drtel'=> $drivermobileno,
				'drimg'=> $driverimg,
				'drating'=>$drating,
				'companynm'=> $companyname,
				'clat'=> $pickuplat,
				'clon'=> $pickuplon,
				'drmfd'=> $vhcmanufacdate,
				'drplateno'=> $vhcplateno,
				'drcarnm'=> $vhcname,
				'drcarmodel'=>$vhcmodelname
			);
			$drivercustome = array( 
				'text'=> $text,
				'dlat'=> $driver_lat,
				'dlon'=> $driver_lon,
				'cityname'=> $rDetails['City']['name'],
				'basefare'=> $basefare,
				'basedistance'=> $basedistance,
				'farepermeter'=> $farepermeter,
				'fareperminute'=> $fareperminute,
				'interfaredistance'=> $interfaredistance,
				'interfaretime'=> $interfaretime,
				'basewaittime'=>$basewaittime,
				'additionalwaitingtime'=>$addwaittm,
				'additionalwaitingamount'=>$addwaitamount,
				'status'=> $rDetails['Ride']['status']
			);
			//pr($custom);
			if($devicetype=='1'){
				
				if($pushid!=''){
					$registration_ids = array($pushid);
					$this->appandroidpushnotify($registration_ids,$this->CustomerAppkey,$text,$custom);	
				}

			}
			elseif($devicetype=='2'){
				//ios section
				if($pushid!=''){
					$this->iospushnotification($pushid, $text, $custom, 1, 2,$company_id);
				}
			}
			else{
				// send to the notification on ios device pendding ork
			}
			
			// display on driver screen message
			die(json_encode(array('custom'=>$drivercustome,'status'=>'1','msg'=>'Trip started and notification send to the customer.')));
		}
		else{
			die(json_encode(array('status'=>'0','msg'=>'Service Not Available!. Please try after some time. ')));
		}
		die(json_encode(array('status'=>'0','msg'=>'Service Not Available!. Please try after some time. ')));
	}

/**
 * End trip method service
 *
 * @return void
 */
	public function end_trip(){
		header('Content-Type:application/json');
		$this->loadModel('Ride');
		if(!$this->request->is('post')){
			die(json_encode(array('status'=>'0','msg'=>'Authentication Error!.')));
		}
		//write log for test
		$this->write_log($this->request->data);
		$driver_lat = (isset($this->request->data['driver_lat']) && $this->request->data['driver_lat']!='')?$this->request->data['driver_lat']:'0';
		$driver_lon = (isset($this->request->data['driver_lon']) && $this->request->data['driver_lon']!='')?$this->request->data['driver_lon']:'0';
		$ride_id 	= (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0)?$this->request->data['ride_id']:0;
		$driver_id 	= (isset($this->request->data['driver_id']) && $this->request->data['driver_id']>0)?$this->request->data['driver_id']:0;
		$ridecost 	= (isset($this->request->data['ride_cost']))?explode(" ",$this->request->data['ride_cost']):'0.0';
		$devicetype 	= (isset($this->request->data['device_type']) && $this->request->data['device_type']!='')?$this->request->data['device_type']:0;
		$text = "Trip Ended";
		$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
		//device type validate
		if($devicetype==0){
			die(json_encode(array('status'=>'0','message'=>'Invalid request')));
		}
		//validate data according to our secvice
		if($ride_id==0){
			die(json_encode(array('status'=>'0','message'=>'Ride Info missing')));
		}
		if($driver_id==0){
			die(json_encode(array('status'=>'0','message'=>'Driver Info missing')));
		}
		
		if(is_array($ridecost) && count($ridecost)==2){
			//$ride_cost 	= $this->request->data['ride_cost'];
			$ride_cost = $ridecost[0];
			$currency = $ridecost[1];
		}
		else{
			$currency="$";
			$ride_cost = (is_numeric($ridecost[0]))?$ridecost[0]:'0.0';
		}
		// new logic for get city configuration
		$ridecon = array('Ride.id'=>$ride_id,'Ride.driver_id'=>$driver_id,'Ride.user_id >'=>'0','Ride.status'=>'3');
		
		$this->Ride->updateAll(array('Ride.status'=>'4','Ride.distance_cost'=>number_format($ride_cost,2,'.','')),$ridecon);
		//update driver position
		$this->Ride->Driver->DriverCustom->updateAll(array('DriverCustom.lat'=>$driver_lat,'DriverCustom.long'=>$driver_lon),array('DriverCustom.user_id'=>$driver_id));
		
		//unbind user models
		$this->Ride->User->unbindModel(array(
			'hasOne'=>array('DriverCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
		));
		//unbind ride model
		$this->Ride->unbindModel(array(
			'belongsTo'=>array('City')
		));
		//unbind driver model
		$this->Ride->Driver->unbindModel(array(
			'hasOne'=>array('CustomerCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		//aftrer update ride condition change
		
		$ridecon['Ride.status']='4';
		$rDetails = $this->Ride->find('first',array(
			'recursive'=>2,
			'conditions'=>$ridecon
		));
		if(is_array($rDetails) && count($rDetails)==0){
			die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Information')));
		}
		
		// chhose the payment mode
		$transactionid = 0;
		$paymentdone=1;
		$referral_allowed = 1;
		$paymentmode = $rDetails['Ride']['payment_option'];
		$nwpaymentmode=$paymentmode;
		if($paymentmode==1){
			$card_id = $rDetails['Ride']['card_id'];
			$amount = $ride_cost;
			//credit card payment
			$paymentreturn = $this->usercardpayment($card_id,$amount);
			if(is_array($paymentreturn)){
				$ispayment = isset($paymentreturn['status'])?$paymentreturn['status']:0;
				$paymsg = isset($paymentreturn['msg'])?$paymentreturn['msg']:'';
				$transactionid = $paymentreturn['transactionid'];
			}
			if($ispayment==0){
				$paymentdone=0;
				//die(json_encode(array('status'=>'0','msg'=>$paymsg)));
			}
		}
		elseif($paymentmode==2){
			// refferal point payment
			$userearning = $rDetails['User']['currentcredit'];
			$customer_id = $rDetails['User']['id'];
			if($userearning > $ride_cost){
				//then make payment
				//credit point deduct from currentcredit
				$this->diductridecommitions($ride_cost,$customer_id,$company_id,$ride_id,0,2);
			}
			else{
				$referral_allowed=0;
				$nwpaymentmode=0;
				$paymentmode=0;
			}
		}
		else{
			//cash payment
			$paymentdone=1;
			//$referral_allowed=1;
			$paymentmode=0;
			$nwpaymentmode=0;
		}
		
		//now section for refferal section edited on 30-12-2014 By mrinmoy das
		$custonerid=0;
		$customer_refferalby_id=0;
		$driverid=0;
		$driver_refferalby_id=0;
		$taxicelCommition = 12;
		$refferaldistributioncommision=50;
		$customerreferralcommitionper = 50;
		$totalCommitionAmount = 0;
		$userCommitionAmount = 0;
		$drivercommision=0;
		$customercommision=0;
		$admincommitionearn=0;
		$drivercommitions=0;
		//configuration settings
		//$configuration = $this->Configuration->find('first');
		$configuration = $this->ridecommitionsetting($company_id);
		//pr($configuration);
		if(isset($configuration) && is_array($configuration) && count($configuration)>0){
			$taxicelCommition = $configuration['ride_commision'];
			$refferaldistributioncommision = $configuration['referal_percentage'];
			$customerreferralcommitionper = $configuration['customer_referral_per'];
		}
		
		if(isset($rDetails['Ride']['distance_cost']) && $rDetails['Ride']['distance_cost']>0 && $paymentmode!=2){
			$totalCommitionAmount = (($rDetails['Ride']['distance_cost']*$taxicelCommition)/100);
			$userCommitionAmount = (($totalCommitionAmount*$refferaldistributioncommision)/100);
		}
		else{
			///$totalCommitionAmount = $rDetails['Ride']['distance_cost'];
			$totalCommitionAmount = (($rDetails['Ride']['distance_cost']*$taxicelCommition)/100);
			$drivercommitions = $rDetails['Ride']['distance_cost']-$totalCommitionAmount;
			$userCommitionAmount=0;
			//$taxicelCommition=0;
			$refferaldistributioncommision=0;
		}
		//first chech the refferal id of user (customer)
		$custonerid = $rDetails['User']['id'];
		if(isset($rDetails['User']['reffered_by']) && $rDetails['User']['reffered_by']>0){
			$customer_refferalby_id = $rDetails['User']['reffered_by'];
			
		}
		//first chech the refferal id of user (driver)
		if(isset($rDetails['Driver']['reffered_by']) && $rDetails['Driver']['reffered_by']>0){
			$driver_refferalby_id = $rDetails['Driver']['reffered_by'];
			$driverid = $rDetails['Driver']['id'];
		}
		
		//update the ride table with cost distributions
		//unbind ride model
		$this->Ride->unbindModel(array(
			'belongsTo'=>array('City','User','Driver')
		));
		
		/*if($driver_refferalby_id>0 || $customer_refferalby_id>0){
			$this->Ride->updateAll(array('Ride.commission_cost'=>($totalCommitionAmount-$userCommitionAmount),
				'Ride.refferal_cost'=>$userCommitionAmount,
				'Ride.commission_paid'=>'0',
				'Ride.comision_per'=>$taxicelCommition,
				'Ride.refferal_per'=>$refferaldistributioncommision,
				'Ride.transaction_id'=>$transactionid,
				'Ride.paymentdone'=>$paymentdone,
				'Ride.payment_option'=>$nwpaymentmode
				),
			  $ridecon);
		}
		else{
			$this->Ride->updateAll(array('Ride.commission_cost'=>($totalCommitionAmount),
				'Ride.refferal_cost'=>'0',
				'Ride.commission_paid'=>'0',
				'Ride.comision_per'=>$taxicelCommition,
				'Ride.refferal_per'=>0,
				'Ride.transaction_id'=>$transactionid,
				'Ride.paymentdone'=>$paymentdone,
				'Ride.payment_option'=>$nwpaymentmode
				),
			  $ridecon);
		}*/
		//new sectons
		$admincommitionearn = ($totalCommitionAmount-$userCommitionAmount);
		$rideendclicktowise=0;
		if($rDetails['Ride']['commission_cost']>0){
			$rideendclicktowise=1;
		}
		if($customer_refferalby_id>0 || $nwpaymentmode==2){
			
			if($nwpaymentmode==2){
				$admincommitionearn = $totalCommitionAmount;
				//$userCommitionAmount=0;
			}
			$this->Ride->updateAll(array('Ride.commission_cost'=>($totalCommitionAmount),
				'Ride.admin_commision'=>$admincommitionearn,
				'Ride.refferal_cost'=>$userCommitionAmount,
				'Ride.commission_paid'=>'1',
				'Ride.comision_per'=>$taxicelCommition,
				'Ride.refferal_per'=>$refferaldistributioncommision,
				'Ride.transaction_id'=>$transactionid,
				'Ride.paymentdone'=>$paymentdone,
				'Ride.payment_option'=>$nwpaymentmode,
				'Ride.is_admin_referral'=>'0',
				'Ride.drivercommision'=>$drivercommitions
				),
			  $ridecon);
		}
		else{
			
			$userCommitionAmount = $userCommitionAmount/2;
			
			$this->Ride->updateAll(array('Ride.commission_cost'=>($totalCommitionAmount),
				'Ride.admin_commision'=>($admincommitionearn+$userCommitionAmount),
				'Ride.refferal_cost'=>$userCommitionAmount,
				'Ride.commission_paid'=>'1',
				'Ride.comision_per'=>$taxicelCommition,
				'Ride.refferal_per'=>($refferaldistributioncommision),
				'Ride.transaction_id'=>$transactionid,
				'Ride.paymentdone'=>$paymentdone,
				'Ride.payment_option'=>$nwpaymentmode,
				'Ride.is_admin_referral'=>'1',
				'Ride.drivercommision'=>'0'
				),
			  $ridecon);
		}
		//cost distribution

		/*if($userCommitionAmount>0){
			if($driver_refferalby_id>0 && $customer_refferalby_id>0){
				$userCommitionAmount=number_format($userCommitionAmount/2,2,'.','');
			}
			//now make the payment
			if($customer_refferalby_id>0){
				
				$customercommision=$this->refferaldistribution($userCommitionAmount,$ride_id,$custonerid,$customer_refferalby_id);
			}
			if($driver_refferalby_id>0){
				$drivercommision=$this->refferaldistribution($userCommitionAmount,$ride_id,$driverid,$driver_refferalby_id);	
			}
		}*/
		//new section
		if($userCommitionAmount>0 && $rideendclicktowise==0 && $nwpaymentmode!=2){
			//commision only distribute among the customer chain
			$customercommision=$this->refferaldistribution($userCommitionAmount,$ride_id,$custonerid,$customer_refferalby_id,$customerreferralcommitionper);
		}
		//driver section commitions
		if($admincommitionearn>0 && $rideendclicktowise==0 && $nwpaymentmode!=2){
			if($driver_refferalby_id>0){
				$drivercommision=$this->refferaldistributionamongdriver($admincommitionearn,$ride_id,$driverid,$driver_refferalby_id);	
			}
		}
		//driver position update section
		$driver_id = $rDetails['Driver']['id'];
		$devicetype = $rDetails['User']['CustomerCustom']['device_type'];
		$pushid = $rDetails['User']['CustomerCustom']['device_unique_id'];
		if($pushid!=''){
			$this->siteconfiguration($company_id);
		}
		//variables
		$adjusted_cost = 0.00;
		$custom = array();
		if(isset($rDetails['Ride']['cupon_code']) && $rDetails['Ride']['cupon_code']!=''){
			$adjusted_cost = number_format(($rDetails['Ride']['distance_cost'] - $rDetails['Ride']['discount']),2,'.','');
			$custom = array( 
				'text'=> $text,
				'dlat'=> $rDetails['Driver']['DriverCustom']['lat'],
				'dlon'=> $rDetails['Driver']['DriverCustom']['long'],
				'cost'=> $currency.' '.$rDetails['Ride']['distance_cost'],
				'cupon_code'=>$rDetails['Ride']['cupon_code'],
				'discount'=>$rDetails['Ride']['discount'],
				'adjusted_cost'=>$adjusted_cost,
				'referral_allowed'=>$referral_allowed,
				'status'=> 4
			);
		}else{
			$custom = array( 
				'text'=> $text,
				'dlat'=> $rDetails['Driver']['DriverCustom']['lat'],
				'dlon'=> $rDetails['Driver']['DriverCustom']['long'],
				'cost'=> $currency.' '.$rDetails['Ride']['distance_cost'],
				'cupon_code'=>'',
				'discount'=>'',
				'adjusted_cost'=>number_format($rDetails['Ride']['distance_cost'],2,'.',''),
				'status'=> 4,
				'referral_allowed'=>$referral_allowed
			);
		}
		//add refferal commition
		$custom['ref_commision'] = $customercommision;
		$custom['ride_id'] = $ride_id;
		//pr($custom);
		
		if($devicetype=='1'){
			
			if($pushid!=''){
				$registration_ids = array($pushid);
				$this->appandroidpushnotify($registration_ids,$this->CustomerAppkey,$text,$custom);
			}
			
		}
		elseif($devicetype=='2'){
			//ios section
			if($pushid!=''){
				$this->iospushnotification($pushid, $text, $custom, 1, 2,$company_id);
			}
		}
		else{
			//die(json_encode(array('status'=>'0','msg'=>'Please provide .pem file for push notification.')));
		}
		
		$adjusted_cost = 0.00;
		if(isset($rDetails['Ride']['cupon_code']) && $rDetails['Ride']['cupon_code']!=''){
			$adjusted_cost = number_format(($rDetails['Ride']['distance_cost'] - $rDetails['Ride']['discount']),2);
			$returnArray = array(
				'total_cost'=>number_format($rDetails['Ride']['distance_cost'],2),
				'cupon_code'=>$rDetails['Ride']['cupon_code'],
				'discount'=>$rDetails['Ride']['discount'],
				'adjusted_cost'=>$adjusted_cost,
				'referral_allowed'=>$referral_allowed,
				'paymentmode'=>$nwpaymentmode
			);
		}else{
			$returnArray = array(
				'total_cost'=>number_format($rDetails['Ride']['distance_cost'],2),
				'cupon_code'=>'',
				'discount'=>'',
				'adjusted_cost'=>number_format($rDetails['Ride']['distance_cost'],2),
				'referral_allowed'=>$referral_allowed,
				'paymentmode'=>$nwpaymentmode
			);
		}
		$returnArray['ride_id'] = $ride_id;
		$returnArray['ref_commision'] = $drivercommision;
		$returnArray['status'] = '4';
		//now update the ride commition from driver current earning
		$this->diductridecommitions($totalCommitionAmount,$driver_id,$company_id,$ride_id,$taxicelCommition,2);
		
		if($nwpaymentmode==2){
			$this->diductridecommitions($drivercommitions+$totalCommitionAmount,$driver_id,$company_id,$ride_id,$taxicelCommition,1);
		}
		//user current status of creadit after recharge
		$usercreditperandbuycredit = $this->getpayingpercentageandbuycredit($driver_id);
		$payingcommisionpercent = $usercreditperandbuycredit['payingcommisionpercent'];
		$buycreadit = $usercreditperandbuycredit['buycreadit'];
		$credit_warning = $usercreditperandbuycredit['credit_warning'];
		//send mail to the customer
		$this->ridestatusemailtocustomer($rDetails,$company_id);
		die(json_encode(array('status'=>'1','msg'=>'Trip Ended and notification send to the customer.','ridedata'=>$returnArray,'payingcommisionpercent'=>$payingcommisionpercent,'buycreadit'=>$buycreadit,"credit_warning"=>$credit_warning)));
	}
	//edited on 14-07-15\
	public function diductridecommitions($totalCommitionAmount=0,$user_id=0,$company_id=1,$ride_id=0,$commisionper=0,$user_type=0){
		
		$this->loadModel('CommissionPayment');
		/*$savedData = array(
			"CommissionPayment"=>array(
				'company_id'=>$company_id,
				'user_id'=>$user_id,
				'paying_cost'=>$totalCommitionAmount,
				'paying_date'=>date("Y-m-d"),
				'scheme_id'=>'0',
				'payment_type'=>'3'
			)
		);*/
		
		if($totalCommitionAmount>0 && $user_id>0){
			if($user_type==1){
				//$this->CommissionPayment->save($savedData);
			}
			//now save the amount in the user_ride_commitions
			
			//insert int0 tc_user_ride_commitions to trace from one area
			$reccomment="commission credited from Ride ".$ride_id;
			$debcred= 1;
			if($user_type==2){
				$reccomment="commission debited for Ride ".$ride_id;
				$debcred=2;
			}
			$this->CommissionPayment->query("INSERT INTO tc_user_ride_commitions(`user_id`,`ride_id`,`amount`,`is_withdrawl`,`crt_date`,`credit_debit`,`reccomment`,`commisionper`) VALUES('".$user_id."','".$ride_id."','".$totalCommitionAmount."','0','".date('Y-m-d')."','".$debcred."','".$reccomment."','".$commisionper."')");
			//now deduct the amount from the user current credit
			if($user_type==2){
				$this->CommissionPayment->query('Update `tc_users` User SET User.`currentcredit`=(User.`currentcredit`-'.$totalCommitionAmount.') WHERE User.`id`='.$user_id);
			}
			else{
				$this->CommissionPayment->query('Update `tc_users` User SET User.`currentcredit`=(User.`currentcredit`+'.$totalCommitionAmount.') WHERE User.`id`='.$user_id);
			}
		}
	}
	// end editing on 21-05-15
	
	//edit on 02-07-2015 mail system
	public function ridestatusemailtocustomer($rDetails=array(),$company_id=1){
		if(is_array($rDetails) && count($rDetails)>0){
			//get customer related data
			$customeremail='';
			$customername='';
			$pickupaddress='';
			$dropoffaddress='';
			$pickupdatetime='';
			$ridecost='';
			$drivername='';
			$driverphonno='';
			$vehicledetails='';
			$mailsubject='Your Taxicel Ride Informations';
			$ridestatus=0;
			//ride info
			if(isset($rDetails['Ride']) && count($rDetails['Ride'])>0){
				$pickupaddress = $rDetails['Ride']['pick_up'];
				$dropoffaddress = $rDetails['Ride']['drop_off'];
				$ridecost = number_format(($rDetails['Ride']['distance_cost']-$rDetails['Ride']['discount']),2);
				$vehicledetails = $rDetails['Ride']['vehicleinfo'];
				$pickupdatetime = $rDetails['Ride']['date_time'];
				if($vehicledetails!=''){
					$vehiclDtl = explode(" ",$vehicledetails);
					if(is_array($vehiclDtl) && count($vehiclDtl)>1){
						$vhcname = isset($vehiclDtl[0])?$vehiclDtl[0]:'';
						$vhcmodelname = isset($vehiclDtl[1])?$vehiclDtl[1]:'';
						$vhcmanufacdate = isset($vehiclDtl[2])?$vehiclDtl[2]:'';
						$vhcplateno = isset($vehiclDtl[3])?$vehiclDtl[3]:'';
						$vehicledetails = $vhcname." ".$vhcmodelname." ".$vhcplateno;
					}
				}
				$ridestatus = $rDetails['Ride']['status'];
			}
			//get customer info
			if(isset($rDetails['User']) && count($rDetails['User'])>0){
				$customeremail = $rDetails['User']['email'];
				$customername = ucwords($rDetails['User']['f_name'].' '.$rDetails['User']['l_name']);
			}
			//get driver info
			if(isset($rDetails['Driver']) && count($rDetails['Driver'])>0){
				$drivername=ucwords($rDetails['Driver']['f_name'].' '.$rDetails['Driver']['l_name']);
				$driverphonno = $rDetails['Driver']['mobile'];
			}
			if(filter_var($customeremail,FILTER_VALIDATE_EMAIL)){
				$values = array(
					'customername'		=> $customername,
					'pickupaddress' 	=> $pickupaddress,
					'dropoffaddress' 	=> $dropoffaddress,
					'pickupdatetime' 	=> $pickupdatetime,
					'drivername' 		=> $drivername,
					'ridecost' 			=> $ridecost,
					'driverphonno'		=> $driverphonno,
					'vehicledetails'	=> $vehicledetails
				);
				$file_name = $this->create_receipt_pdf($values);
				$pdf_path =WWW_ROOT."/receipt/".$file_name;
				
				//if valid email and not in local 
				if(!$this->serverDetect()){
					$this->siteconfiguration($company_id);
					// end email section
						$Email = new CakeEmail();
						$Email->from(array($this->adminFromEmail=>'TaxiCel Team'));// admin email
						$Email->to(array($customeremail => $customername));
						$Email->subject($mailsubject);
						$Email->template('end_trip','complaint_email');
						if($ridestatus==4){
						$Email->viewVars(array(
								'customername'		=> $customername,
								'pickupaddress' 	=> $pickupaddress,
								'dropoffaddress' 	=> $dropoffaddress,
								'pickupdatetime' 	=> $pickupdatetime,
								'drivername' 		=> $drivername,
								'ridecost' 			=> $ridecost,
								'driverphonno'		=> $driverphonno,
								'vehicledetails'	=> $vehicledetails
							));
						
						}
						elseif($ridestatus==3){
						}
						$Email->emailFormat('html');
						//$Email->addAttachment( $pdf_path );
						$Email->attachments( $pdf_path );
						$Email->send();	
						
						// end email section
					
					/* $Email = new CakeEmail();
					$Email->to(array($customeremail => $customername));
					$Email->from($this->adminFromEmail);
					$Email->subject($mailsubject);
					$body='Dear '.$customername;
					if($ridestatus==4){
						$body.="\n Your ride has ended. Details of the ride are giver bellow.
						\n Pickup From : ".$pickupaddress." \n Drop off : ".$dropoffaddress."
						\n Ride Date and Time : ".$pickupdatetime." \n Ride Cost : $".$ridecost."
						\n Driver Name : ".$drivername." \n Driver No : ".$driverphonno."
						\n Vehicle : ".$vehicledetails."
						\n
						";
					}
					elseif($ridestatus==3){
					}
						$body.='Thanks \n taxicel.com.ar';	
						$Email->send($body); */
				}
			}
		}
	}

/**
 * create_receipt_pdf method
 *
 * @return void
 */
 public function create_receipt_pdf($values=array()){
  //App::import('Vendor', 'Fpdf', array('file' => 'fpdf/fpdf.php'));
  $this->layout = 'pdf'; //this will use the pdf.ctp layout
  
  $this->set('fpdf', new FPDF('P','mm','A4'));
  $this->set('values', $values);
  $file_name = rand().time().'receipt.pdf';
  $this->set('file_name', $file_name);
  
  $this->render('receiptpdf');
  return $file_name;
  
 }	
	
	
/**
 * Fetch accepted driver details method service
 *
 * @return void
 */
	public function get_selected_driver_details(){
		$this->loadModel('Ride');
		$ride_id 	= $this->request->data['ride_id'];
		if($ride_id!=''){
			$rDetails = $this->Ride->find('first',array(
				'recursive'=>2,
				'conditions'=>array('Ride.id'=>$ride_id)
			));
			//driver rating
			$rating = $this->userrattingsection($rDetails['Driver']['id'],1);
			$driver_det = array( 
				'driver_id'=> $rDetails['Driver']['id'],
				'driver_name'=> $rDetails['Driver']['username'],//$drivername,
				'mobile'=> $rDetails['Driver']['DriverCustom']['mobile'],
				'driver_img'=> FULL_BASE_URL.$this->base."/userPic/".$rDetails['Driver']['DriverCustom']['user_pic'],
				'eta'=> $rDetails['Ride']['total_time'],
				'driver_ratting'=>$rating,
				'driver_pos'=>array(
					'lat'=>$rDetails['Driver']['DriverCustom']['lat'],
					'lon'=>$rDetails['Driver']['DriverCustom']['long']
				)
			);
			die(json_encode(array('status'=>'1','selected_driver'=>$driver_det,'msg'=>'Successfull to fetch.')));
		}else{
			die(json_encode(array('status'=>'0','msg'=>'ride_id parameter is missing.')));
		}
	}

/**
 * Fetch selected driver position to update on map method service
 *
 * @return void
 */
	public function fetch_driver_position(){
		$this->loadModel('Ride');
		$ride_id 	= $this->request->data['ride_id'];
		if($ride_id!=''){
			$rDetails = $this->Ride->find('first',array(
				'recursive'=>2,
				'conditions'=>array('Ride.id'=>$ride_id)
			));
			$driver_pos=array(
				'lat'=>$rDetails['Driver']['DriverCustom']['lat'],
				'lon'=>$rDetails['Driver']['DriverCustom']['long']
			);
			die(json_encode(array('status'=>'1','driver_pos'=>$driver_pos,'msg'=>'Successfull to fetch.')));
		}else{
			die(json_encode(array('status'=>'0','msg'=>'ride_id parameter is missing.')));
		}
	}
/**
 * Rate driver method service
 *
 * @return void
 */
	public function rate_driver(){
		header('Content-Type:application/json');
		$this->loadModel('UserRideRating');
		$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
		$this->UserRideRating->create();
		$saveData['UserRideRating']['customer_id'] 		= $this->request->data['customer_id'];
		$saveData['UserRideRating']['ride_id']			= $this->request->data['ride_id'];
		$saveData['UserRideRating']['driver_rating'] 	= $this->request->data['rating'];
		$saveData['UserRideRating']['driver_comment'] = $this->request->data['comment'];
		$saveData['UserRideRating']['company_id'] = $company_id;
		// FINDING IF CUSTOMER OR DRIVER HAS ATTEPT THE RATING FIRST
		$rating = $this->UserRideRating->find('first',array(
			'conditions'=>array('UserRideRating.ride_id'=>$this->request->data['ride_id'])
		));
		
		if($rating){
			//unbind models 
			$this->UserRideRating->unbindModel(array(
				'belongsTo'=>array('Ride','Customer','Driver')
			));
			$this->UserRideRating->updateAll(array('UserRideRating.customer_id'=>$this->request->data['customer_id'], 'UserRideRating.driver_rating'=>$this->request->data['rating'], 'UserRideRating.driver_comment'=>'"'.$this->request->data['comment'].'"'),array('UserRideRating.ride_id'=>$this->request->data['ride_id']));
			die(json_encode(array('status'=>'1','msg'=>'Rating saved successfully.')));
		}else{
			$this->UserRideRating->save($saveData);
			die(json_encode(array('status'=>'1','msg'=>'Rating saved successfully.')));
		}
	}
	
/**
 * Rate customer method service
 *
 * @return void
 */
	public function rate_customer(){
		header('Content-Type:application/json');
		$this->loadModel('UserRideRating');
		$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
		$this->UserRideRating->create();
		$saveData['UserRideRating']['driver_id'] 		= $this->request->data['driver_id'];
		$saveData['UserRideRating']['ride_id']			= $this->request->data['ride_id'];
		$saveData['UserRideRating']['customer_rating'] 	= $this->request->data['rating'];
		$saveData['UserRideRating']['customer_comment'] = $this->request->data['comment'];
		$saveData['UserRideRating']['company_id'] = $company_id;
		// FINDING IF CUSTOMER OR DRIVER HAS ATTEPT THE RATING FIRST
		$rating = $this->UserRideRating->find('first',array(
			'conditions'=>array('UserRideRating.ride_id'=>$this->request->data['ride_id'])
		));
		
		if($rating){
		
		$this->UserRideRating->unbindModel(array(
				'belongsTo'=>array('Ride','Customer','Driver')
			));
			$this->UserRideRating->updateAll(array('UserRideRating.driver_id'=>$this->request->data['driver_id'], 'UserRideRating.customer_rating'=>$this->request->data['rating'], 'UserRideRating.customer_comment'=>'"'.$this->request->data['comment'].'"'),array('UserRideRating.ride_id'=>$this->request->data['ride_id']));
			die(json_encode(array('status'=>'1','msg'=>'Rating saved successfully.')));
		}else{
			$this->UserRideRating->save($saveData);
			die(json_encode(array('status'=>'1','msg'=>'Rating saved successfully.')));
		}
	}
	
/**
 * Trace Active Ride method service for customer
 *
 * @return void
 */
	public function traceactiveride(){
		$this->loadModel('Ride');
		$ride_id 	= $this->request->data['ride_id'];
		if($ride_id!=''){
			$rDetails = $this->Ride->find('first',array(
				'recursive'=>2,
				'conditions'=>array('Ride.id'=>$ride_id)
			));
			//get driver rating
			$rating = $this->userrattingsection($rDetails['Driver']['id'],'1');
			$selectedDriver=array(
				'driver_img'=> FULL_BASE_URL.$this->base."/userPic/".$rDetails['Driver']['DriverCustom']['user_pic'],
				'driver_name'=> $rDetails['Driver']['username'],
				'driver_id'=>$rDetails['Driver']['id'],
				'totaldoneride'=>'1',
				'driver_ratting'=>$rating,
				'eta'=>$rDetails['Ride']['total_time'],
				'mobile'=>$rDetails['Driver']['mobile'],
				'driver_pos'=>array(
					'lat'=>$rDetails['Driver']['DriverCustom']['lat'],
					'lon'=>$rDetails['Driver']['DriverCustom']['long']
				)
			);
			die(json_encode(array('status'=>'1','ride_status'=>$rDetails['Ride']['status'],'ride_amount'=>$rDetails['Ride']['distance_cost'],'selected_driver'=>$selectedDriver,'msg'=>'Successfull to fetch.')));
		}else{
			die(json_encode(array('status'=>'0','msg'=>'ride_id parameter is missing.')));
		}
	}
	
/**
 * Get customer rides history method service
 *
 * @return void
 */
	public function approved_rides(){
		header('Content-Type:application/json');
		$this->loadModel('Ride');
		$user_id 	= $this->request->data['user_id'];
		//add pagination
		$page_no = (isset($this->request->data['page_no']) && $this->request->data['page_no']>0)?$this->request->data['page_no']:'0';
		$offset=0;
		$limit=50;
		if($page_no>0){
			$page_no = $page_no-1;
			$offset = $page_no*$limit;
		}
		else{
			$limit=100;
		}
		
		if($user_id!=''){
			//bind ride and user model
			$this->Ride->unbindModel(array(
				'belongsTo'=>array('User')
			));
			$this->Ride->Driver->unbindModel(array(
				'hasOne'=>array('CustomerCustom'),
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
			));
			//unbind city model
			$this->Ride->City->unbindModel(array(
				'belongsTo'=>array('Country'),
				'hasOne'=>array('CityConfiguration','PriceSetting')
			));
			
			$rDetails = $this->Ride->find('all',array(
				'recursive'=>2,
				'conditions'=>array('Ride.user_id'=>$user_id,'Ride.status <'=>'4'),
				'order'=>array('Ride.id'=>'DESC'),
				'offset'=>$offset,
				'limit'=>$limit
			));
			
			if($rDetails){
				$toData = array();
				//pr($rDetails);
				//die();
				foreach( $rDetails as $val){
					//drier rating
					$rating = $this->userrattingsection($val['Driver']['id'],1);
					//driver is not mendatory section
					$driver = array();
					if(isset($val['Driver']['DriverCustom']) && count($val['Driver']['DriverCustom'])>0){
						$driver =array(
							'driver_img'=> FULL_BASE_URL.$this->base."/userPic/".$val['Driver']['DriverCustom']['user_pic'],
							'driver_name'=> $val['Driver']['username'],
							'driver_id'=>$val['Driver']['id'],
							'totaldoneride'=>'1',
							'driver_ratting'=>$rating,
							'eta'=>$val['Ride']['total_time'],
							'mobile'=>$val['Driver']['mobile'],
							'driver_pos'=>array(
								'lat'=>$val['Driver']['DriverCustom']['lat'],
								'lon'=>$val['Driver']['DriverCustom']['long']
							)
						);
					}
					else{
						$driver =array(
							'driver_img'=> '',
							'driver_name'=> '',
							'driver_id'=>'',
							'totaldoneride'=>'0',
							'driver_ratting'=>'0',
							'eta'=>'0',
							'mobile'=>'',
							'driver_pos'=>array(
								'lat'=>'',
								'lon'=>''
							)
						);
					}
					//get city name
					$cityname='';
					if(isset($val['City']['name'])){
						$cityname = $val['City']['name'];
					}
					
					$data = array(
						
						'ride'=>array(
							'ride_id'=>$val['Ride']['id'],
							'pickup'=>$val['Ride']['pick_up'],
							'pick_lat'=>$val['Ride']['pick_lat'],
							'pick_lon'=>$val['Ride']['pick_long'],
							'drop'=>$val['Ride']['drop_off'],
							'drop_lat'=>$val['Ride']['drop_lat'],
							'drop_lon'=>$val['Ride']['drop_long'],
							'date'=>$val['Ride']['date_time'],
							'instruction'=>$val['Ride']['instruction'],
							'ride_cost'=>$val['Ride']['distance_cost'],
							'is_faviorate'=>$val['Ride']['is_faviorate'],
							'cityname'=>$cityname,
							'street_address'=>$val['Ride']['street_address'],
							'nearby_address'=>$val['Ride']['nearby_address'],
							'status'=>$val['Ride']['status'],
							'ride_type'=>$val['Ride']['ride_type'],
							'payment_option'=>$val['Ride']['payment_option'],
							'vehicle'=>$val['Ride']['vehicleinfo']
							
						),
						'driver'=>$driver
					);
					array_push($toData,$data);
				}
				die(json_encode(array('status'=>'1','ride_list'=>$toData,'msg'=>'Rides found.')));
			}else{
				die(json_encode(array('status'=>'0','msg'=>'No rides found.')));
			}
		}else{
			die(json_encode(array('status'=>'0','msg'=>'user_id parameter is missing.')));
		}
	}
	
/**
 * Get customer completed rides ride details
 *
 * @return void
 */	
	public function completed_rides(){
		header('Content-Type:application/json');
		$this->loadModel('Ride');
		$user_id 	= $this->request->data['user_id'];
		//add pagination
		$page_no = (isset($this->request->data['page_no']) && $this->request->data['page_no']>0)?$this->request->data['page_no']:'0';
		$offset=0;
		$limit=50;
		if($page_no>0){
			$page_no = $page_no-1;
			$offset = $page_no*$limit;
		}
		else{
			$limit=100;
		}
		if($user_id!=''){
			//bind ride and user model
			$this->Ride->unbindModel(array(
				'belongsTo'=>array('User')
			));
			$this->Ride->Driver->unbindModel(array(
				'hasOne'=>array('CustomerCustom'),
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
			));
			
			//unbind city model
			$this->Ride->City->unbindModel(array(
				'belongsTo'=>array('Country'),
				'hasOne'=>array('CityConfiguration','PriceSetting')
			));
			
			$rDetails = $this->Ride->find('all',array(
				'recursive'=>2,
				'conditions'=>array('Ride.user_id'=>$user_id,'Ride.status'=>'4','Ride.driver_id >'=>'0'),
				'order'=>array('Ride.id'=>'DESC'),
				'offset'=>$offset,
				'limit'=>$limit
			));
			//pr($rDetails);
			//die();
			if($rDetails){
				$toData = array();
				
				foreach( $rDetails as $val){
					//get driver total rating
					$rating = $this->userrattingsection($val['Driver']['id'],1);
					//get city name
					$cityname='';
					if(isset($val['City']['name'])){
						$cityname = $val['City']['name'];
					}
					$data = array(
						'ride'=>array(
							'ride_id'=>$val['Ride']['id'],
							'pickup'=>$val['Ride']['pick_up'],
							'pick_lat'=>$val['Ride']['pick_lat'],
							'pick_lon'=>$val['Ride']['pick_long'],
							'drop'=>$val['Ride']['drop_off'],
							'drop_lat'=>$val['Ride']['drop_lat'],
							'drop_lon'=>$val['Ride']['drop_long'],
							'date'=>$val['Ride']['date_time'],
							'instruction'=>$val['Ride']['instruction'],
							'ride_cost'=>$val['Ride']['distance_cost'],
							'is_faviorate'=>$val['Ride']['is_faviorate'],
							'cityname'=>$cityname,
							'street_address'=>$val['Ride']['street_address'],
							'nearby_address'=>$val['Ride']['nearby_address'],
							'status'=>$val['Ride']['status'],
							'ride_type'=>$val['Ride']['ride_type'],
							'payment_option'=>$val['Ride']['payment_option'],
							'vehicle'=>$val['Ride']['vehicleinfo']
						),
						'driver'=>array(
							'driver_img'=> FULL_BASE_URL.$this->base."/userPic/".$val['Driver']['DriverCustom']['user_pic'],
							'driver_name'=> $val['Driver']['username'],
							'driver_id'=>$val['Driver']['id'],
							'totaldoneride'=>'1',
							'driver_ratting'=>$rating,
							'eta'=>$val['Ride']['total_time'],
							'mobile'=>$val['Driver']['mobile'],
							'driver_pos'=>array(
								'lat'=>$val['Driver']['DriverCustom']['lat'],
								'lon'=>$val['Driver']['DriverCustom']['long']
							)
						)
					);
					array_push($toData,$data);
				}
				die(json_encode(array('status'=>'1','ride_list'=>$toData,'msg'=>'Rides found.')));
			}else{
				die(json_encode(array('status'=>'0','msg'=>'No rides found.')));
			}
		}else{
			die(json_encode(array('status'=>'0','msg'=>'user_id parameter is missing.')));
		}
	}
/**
 * Get customer favorite rides rides ride details
 *
 * @return void
 */	
	public function favorite_rides(){
		header('Content-Type:application/json');
		$this->loadModel('Ride');
		$user_id 	= $this->request->data['user_id'];
		//add pagination
		$page_no = (isset($this->request->data['page_no']) && $this->request->data['page_no']>0)?$this->request->data['page_no']:'0';
		$offset=0;
		$limit=50;
		if($page_no>0){
			$page_no = $page_no-1;
			$offset = $page_no*$limit;
		}
		else{
			$limit=100;
		}
		if($user_id!=''){
			//bind ride and user model
			$this->Ride->unbindModel(array(
				'belongsTo'=>array('User')
			));
			$this->Ride->Driver->unbindModel(array(
				'hasOne'=>array('CustomerCustom'),
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
			));
			
			//unbind city model
			$this->Ride->City->unbindModel(array(
				'belongsTo'=>array('Country'),
				'hasOne'=>array('CityConfiguration','PriceSetting')
			));
			
			$rDetails = $this->Ride->find('all',array(
				'recursive'=>2,
				'conditions'=>array('Ride.user_id'=>$user_id,'Ride.is_faviorate'=>'1'),
				'order'=>array('Ride.id'=>'DESC'),
				'offset'=>$offset,
				'limit'=>$limit
			));
			
			if($rDetails){
				$toData = array();
				//pr($rDetails);
				//die();
				foreach( $rDetails as $val){
					//get driver rating
					$rating = $this->userrattingsection($val['Driver']['id'],1);
					$driver = array();
					if(isset($val['Driver']['DriverCustom']) && count($val['Driver']['DriverCustom'])>0){
						$driver =array(
							'driver_img'=> FULL_BASE_URL.$this->base."/userPic/".$val['Driver']['DriverCustom']['user_pic'],
							'driver_name'=> $val['Driver']['username'],
							'driver_id'=>$val['Driver']['id'],
							'totaldoneride'=>'1',
							'driver_ratting'=>$rating,
							'eta'=>$val['Ride']['total_time'],
							'mobile'=>$val['Driver']['mobile'],
							'driver_pos'=>array(
								'lat'=>$val['Driver']['DriverCustom']['lat'],
								'lon'=>$val['Driver']['DriverCustom']['long']
							)
						);
					}
					else{
						$driver =array(
							'driver_img'=> '',
							'driver_name'=> '',
							'driver_id'=>'',
							'totaldoneride'=>'0',
							'driver_ratting'=>'0',
							'eta'=>'0',
							'mobile'=>'',
							'driver_pos'=>array(
								'lat'=>'',
								'lon'=>''
							)
						);
					}
					//get city name
					$cityname='';
					if(isset($val['City']['name'])){
						$cityname = $val['City']['name'];
					}
					
					$data = array(
						'ride'=>array(
							'ride_id'=>$val['Ride']['id'],
							'pickup'=>$val['Ride']['pick_up'],
							'pick_lat'=>$val['Ride']['pick_lat'],
							'pick_lon'=>$val['Ride']['pick_long'],
							'drop'=>$val['Ride']['drop_off'],
							'drop_lat'=>$val['Ride']['drop_lat'],
							'drop_lon'=>$val['Ride']['drop_long'],
							'date'=>$val['Ride']['date_time'],
							'instruction'=>$val['Ride']['instruction'],
							'ride_cost'=>$val['Ride']['distance_cost'],
							'is_faviorate'=>$val['Ride']['is_faviorate'],
							'cityname'=>$cityname,
							'street_address'=>$val['Ride']['street_address'],
							'nearby_address'=>$val['Ride']['nearby_address'],
							'status'=>$val['Ride']['status'],
							'ride_type'=>$val['Ride']['ride_type'],
							'payment_option'=>$val['Ride']['payment_option'],
							'vehicle'=>$val['Ride']['vehicleinfo']
						),
						'driver'=>$driver
					);
					array_push($toData,$data);
				}
				die(json_encode(array('status'=>'1','ride_list'=>$toData,'msg'=>'Rides found.')));
			}else{
				die(json_encode(array('status'=>'0','msg'=>'No rides found.')));
			}
		}else{
			die(json_encode(array('status'=>'0','msg'=>'user_id parameter is missing.')));
		}
	}
	
/**
 * Forgot password methos  service
 *
 * @return void
 * forgot password service call for customer/driver
 */	
	public function retrieve_password(){
		header('Content-Type: application/json');
		$this->loadModel('User');
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
			$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
			$this->siteconfiguration($company_id);
				
			$useremail 	= $this->request->data['email'];
			//$devicetype	= $this->request->data['device_type'];
			//unbind the user model
			$this->User->unbindModel(array(
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
				'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail')
			));
			$findEmail = $this->User->find('first',array(
				'conditions'=> array('User.email'=>$useremail)
			));
			if ( $findEmail ){
				$id=$findEmail['User']['id']; 
				$email = $findEmail['User']['email'];
				$name = ucwords($findEmail['User']['f_name']." ".$findEmail['User']['l_name']);
				
				$encriptbase= md5("Txc-".rand(9999,99999)."-".$id);
				//unbind the user model
				$this->User->unbindModel(array(
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
					'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail')
				));
				
				$this->User->updateAll(array('User.passretrivestr'=>"'".$encriptbase."'"),array('User.id'=>$id));
				//get encripted string
				$encriptlink = $this->encriptlinkstr($email,$encriptbase);
				$resetpasslink = FULL_BASE_URL.$this->base.'/users/resetpassword/'.$encriptlink;
				//echo $resetpasslink;
				//die();
				/*
				$pass= 'Taxicel-'.rand(999,99999);
				$this->User->updateAll(array('User.pass'=>"'".md5($pass)."'"),array('User.id'=>$id));
				*/
				
				//EMAIL TO USER
				$Email = new CakeEmail();
				$Email->template('forgot_pass','complaint_email');
				$Email->viewVars(array(
						'useremail' => $email,
						'username' 	=> $name,
						'password' 	=> $resetpasslink
				));
				$Email->emailFormat('html');
				$Email->from(array($this->adminFromEmail));
				$Email->to($email);
				$Email->subject('Password Reset Link');
				
				$Email->send();
				
				//  end of user email part
				
				//$this->Session->setFlash(__('Password changed successfully. '));
				
				$data = array(
					'email'=>$findEmail['User']['email'],
					'password'=>""
				);
				//pr($data);
				//die();
				die(json_encode(array('data'=>$data,'status'=>'1','msg'=>'Password Reset Link send to your email.')));
			}else{
				//error message
				die(json_encode(array('status'=>'0','msg'=>'Email does not exist')));
			}
		}
		else{
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}
	
/**
 * Go off Duty method service
 *
 * @return void
 */
	public function go_off_duty(){
		header('Content-Type: application/json');
		$this->loadModel('DriverCustom');
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
			
			$driver_id 		= $this->request->data['user_id'];
			$status 		= '0';
			$device_type		= $this->request->data['device_type'];				
			$deviceuniqueid='';
			$this->DriverCustom->updateAll(array('DriverCustom.status'=>"'".$status."'",'DriverCustom.device_type'=>"'".$device_type."'",'DriverCustom.device_unique_id'=>"'".$deviceuniqueid."'"),array('DriverCustom.user_id'=>$driver_id));
			
			die(json_encode(array('status'=>'1','msg'=>'Status updated successfully.')));
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}
	
	/**
 * Go Driver Information  method service
 *
 * @return void
 */
	public function userinformation(){
		header('Content-Type: application/json');
		$this->loadModel('User');
		$this->loadModel('DriverCustom');
		$this->loadModel('Car');
		
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
			
			$user_id 		= $this->request->data['user_id'];
			
			$rating = $this->User->find('first',array(
				'conditions'=>array('User.id'=>$user_id)
			));
			//pr($rating);
			//die();
			$carObj = $this->Car->find('first',array(
				'conditions'=>array('Car.id'=>$rating['VehicleDetail']['car_id'])
			));
			/* pr($carObj);
			die() */;
			$data = array(
				'user_id'=>$user_id,
				'f_name'=>$rating['User']['f_name'],
				'l_name'=>$rating['User']['l_name'],
				'email'=>$rating['User']['email'],
				'mobile'=>$rating['User']['mobile'],
				'profile_img'=>FULL_BASE_URL.$this->base.'/userPic/'.$rating['DriverCustom']['user_pic'],
				'vehicle_name'=>(isset($carObj['Car']['name']))?$carObj['Car']['name']:'',
				'manufacturing_date'=>$rating['VehicleDetail']['manufactureing_date'],
				'vehicle_no'=>$rating['VehicleDetail']['vehicle_no']
			);
			//pr($data);
			//die();
			die(json_encode(array('data'=>$data,'status'=>'1','msg'=>'You have viewed all the result successfully.')));		
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}
	/**
	 * Go user information service method service
	 *
	 * @return void
	 */	
	public function customerinfoservice(){
		header('Content-Type: application/json');
		$this->loadModel('User');
		//$this->loadModel('UserCreditDetail');
		//$this->loadModel('CustomerCustom');
		
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
			$user_id 		= $this->request->data['user_id'];
			//unbind other model which are not requiered 
			$this->User->unbindModel(array(
				'hasOne'=>array('DriverCustom','VehicleDetail'),
				'hasMany'=>array('CustomerRide','DriverRide')
			));
			$userinfo = $this->User->find('first',array(
				'conditions'=>array('User.id'=>$user_id)
			));
			//pr($userinfo);
			$cards = array();
			//creadit cards of the user
			if(count($userinfo['UserCreditDetail'])>0){
				foreach($userinfo['UserCreditDetail'] as $usercardinfo){
					$data = array(
						'id'=>$usercardinfo['id'],
						'cardno'=>$usercardinfo['credit_card_no']
					);
					array_push($cards,$data);
				}
			}
			//foreach($userinfo as $key=>$val){
			$imagepath='';
			if(isset($userinfo['CustomerCustom']['user_image']) && $userinfo['CustomerCustom']['user_image']!=''){
				$imagepath=FULL_BASE_URL.$this->base.'/customerImage/'.$userinfo['CustomerCustom']['user_image'];
			}
			$data = array(
			'user_id'	=>$user_id,
			'f_name'	=>$userinfo['User']['username'],
			'email'		=>$userinfo['User']['email'],
			'mobile'	=>$userinfo['User']['mobile'],
			'user_image'=>$imagepath,
			'cards'=>$cards
			);
			//pr($data);
			die(json_encode(array('data'=>$data,'status'=>'1','msg'=>'You have viewed all the result successfully.')));
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}	
	
	
	// ride processing service
	public function rideTraceService() {
		header('Content-Type: application/json');
		$this->loadModel('RideTrace');
		$this->loadModel('DriverCustom');
		// unbind ride model
		$this->RideTrace->unbindModel(array(
			'belongsTo'=>array('Ride')
		));
		//unbind custome
		$this->DriverCustom->unbindModel(array(
			'belongsTo'=>array('User','City')
		));
		//write log for test
		$this->write_log($this->request->data);
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
			$driver_id = (isset($this->request->data['driver_id']) && $this->request->data['driver_id']>0)?$this->request->data['driver_id']:0;
			$ride_id  = (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0)?$this->request->data['ride_id']:0;	
			$long_lat = (isset($this->request->data['long_lat']) && $this->request->data['long_lat']!='')?$this->request->data['long_lat']:'';
			$ridestatus = (isset($this->request->data['ridestatus']) && $this->request->data['ridestatus']!='')?$this->request->data['ridestatus']:0;
			
			$lat_long = explode('*',$long_lat);
			for($i=0; $i<count($lat_long); $i++){
				$resultLatLong = $lat_long[$i];
				$latLong = explode(',', $resultLatLong);
				if(count($latLong)==2){
					$lat 	= $latLong[0];
					$long 	= $latLong[1];
					//
					if($ride_id>0){
						$this->RideTrace->create();
						$data['RideTrace']['ride_id'] = $ride_id;
						$data['RideTrace']['lat'] = $lat;
						$data['RideTrace']['long'] = $long;
						$data['RideTrace']['ride_status']=$ridestatus;
						$this->RideTrace->save($data);
					}
					else{
						//update driver position only
						if($driver_id>0){
							$updatearra= array('DriverCustom.lat'=>$lat,'DriverCustom.long'=>$long);
							$wharray = array('DriverCustom.user_id'=>$driver_id);
							$this->DriverCustom->updateAll($updatearra,$wharray);
							break;
						}
					}
				}
				
			}
			die(json_encode(array('status'=>'1','msg'=>'You have saved all the lat long successfully.')));
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}

  // Customer Start Trip Details Service
	public function customerTripDetails(){
		$this->loadModel('Ride');
		$this->loadModel('City');
		$this->loadModel('CityConfiguration');
		
		$user_id   = $this->request->data['user_id'];
		$ride_id   = $this->request->data['ride_id'];
		$text = "Customer Trip Started";
		
		$city_id 	= 0;
		
		$this->Ride->User->unBindModel(array(
			'hasOne'=>array('DriverCustom','CustomerCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		
		//user model unbind
		$ride_details = $this->Ride->find('first',array(
			'recursive'=>2,
		   'conditions'=>array('Ride.id'=>$ride_id)
		));
		
		//pr($ride_details);
		//die();
		
		if(isset($ride_details['City']['CityConfiguration']) && count($ride_details['City']['CityConfiguration'])>0){
			if(is_array($ride_details) && count($ride_details)>0){
				$farepermeter = $ride_details['City']['CityConfiguration']['fare_per_kilometer'];
				$distance     = $ride_details['City']['CityConfiguration']['inter_fare_distance'];
				$resultperkm  = ($farepermeter/1000) * $distance;
			
				$custom = array( 
					'text'=> $text,
					'cityname'=> $ride_details['City']['name'],
					'basefare'=> (isset($ride_details['City']['CityConfiguration']['base_fare'])) ? $ride_details['City']['CityConfiguration']['base_fare']:null ,
					'basedistance'=> (isset($ride_details['City']['CityConfiguration']['base_distance']))? $ride_details['City']['CityConfiguration']['base_distance']:null,
					'farepermeter'=> $resultperkm,
					'fareperminute'=> (isset($ride_details['City']['CityConfiguration']['fare_per_minute'])) ?  $ride_details['City']['CityConfiguration']['fare_per_minute']:null,
					'interfaredistance'=> (isset($ride_details['City']['CityConfiguration']['inter_fare_distance'])) ? $ride_details['City']['CityConfiguration']['inter_fare_distance']:null,
					'interfaretime'=> (isset($ride_details['City']['CityConfiguration']['inter_fare_time'])) ? $ride_details['City']['CityConfiguration']['inter_fare_time']:null
					
				);
				//pr($custom);
				//die();
				die(json_encode(array('custom'=>$custom,'status'=>'1','msg'=>'You have viewed all the result successfully.')));	
			}else{
				die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Information')));
			}
		}else{
			die(json_encode(array('status'=>'0','msg'=>'Invalid Service !.Please try again. ')));
		}	
		
	}
	
	/*public function recent_trip(){
		header('Content-Type: application/json');
		$this->loadModel('Ride');
		
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']> 0 ){
			
			$ride_id 		= $this->request->data['ride_id'];
			
			//unbind ride model 
			
			$ride_details = $this->Ride->find('first',array(
			'recursive'=>2,
			'conditions'=>array('Ride.id'=>$ride_id)
			));
			
			//pr($ride_details);
			//die();
			
			
			$data = array(
				'pick_up'        =>$ride_details['Ride']['pick_up'],
				'drop_off'	     =>$ride_details['Ride']['drop_off'],
				'cost'	         =>$ride_details['Ride']['distance_cost'],
				'total_distance' =>$ride_details['Ride']['total_distance'],
				'date_time'	     =>$ride_details['Ride']['date_time'],
				'status'	     =>$ride_details['Ride']['status'],
				'driver_name'	 =>$ride_details['Driver']['username'],
				'driver_email'	 =>$ride_details['Driver']['email'],
				'driver_mobile'	 =>$ride_details['Driver']['mobile'],
				'driver_pic'	 =>$ride_details['User']['DriverCustom']['user_pic']
			);
			//pr($data);
		 //	die();
			die(json_encode(array('data'=>$data,'status'=>'1','msg'=>'Driver recent trips details.')));
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}*/
	
	//new code for recent trip
	public function recent_trip(){
		header('Content-Type: application/json');
		$this->loadModel('Ride');
		if( isset($this->request->data['device_type']) && $this->request->data['device_type']> 0 ){
			$driver_id 		= $this->request->data['driver_id'];
			$page_no = (isset($this->request->data['page_no']) && $this->request->data['page_no']>1)?$this->request->data['page_no']:1;
			$limit = $this->sitelimit;
			$offset = $limit*($page_no-1);
			if($driver_id>0){
				//get driver recent trip
				//unbind ride model
				$this->Ride->unbindModel(array(
					'hasMany'=>array(),
					'hasOne'=>array(),
					'belongsTo'=>array('City','Driver')
				));
				//unbind User Model
				$this->Ride->User->unbindModel(array(
					'hasMany'=>array('CustomerRide','UserCreditDetail','DriverRide'),
					'hasOne'=>array('DriverCustom','VehicleDetail')
				));
			}
			//unbind ride model 
			
			$ride_details = $this->Ride->find('all',array(
				'recursive'=>2,
				'conditions'=>array('Ride.driver_id'=>$driver_id,'Ride.status >'=>'3'),
				'order'=>array('Ride.id'=>'DESC'),
				'offset'=>$offset,
				'limit'=>$limit
			));
			$totaltrips = $this->Ride->find('count',array('conditions'=>array('Ride.driver_id'=>$driver_id,'Ride.status >'=>'3')));
			//pr($ride_details);
			//die();
			//validate ride is present or not
			$recentrides = array();
			if(is_array($ride_details) && count($ride_details)>0){
				foreach($ride_details as $ride_detail){
					$status = "Completed";
					if($ride_detail['Ride']['status']==5){
						$status = "Cancelled";
					}
					$data = array(
						'ride_id'		=>$ride_detail['Ride']['id'],
						'pick_up'        =>$ride_detail['Ride']['pick_up'],
						'drop_off'	     =>$ride_detail['Ride']['drop_off'],
						'cost'	         =>'$'.number_format($ride_detail['Ride']['distance_cost'],2),
						'total_distance' =>$ride_detail['Ride']['total_distance'],
						'date_time'	     =>date("m/d/Y",strtotime($ride_detail['Ride']['date_time'])),
						'status'	     =>$status,
						'invoice_id'	=>$ride_detail['Ride']['id']
					);
					array_push($recentrides,$data);
				}
				die(json_encode(array('data'=>$recentrides,'status'=>'1','msg'=>'Driver recent trips details.','totaltrips'=>$totaltrips)));
			}
			else{
				die(json_encode(array('status'=>'1','message'=>'You have not make any ride till now','data'=>$recentrides)));
			}
			
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}
	
	
	/*
	
	// Google Api Auto Complete address
		public function googleApiService(){
			header('Content-Type: application/json');
			$place = $this->request->data['location'];
			
		$url="https://maps.googleapis.com/maps/api/place/autocomplete/json?types=geocode&sensor=true&key=AIzaSyBmoRt5gXU6nGN8AbLGZe3qdDuu4z2nE3s&input=".str_replace(' ','+',$place);
		$ch = curl_init();
		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, false);
		//curl_setopt($ch, CURLOPT_HTTPHEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Execute post
		$result = curl_exec($ch);
		//pr($result);
		curl_close($ch);
		
		//$result = @file_get_content($url);
		
		pr($result);
		die();	
			$jsondata = json_decode($result,true);
			die(json_encode(array('status'=>'1','places'=>$jsondata)));
		}
	*/
	
	/**
	 * uploadpic method for driver and customer together
	 * @param \string $user_id
	 * @param \string $usertype // 1=driver 2=customer
	*/
	public function uploadpic(){
		header('Content-Type:application/json');
		//load models for both users custom table
		$this->loadModel('DriverCustom');
		$this->loadModel('CustomerCustom');
		if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
			$userid = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
			$usertype = $this->request->data['user_type'];//1=driver ; 2=Customer
			$userimagefile = isset($_FILES['user_image'])?$_FILES['user_image']:'';
			if(!is_array($userimagefile)){
				die(json_encode(array('status'=>'0','msg'=>'Please choose a image for uploading')));
			}
			$uploaddirectory = WWW_ROOT."userPic/";
			$usercustome = array();
			$filename='';
			if($usertype==1){
				$usercustome = $this->DriverCustom->find('first',array('recursive'=>'1','conditions'=>array('DriverCustom.user_id'=>$userid)));
			}
			if($usertype==2){
				$usercustome = $this->CustomerCustom->find('first',array('recursive'=>'1','conditions'=>array('CustomerCustom.user_id'=>$userid)));
			}
			//pr($usercustome);
			//image upload section 
			if(is_array($usercustome) && count($usercustome)>0){
				$filename = time().str_replace(' ','_',$userimagefile['name']);
				if(move_uploaded_file($userimagefile['tmp_name'],$uploaddirectory.$filename)){
					$source = $uploaddirectory.$filename;
					$destination = $uploaddirectory."thumb_".$filename;
					$this->Thumb->createthumbs($source,$destination,100,80);
				}
				else{
					$filename='';
				}
			}
			else{
				//invalid user information
				die(json_encode(array('status'=>'0','msg'=>'User Details Not Found')));
			}
			//now database update section
			if($filename!=''){
				$retpic = FULL_BASE_URL.$this->base."/userPic/thumb_".$filename;
				if($usertype==1){
					$this->DriverCustom->id=$usercustome['DriverCustom']['id'];
					$this->DriverCustom->saveField('user_pic',$filename);
				}
				if($usertype==2){
					$this->CustomerCustom->id=$usercustome['CustomerCustom']['id'];
					$this->CustomerCustom->saveField('user_image',$filename);
				}
				die(json_encode(array('status'=>'1','msg'=>'You Picture updated','newpicpath'=>$retpic)));
			}
			else{
				die(json_encode(array('status'=>'0','msg'=>'Please try again')));
			}
		}
		else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}
	
	/**
	 * uploadpic method for driver and customer together
	 * @param \string $user_id
	 * @param \string $usertype // 1=driver 2=customer
	*/
	public function userlogout(){
		header('Content-Type:application/json');
		//load models for both users custom table
		$this->loadModel('DriverCustom');
		$this->loadModel('CustomerCustom');
		if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
			$userid = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
			$usertype = $this->request->data['user_type'];//1=driver ; 2=Customer
			$usercustome = array();
			if($usertype==1){
				$usercustome = $this->DriverCustom->find('first',array('recursive'=>'1','conditions'=>array('DriverCustom.user_id'=>$userid)));
			}
			if($usertype==2){
				$usercustome = $this->CustomerCustom->find('first',array('recursive'=>'1','conditions'=>array('CustomerCustom.user_id'=>$userid)));
			}
			 
			if(is_array($usercustome) && count($usercustome)>0){
				if($usertype==1){
					$this->DriverCustom->id=$usercustome['DriverCustom']['id'];
					$this->DriverCustom->saveField('status','0');
				}
				if($usertype==2){
					$this->CustomerCustom->id=$usercustome['CustomerCustom']['id'];
					$this->CustomerCustom->saveField('device_unique_id','');
				}
				die(json_encode(array('status'=>'1','msg'=>'Logout Successfull')));
			}
			else{
				//invalid user information
				die(json_encode(array('status'=>'0','msg'=>'User Details Not Found')));
			}
			//now database update section
		}
		else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}
	
	/**
	* notifycustomer for communication
	*/
	public function notifycustomer(){
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$driverid = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
				$customerid = (isset($this->request->data['customer_id']) && $this->request->data['customer_id']>0)?$this->request->data['customer_id']:0;
				//this parameter is optional for future used
				$notify_type = (isset($this->request->data['notify_type']) && $this->request->data['notify_type']>0)?$this->request->data['notify_type']:0;
				if($driverid<1){
					die(json_encode(array('status'=>'0','msg'=>'Invalid user Information')));
				}
				if($customerid<1){
					die(json_encode(array('status'=>'0','msg'=>'Notify user not set')));
				}
				//load the user model
				$this->loadModel('User');
				//unbind the un-necessary model from here
				$this->User->unbindModel(array(
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
					'hasOne'=>array('DriverCustom','VehicleDetail')
				));
				//get the customer detail
				$customerUser = $this->User->find('first',array('recursive'=>'1','conditions'=>array('User.id'=>$customerid,'User.user_type'=>'2')));
				if(is_array($customerUser) && count($customerUser)>0){
					//now send the customer notification
					$text = "kkk";
					if($devicetype=='1'){
						$custom = array( 
							'text'=> $text,
						);
						$pushid = $customerUser['User']['CustomerCustom']['device_unique_id'];
						$registration_ids = array($pushid);
						$this->appandroidpushnotify($registration_ids,$this->CustomerAppkey,$text,$custom);
						die(json_encode(array('status'=>'1','msg'=>'successfully Notify.')));
					}
					else{
						die(json_encode(array('status'=>'0','msg'=>'Invalied Device type.')));
					}
				}
				die(json_encode(array('status'=>'0','msg'=>'Invalid Customer Information')));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalied call')));
	}
	
	// Get Heat Map Coordinates	
	public function heat_map_cords(){
		header('Content-Type: application/json');
		$this->loadModel('HeatZone');
		$this->loadModel('HeatZoneCordinet');
		
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$userid = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
				$lat = (isset($this->request->data['lat']) && $this->request->data['lat']>0)?$this->request->data['lat']:0;
				$lon = (isset($this->request->data['lon']) && $this->request->data['lon']>0)?$this->request->data['lon']:0;
				$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
				$heatzonecords = $this->HeatZone->find('all',array('recursive'=>'1','conditions'=>array('HeatZone.company_id'=>$company_id)));
			
				//pr($heatzonecords);
				//die();
				$cod=array();
				
				$allcords=array();
				$coordinates=array();
				$color = "CFCFCF";
				foreach($heatzonecords as $key=>$heatzonecord){
					$cords=array();
					foreach($heatzonecord['HeatZoneCordinet'] as $val){
						$cord = array(
							'lat'=>$val['lat'],
							'lon'=>$val['long']
						);
						array_push($cords,$cord);
					}
					//get center lat long and distance 
					$clat = isset($heatzonecord['City']['center_lat'])?$heatzonecord['City']['center_lat']:"0.00";
					$clon = isset($heatzonecord['City']['center_lon'])?$heatzonecord['City']['center_lon']:"0.00";
					$cdistance = isset($heatzonecord['City']['heatmap_visible_distance'])?$heatzonecord['City']['heatmap_visible_distance']:"0";
					//array_push($allcords,$coordinates);
					// $coordinates['color'] = $color;
					// $coordinates['cords'] = $cords;
					// $coordinates['density'] = '0';
					// $coordinates['zone'] = $heatzonecord['HeatZone']['name'];
					
					$coordinates = array(
						'color'=>$color,
						'cords'=>$cords,
						'density '=>'0',
						'zone'=>$heatzonecord['HeatZone']['name'],
						'clat'=>$clat,
						'clon'=>$clon,
						'cdistance'=>$cdistance
					);
					array_push($allcords,$coordinates);
				}
				//array_push($cod,$cords);
				
				//pr($allcords);
				//die();
				die(json_encode(array('cords'=>$allcords,'status'=>'1','msg'=>'Heat zone coordinates.')));
			}else{
				die(json_encode(array('status'=>'0','msg'=>'Invalid coordinates')));	
			}
		}
		else{
			die(json_encode(array('status'=>'0','msg'=>'Invalid coordinates')));	
		}
	}
	
	// Customer path location trace
	
	public function drivertraceride(){
		header('Content-Type:application/json');
		//$this->loadModel('Ride');
		$this->loadModel('RideTrace');
		$this->write_log($this->request->data);
		$ride_id 	= (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0) ? $this->request->data['ride_id']:0;
		
		$ride_traceid 	= (isset($this->request->data['ride_traceid']) && $this->request->data['ride_traceid']>0) ? $this->request->data['ride_traceid']:0;
		
		if($ride_id!=''){
			$conditions = array('RideTrace.ride_id'=>$ride_id);
			$order = 'DESC';
			$limit = 1;
			if($ride_traceid>0){
					$conditions['RideTrace.id >']=$ride_traceid;
					$order = 'ASC';
					$limit=1;
			}
			$rDetails = $this->RideTrace->find('all',array(
				'recursive'=>1,
				'conditions'=>$conditions,
				'order'=>array('RideTrace.id'=>$order),
				'limit'=>$limit
			));
			//pr($rDetails);
			//die();
			$driverlatlong=array();
			$driver=array();
			$last_traceid=$ride_traceid;
			foreach($rDetails as $key=>$val){
				$driverlon=array(
					'lat'=>$val['RideTrace']['lat'],
					'long'=>$val['RideTrace']['long']
				);
				array_push($driverlatlong,$driverlon);
				$last_traceid = $val['RideTrace']['id'];
			}
			//pr($driverlatlong);
			//die();
			if(count($driverlatlong)>0){
				die(json_encode(array('driverlatlong'=>$driverlatlong,'status'=>'1','last_traceid'=>$last_traceid,'msg'=>'Successful to fetch.')));	
			}
			else{
				die(json_encode(array('driverlatlong'=>$driverlatlong,'status'=>'2','last_traceid'=>$last_traceid,'msg'=>'Successful no fetch.')));
			}
		}else{
			die(json_encode(array('status'=>'0','msg'=>'ride_id parameter is missing.')));
		}
	}
	
	// igonore ride from driver
	public function ignoreorder(){
		$this->loadModel('Ride');
		
		$ride_id 	= (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0) ? $this->request->data['ride_id']:0;
		
		$driver_id 	= (isset($this->request->data['driver_id']) && $this->request->data['driver_id']>0) ? $this->request->data['driver_id']:0;
		$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
			
		if($ride_id>0){
			//unbind ride models
			$this->Ride->unbindModel(array(
				'belongsTo'=>array('Driver','City')
			));
			$this->Ride->User->unbindModel(array(
				'hasOne'=>array('DriverCustom','VehicleDetail'),
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
			));
			$ride_details = $this->Ride->find('first',array(
				'recursive'=>2,
				'conditions'=>array('Ride.id'=>$ride_id)
			));
			//pr($ride_details);
			if(isset($ride_details) && is_array($ride_details) && count($ride_details)>0){
				if(isset($ride_details['User']) && is_array($ride_details['User']) && count($ride_details['User'])>0){
					//validate custome array
					$customercustome = isset($ride_details['User']['CustomerCustom'])?$ride_details['User']['CustomerCustom']:'';
					if(is_array($customercustome) && count($customercustome)>0){
						$devicetype = $customercustome['device_type'];
						$deviceuniqueid = $customercustome['device_unique_id'];
						$textmsg = "Your Recent Ride can not completed. please try again.";
						$customeArray = array(
							'text'=>$textmsg
						);
						if($devicetype==1){
							// android push
							if($deviceuniqueid!=''){
								$this->siteconfiguration($company_id);
								//write push code
								$registration_ids = array($deviceuniqueid);
								$this->appandroidpushnotify($registration_ids,$this->CustomerAppkey,$textmsg,$customeArray,1);
							}
						}
						elseif($devicetype==2){
							//ios push
							if($deviceuniqueid!=''){
								//write push code
								$this->iospushnotification($deviceuniqueid,$textmsg,$customeArray,1,2,$company_id);
							}
						}
						else{
							//do nothing
						}
					}
				}
				die(json_encode(array('status'=>'1','msg'=>'Successful message.')));
			}
			else{
				die(json_encode(array('status'=>'1','msg'=>'customer not notify')));
			}
			
		}else{
			die(json_encode(array('status'=>'0','msg'=>'ride_id parameter is missing.')));
		}
	}
	
	//edited by Mrinmopy das on 29-12-2014
	/**
	 * watingstart
	 * @param  ride_id
	 * @param  driver_id
	 * @param  iswaitingstart
	 **/
	public function watingstart(){
		$this->loadModel('Ride');
		$driverid = (isset($this->request->data['driver_id']) && $this->request->data['driver_id']>0) ? $this->request->data['driver_id']:0;
		$rideid = (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0) ? $this->request->data['ride_id']:0;
		$iswaitingstart = (isset($this->request->data['iswaitingstart']) && $this->request->data['iswaitingstart']==1) ? 1:0; // waiting 1= start 0=off
		$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
		if($driverid==0){
			die(json_encode(array('status'=>'0','msg'=>'Driver Info not set')));	
		}
		if($rideid==0){
			die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Information')));	
		}
		//get customer information and send notification
		//unbind ride models
		$this->Ride->unbindModel(array(
			'belongsTo'=>array('Driver','City')
		));
		$this->Ride->User->unbindModel(array(
			'hasOne'=>array('DriverCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		$ride_details = $this->Ride->find('first',array(
			'recursive'=>2,
			'conditions'=>array('Ride.id'=>$rideid,'Ride.driver_id'=>$driverid)
		));
		if(isset($ride_details) && is_array($ride_details) && count($ride_details)>0){
			if(isset($ride_details['User']) && is_array($ride_details['User']) && count($ride_details['User'])>0){
				//validate custome array
				$customercustome = isset($ride_details['User']['CustomerCustom'])?$ride_details['User']['CustomerCustom']:'';
				if(is_array($customercustome) && count($customercustome)>0){
					$devicetype = $customercustome['device_type'];
					$deviceuniqueid = $customercustome['device_unique_id'];
					$textmsg = "Your Waiting Time End";
					$iswaitingcancel =4;//the user stop waiting
					if($iswaitingstart){
						$textmsg = "Your Waiting Time Start";
						$iswaitingcancel=3;
					}
					
					$customeArray = array(
						'text'=>$textmsg
					);
					if($devicetype==1){
						// android push
						if($deviceuniqueid!=''){
							//write push code
							$this->siteconfiguration($company_id);
							$registration_ids = array($deviceuniqueid);
							$this->appandroidpushnotify($registration_ids,$this->CustomerAppkey,$textmsg,$customeArray,$iswaitingcancel);
						}
					}
					elseif($devicetype==2){
						//ios push
						if($deviceuniqueid!=''){
							//write push code
							$this->iospushnotification($deviceuniqueid,$textmsg,$customeArray,1,2,$company_id);
						}
					}
					else{
						//do nothing
					}
				}
			}
			
		}
		die(json_encode(array('status'=>'1','msg'=>'Customer notify')));
	}
	
	/**
	 * runtimeridecostsave
	 * @param ride_id
	 * @param driver_id
	 * @param runtimecost
	 * @param runtimedistance
	 */
	public function runtimeridecostsave(){
		$this->loadModel('Ride');
		$driverid = (isset($this->request->data['driver_id']) && $this->request->data['driver_id']>0) ? $this->request->data['driver_id']:0;
		$rideid = (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0) ? $this->request->data['ride_id']:0;
		$runtimecost = (isset($this->request->data['runtimecost']) && $this->request->data['runtimecost']>0) ? $this->request->data['runtimecost']:0; 
		$runtimedistance = (isset($this->request->data['runtimedistance']) && $this->request->data['runtimedistance']>0) ? $this->request->data['runtimedistance']:0;
		
		if($driverid==0){
			die(json_encode(array('status'=>'0','msg'=>'Driver Info not set')));	
		}
		if($rideid==0){
			die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Information')));	
		}
		//get customer information and send notification
		//unbind ride models
		$this->Ride->unbindModel(array(
			'belongsTo'=>array('Driver','City','User')
		));
		$ride_details = $this->Ride->find('first',array(
			'recursive'=>0,
			'conditions'=>array('Ride.id'=>$rideid,'Ride.driver_id'=>$driverid)
		));
		if(isset($ride_details) && is_array($ride_details) && count($ride_details)>0){
			//now update the ride
			$this->Ride->unbindModel(array(
				'belongsTo'=>array('Driver','City','User')
			));
			
			/*$this->Ride->id=$rideid;
			$this->Ride->saveField('run_time_cost',$runtimecost);*/
			
			$this->Ride->updateAll(array('Ride.run_time_cost'=>$runtimecost,'Ride.run_time_distance'=>$runtimedistance),array('Ride.id'=>$rideid,'Ride.driver_id'=>$driverid));
		}
		die(json_encode(array('status'=>'1','msg'=>'Ride Run time Cost Update ')));
	}
	/**
	* runtimeridecostget
	* @param user_id
	* @param ride_id
	*/
	public function runtimeridecostget(){
		$this->loadModel('Ride');
		$customerid = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0) ? $this->request->data['user_id']:0;
		$rideid = (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0) ? $this->request->data['ride_id']:0;
		
		
		if($customerid==0){
			die(json_encode(array('status'=>'0','msg'=>'User Info not set')));	
		}
		if($rideid==0){
			die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Information')));	
		}
		//get customer information and send notification
		//unbind ride models
		$this->Ride->unbindModel(array(
			'belongsTo'=>array('Driver','City','User')
		));
		$ride_details = $this->Ride->find('first',array(
			'recursive'=>0,
			'conditions'=>array('Ride.id'=>$rideid,'Ride.user_id'=>$customerid)
		));
		$dataArray = array();
		if(isset($ride_details) && is_array($ride_details) && count($ride_details)>0){
			$dataArray['run_time_cost']=$ride_details['Ride']['run_time_cost'];
			$dataArray['run_time_distance']=$ride_details['Ride']['run_time_distance'];
		}
		die(json_encode(array('status'=>'1','msg'=>'Ride Run time Cost and distance','data'=>$dataArray)));
	}
	/***/
	
	/**
	* refferaldistribution
	* @param amount
	* @param ride_id
	* @param user_id
	* @param driverrefferbycode
	*/
	public function refferaldistribution($amount=0,$ride_id=0,$user_id=0,$userrefferby=0,$fusercomper=50){
		$this->loadModel('User'); //for access data connection
		$ref_commision=$amount;
		//echo $amount." r: ".$ride_id." U: ".$user_id." REf: ".$userrefferby;
		if($amount==0 || $user_id==0 || $ride_id==0){
			return 0;
		}
		//refferer code
		
		if($userrefferby>0){
			$usersheirchy = array(
				'fuserid'=>$user_id,
				'suserid'=>$userrefferby
			);
			//now get the reffere details
			$quey = "SELECT IFNULL(SU.id,'0') suser_id,IF(SU.reffered_by>0,(SELECT TU.id from tc_users TU WHERE TU.id=SU.reffered_by),'0') as tuser_id FROM tc_users FU
			LEFT JOIN tc_users SU ON FU.reffered_by=SU.id WHERE FU.id='".$userrefferby."'";
			$queryExe = $this->User->query($quey);
			//pr($queryExe);
			if(isset($queryExe) && is_array($queryExe) && count($queryExe)>0){
				foreach($queryExe[0] as $otherusers){
					//pr($otherusers);
					if(isset($otherusers['suser_id']) && $otherusers['suser_id']>0){
						$usersheirchy['tuserid']=$otherusers['suser_id'];
						if(isset($otherusers['tuser_id']) && $otherusers['tuser_id']>0)
							$usersheirchy['fuuserid']=$otherusers['tuser_id'];
					}
				}
			}
			//pr($usersheirchy);
			//percentage distributions
			$fuser = $fusercomper;
			$suser = $tuser = $fuuser =0;
			$remainper = (100-$fusercomper);
			if(count($usersheirchy)==4){
				//$fuser = $suser = $tuser = $fuuser=25;
				//$fuser = 50;
				//$suser = 25;
				//$tuser = $fuuser=12.5;
				
				$suser = ($remainper/2);
				$tuser = $fuuser = ($suser/2);
			}
			elseif(count($usersheirchy)==3){
				//$fuser = 50;
				//$suser = $tuser = 25;
				//$fuser = $suser = $tuser =33.3;
				
				$suser = $tuser = ($remainper/2);
			}
			else{
				//$fuser = 50;
				$suser = $remainper;
			}
			
			//now distribution of refferal amount
			foreach($usersheirchy as $key=>$val){
				$refamount = 0;
				$userid = $val;
				$commisionper = 0;
				if($key=='fuserid'){
					//echo $fuser;
					$refamount = number_format((($amount*$fuser)/100),2);
					$ref_commision = $refamount;
					$commisionper = $fuser;
				}
				elseif($key=='suserid'){
					//echo $suser;
					$refamount = number_format((($amount*$suser)/100),2);
					$commisionper = $suser;
				}
				elseif($key=='tuserid'){
					//echo $tuser;
					$refamount = number_format((($amount*$tuser)/100),2);
					$commisionper = $tuser;
				}
				elseif($key=='fuuserid'){
					//echo $fuuser;
					$refamount = number_format((($amount*$fuuser)/100),2);
					$commisionper = $fuuser;
				}
				else{
					$commisionper = 0;
				}
				if($refamount>0){
					//validate if user get commition befor i that ride
					$selquery = "SELECT UserRideCommitions.`id`,UserRideCommitions.`amount`,UserRideCommitions.`commisionper` FROM `tc_user_ride_commitions` UserRideCommitions WHERE UserRideCommitions.`ride_id`='".$ride_id."' AND UserRideCommitions.`user_id`='".$userid."'";
					//$res = $this->User->query($selquery);
					$res=array();
					if(isset($res) && is_array($res) && count($res)>0){
						//pr($res);
						$amountp = "0";
						$recid = 0;
						foreach($res as $result){
							$recid = $result['UserRideCommitions']['id'];
							$amountp=(isset($result['UserRideCommitions']['amount']) && $result['UserRideCommitions']['amount']>0)?$result['UserRideCommitions']['amount']:0;
							$amountp=$amountp+$refamount;
							$commisionper = $commisionper+$result['UserRideCommitions']['commisionper'];
							//now update the table
							$upquery = "UPDATE `tc_user_ride_commitions` SET `amount`='".$amountp."',`commisionper`='".$commisionper."' WHERE `ride_id`='".$ride_id."' AND `user_id`='".$userid."' AND `id`='".$recid."'";
							$this->User->query($upquery);
						}
					}
					else{
						//insert into data base section is pendding
						$reccomment = "Earn Commition from this Ride";
						$query = "INSERT INTO `tc_user_ride_commitions`(`user_id`,`ride_id`,`amount`,`crt_date`,`credit_debit`,`reccomment`,`commisionper`) VALUES('".$userid."','".$ride_id."','".$refamount."','".date("y-m-d")."','1','".$reccomment."','".$commisionper."')";
						$this->User->query($query);
					}
					
					//update the users total points
					$this->User->query('Update `tc_users` User SET User.`currentcredit`=(User.`currentcredit`+'.$refamount.') WHERE User.`id`='.$userid);
				}
				
			}
		}
		else{
			//commision goes to the user and to the admin
			if($amount>0){
				//insert into data base section is pendding
				$reccomment = "Earn Commition from this Ride";
				$query = "INSERT INTO `tc_user_ride_commitions`(`user_id`,`ride_id`,`amount`,`crt_date`,`credit_debit`,`reccomment`,`commisionper`) VALUES('".$user_id."','".$ride_id."','".$amount."','".date("y-m-d")."','1','".$reccomment."','50')";
				$this->User->query($query);
				
				//update the users total points
				$this->User->query('Update `tc_users` User SET User.`currentcredit`=(User.`currentcredit`+'.$amount.') WHERE User.`id`='.$user_id);
			}
			
		}
		return $ref_commision;
	}
	
	//edited on 29-06-15 new section of driver refferal distributions
	public function refferaldistributionamongdriver($amount=0,$ride_id=0,$user_id=0,$userrefferby=0,$company_id=1){
		$this->loadModel('User'); //for access data connection
		$ref_commision=0;
		//echo $amount." r: ".$ride_id." U: ".$user_id." REf: ".$userrefferby;
		if($amount==0 || $user_id==0 || $ride_id==0 || $userrefferby==0){
			return 0;
		}
		if($userrefferby>0){
			//now find out rest max three level user chain who get point from admin earninf
			$usersheirchy = array(
				'fuserid'=>$userrefferby,
			);
			$usersreferralcodes = array();
			
			//now get the reffere details
			/*$quey = "SELECT FU.my_refferal_code fuser_reffcode, IFNULL(SU.id,'0') suser_id, SU.my_refferal_code suser_reffcode,SU.reffered_by as tuser_id,
			IF(SU.reffered_by>0,(SELECT TUR.my_refferal_code from tc_users TUR WHERE TUR.id=SU.reffered_by),'') as tuser_reffcode FROM tc_users FU
			LEFT JOIN tc_users SU ON FU.reffered_by=SU.id WHERE FU.id='".$userrefferby."'";*/
			
			$quey = "SELECT IFNULL(SU.id,'0') suser_id, SU.reffered_by as tuser_id FROM tc_users FU
			LEFT JOIN tc_users SU ON FU.reffered_by=SU.id WHERE FU.id='".$userrefferby."' AND FU.company_id='".$company_id."'";
			$queryExe = $this->User->query($quey);
			//pr($queryExe);
			if(isset($queryExe) && is_array($queryExe) && count($queryExe)>0){
				foreach($queryExe as $otherusersa){
					//pr($otherusersa);
					foreach($otherusersa as $otherusers){
						//pr($otherusers);
						foreach($otherusers as $key=>$val){
							$usersheirchy[$key]=$val;
						}
					}
				}
			}
			//pr($usersheirchy);
			if(count($usersheirchy)>0){
				//now get the commiton get range sections
				$totalcommitions=0;
				foreach($usersheirchy as $key=>$val){
					$refamount = 0;
					$userid = $val;
					if($userid==0){
						continue;
					}
					$findquery = "SELECT DriverCommisionDistributions.* FROM `tc_driver_commision_distributions` DriverCommisionDistributions  WHERE (select count(id) from `tc_users`
					WHERE `reffered_by`='".$userid."') BETWEEN DriverCommisionDistributions.`min_range` AND DriverCommisionDistributions.`max_range` AND DriverCommisionDistributions.`is_active`='1' AND DriverCommisionDistributions.`is_deleted`='0' AND DriverCommisionDistributions.`company_id`='".$company_id."' LIMIT 1";
					$resultset = $this->User->query($findquery);
					//pr($resultset);
					if(isset($resultset) && is_array($resultset) && count($resultset)>0){
						$commision_per = 0;
						foreach( $resultset as $res){
							//pr($res);
							if(isset($res['DriverCommisionDistributions']) && count($res['DriverCommisionDistributions'])>0){
								$chargeres = $res['DriverCommisionDistributions'];
								$commision_per = $chargeres['commision_per'];
								$refamount = ($amount*$commision_per)/100;
								$totalcommitions=$totalcommitions+$refamount;
								if($refamount>0 ){
									if($user_id==$userid){
										$ref_commision+=$refamount;
									}
									//validate if user get commition befor i that ride
									$selquery = "SELECT UserRideCommitions.`id`,UserRideCommitions.`amount`,UserRideCommitions.`commisionper` FROM `tc_user_ride_commitions` UserRideCommitions WHERE UserRideCommitions.`ride_id`='".$ride_id."' AND UserRideCommitions.`user_id`='".$userid."'";
									//$res = $this->User->query($selquery);
									$res = array();
									if(isset($res) && is_array($res) && count($res)>0){
										//pr($res);
										$pamount = "0";
										$recid = 0;
										foreach($res as $result){
											$recid = $result['UserRideCommitions']['id'];
											$pamount=(isset($result['UserRideCommitions']['amount']) && $result['UserRideCommitions']['amount']>0)?$result['UserRideCommitions']['amount']:0;
											$pamount=$pamount+$refamount;
											$commision = $result['UserRideCommitions']['commisionper']+$commision_per;
											//now update the table
											$upquery = "UPDATE `tc_user_ride_commitions` SET `amount`='".$pamount."',`commisionper`='".$commision."',`earn_in_driver_chain`='1' WHERE `ride_id`='".$ride_id."' AND `user_id`='".$userid."' AND `id`='".$recid."'";
											$this->User->query($upquery);
										}
									}
									else{
										//insert into data base section is pendding
										$reccomment = "Earn Commition from this Ride";
										$query = "INSERT INTO `tc_user_ride_commitions`(`user_id`,`ride_id`,`amount`,`crt_date`,`credit_debit`,`reccomment`,`commisionper`,`earn_in_driver_chain`) VALUES('".$userid."','".$ride_id."','".$refamount."','".date("y-m-d")."','1','".$reccomment."','".$commision_per."','1')";
										$this->User->query($query);
									}
									
									//update the users total points
									$this->User->query('Update `tc_users` User SET User.`currentcredit`=(User.`currentcredit`+'.$refamount.') WHERE User.`id`='.$userid);
								}
							}
						}
					}
				}
				
				//now update the rode table with the drivers commotion distributions
				$this->User->query('Update `tc_rides` Ride SET Ride.`drivercommision`='.$totalcommitions.' WHERE Ride.`id`='.$ride_id);
			}
		}
		return $ref_commision;
	}
	
	/**
	 * testinf section
	 */
	public function drivercommisiontest(){
		header('Content-Type: application/json');
		$amount=100;
		$ride_id=200;
		$user_id='172';
		$userrefferby='169';
		$this->refferaldistributionamongdriver($amount,$ride_id,$user_id,$userrefferby);
		die(json_encode(array('status'=>'1','msg'=>'ok')));
	}

	public function driverregistration() {
		header('Content-Type: application/json');
		if ($this->request->is('post') ) {
			$this->write_log($this->request->data);
			//die(json_encode(array('pdata'=>$this->request->data)));
			$this->loadModel('User');
			$this->loadModel('DriverCustom');
			$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
			$registerArray = array();
			$registerCustomarray = array();
			// User table Data
			$registerArray['User']['user_type'] 	= '1';
			$registerArray['User']['username'] 	= isset($this->request->data['txtUname'])?$this->request->data['txtUname']:'';//"testuser";
			$registerArray['User']['f_name'] 	= isset($this->request->data['txtUfname'])?$this->request->data['txtUfname']:'';
			$registerArray['User']['l_name'] 	= isset($this->request->data['txtUlname'])?$this->request->data['txtUlname']:'';
			$registerArray['User']['email'] 	= isset($this->request->data['txtUemail'])?$this->request->data['txtUemail']:"";
			$registerArray['User']['mobile'] 	= isset($this->request->data['txtUmobile'])?$this->request->data['txtUmobile']:"";
			$registerArray['User']['address'] 	= isset($this->request->data['txtUaddress'])?$this->request->data['txtUaddress']:"";
			$registerArray['User']['pass'] 		= isset($this->request->data['txtUpass'])?$this->request->data['txtUpass']:"";
			$registerArray['User']['refferal_code'] = isset($this->request->data['ref_code'])?$this->request->data['ref_code']:'';
			$registerArray['User']['reffered_by']	= '0';
			$registerArray['User']['company_id'] = $company_id;
			// custome data of the user set
			$registerCustomarray['DriverCustom']['drive_city'] 	= isset($this->request->data['txtDCity'])?$this->request->data['txtDCity']:'1';
			$registerCustomarray['DriverCustom']['company_name'] 	= isset($this->request->data['txtCcname'])?$this->request->data['txtCcname']:"";
			$registerCustomarray['DriverCustom']['address1'] 	= isset($this->request->data['txtCaddress1'])?$this->request->data['txtCaddress1']:"";
			$registerCustomarray['DriverCustom']['address2'] 	= isset($this->request->data['txtCaddress2'])?$this->request->data['txtCaddress2']:"";
			$registerCustomarray['DriverCustom']['country_id'] 	= '1';
			$registerCustomarray['DriverCustom']['city_id'] 	= isset($this->request->data['txtCcity'])?$this->request->data['txtCcity']:'1';
			//for time being company city id and driver city id is same
			$registerCustomarray['DriverCustom']['drive_city'] = $registerCustomarray['DriverCustom']['city_id'];
			$registerCustomarray['DriverCustom']['region'] 		= isset($this->request->data['txtCregion'])?$this->request->data['txtCregion']:'resing';
			$registerCustomarray['DriverCustom']['postal_code'] 	= isset($this->request->data['txtCpcode'])?$this->request->data['txtCpcode']:'';
			$registerCustomarray['DriverCustom']['mobile'] 		= isset($this->request->data['txtCmobile'])?$this->request->data['txtCmobile']:'';
			$registerCustomarray['DriverCustom']['arg_bus_card'] 	=isset( $this->request->data['txtCABN'])?$this->request->data['txtCABN']:'';
			
			$registerCustomarray['DriverCustom']['lat'] 		= isset($this->request->data['lat'])?$this->request->data['lat']:'0.00';
			$registerCustomarray['DriverCustom']['long'] 		= isset($this->request->data['long'])?$this->request->data['long']:'0.00';
			$registerCustomarray['DriverCustom']['device_unique_id'] = isset($this->request->data['device_unique_id'])?$this->request->data['device_unique_id']:'notpresent';
			$registerCustomarray['DriverCustom']['status'] 		= "0";
			$registerCustomarray['DriverCustom']['is_owner'] 	= "1";
			$registerCustomarray['DriverCustom']['device_type'] 	= isset($this->request->data['device_type'])?$this->request->data['device_type']:'1';
			
			//create refferal code for the user
			/*// CREATING RANDOM REFERER CODE
			$alpha1 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$ALPHAM1 = $alpha1[array_rand($alpha1, 1)];
			$alpha2 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$ALPHAM2 = $alpha2[array_rand($alpha2, 1)];
			$alpha3 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$ALPHAM3 = $alpha3[array_rand($alpha3, 1)];
			$randCode = $ALPHAM1.$ALPHAM2.$ALPHAM3.rand(99,999);
			*/
			//get site config values
			$this->siteconfiguration($company_id);
			
			$randCode = $this->generaterefferalcode();
			//add refferal code to the user
			$registerArray['User']['my_refferal_code']=$randCode;
			//create date 
			$registerArray['User']['reg_date']=date("Y-m-d G:i:s");
			//add driver default creadit balance first time creation
			$registerArray['User']['currentcredit']=$this->usercurrentcreditminlimit;
			//password encript
			$registerArray['User']['pass']=md5($registerArray['User']['pass']);
			//email duplicate validation
			$isduplicateemail = $this->duplicateemail($registerArray['User']['email']);
			if($isduplicateemail){
				die(json_encode(array('status'=>'0','msg'=>'Email already present')));	
			}
			
			//now validate the fields
			if(isset($registerArray['User'])  &&  count($registerArray)==1){
				foreach($registerArray['User'] as $key=>$val){
					/*if($key=="username" && $val==''){
						die(json_encode(array('status'=>'0','msg'=>'Username required')));	
					}
					if($key=="f_name" && $val==''){
						die(json_encode(array('status'=>'0','msg'=>'First name required')));	
					}
					if($key=="email" && $val==''){
						die(json_encode(array('status'=>'0','msg'=>'Email required')));	
					}
					if($key=="email" && !filter_var($val, FILTER_VALIDATE_EMAIL)){
						die(json_encode(array('status'=>'0','msg'=>'Valid Email required')));	
					}
					if($key=="pass" && $val==''){
						die(json_encode(array('status'=>'0','msg'=>'Username required')));	
					}*/
					if($key=="refferal_code" && $val!=''){
						$option = array(
							'conditions'=>array(
								'User.my_refferal_code'=>$val,
								'User.company_id'=>$company_id
							),
						);
						$userData = $this->User->find('first',$option);
						if(isset($userData) && count($userData)>0 && isset($userData['User']['id'])){
							$registerArray['User']['reffered_by'] = $userData['User']['id'];
							
						}
					}
				}
			}
			
			// user custome data validation
			if(isset($registerCustomarray['DriverCustom'])  &&  count($registerCustomarray)==1){
				foreach($registerCustomarray['DriverCustom'] as $key=>$val){
				//remaining pendding	
				}
			}
			
			// image upload section
			$filename="";
			if(isset($_FILES['user_image']) && $_FILES['user_image']['name']!=''){
				$filename = trim(time().str_replace(' ','_',$_FILES['user_image']['name']));
				if(move_uploaded_file($_FILES['user_image']['tmp_name'],WWW_ROOT."userPic/".$filename)){
					$source = WWW_ROOT."userPic/".$filename;
					$destination = WWW_ROOT."userPic/thumb_".$filename;
					$this->Thumb->createthumbs($source,$destination,100,80);
				}
				else{
					$filename="";
				}
			}
			
			if($filename!='' && $filename!=""){
				$userPic = FULL_BASE_URL.$this->base."/userPic/".$filename;
			}else{
				$userPic ='';
			}
			
			//assign the file name in custome section
			$registerCustomarray['DriverCustom']['user_pic']=$filename;
			//after validation create the user
			$this->User->create();
			if ($this->User->save($registerArray)) {
				$id = $this->User->id;
				//enter the free credit in payment commition
				$this->loadModel('CommissionPayment');
				$commitionpay = array('CommissionPayment'=>array(
					'company_id'=>$company_id,
					'user_id'=>$id,
					'scheme_id'=>'0',
					'paying_cost'=>$this->usercurrentcreditminlimit,
					'points'=>$this->usercurrentcreditminlimit,
					'paying_date'=>date('Y-m-d'),
					'payment_type'=>'1',
					'transection_id'=>'0',
					'is_admin_give'=>'1'
				));
				$this->CommissionPayment->save($commitionpay);
				//edited on 18-07-2015
				//save into the user_ride_commition as credit mode
				//now insert  into the
				$reccomment="commission credited by the admin recharge with points ".$this->usercurrentcreditminlimit;
				$this->User->query("INSERT INTO tc_user_ride_commitions(`user_id`,`ride_id`,`amount`,`is_withdrawl`,`crt_date`,`credit_debit`,`reccomment`) VALUES('".$id."','0','".$this->usercurrentcreditminlimit."','0','".date('Y-m-d')."','1','".$reccomment."')");
				// UserCustom table data
				$registerCustomarray['DriverCustom']['user_id'] = $id;
				//pr($registerCustomarray);
				$this->DriverCustom->create();
				if ($this->DriverCustom->save($registerCustomarray)) {
					$licensedoc=array('docpath'=>'','expdate'=>'');
					$insurancedoc=array('docpath'=>'','expdate'=>'');
					$authdoc=array('docpath'=>'','expdate'=>'');
					$operatordoc=array('docpath'=>'','expdate'=>'');
					$payingcommisionpercent = 0;
					//
					//user current status of creadit after recharge
					$usercreditperandbuycredit = $this->getpayingpercentageandbuycredit($id);
					$payingcommisionpercent = $usercreditperandbuycredit['payingcommisionpercent'];
					$buycreadit = $usercreditperandbuycredit['buycreadit'];
					$credit_warning = $usercreditperandbuycredit['credit_warning'];
					//get driver ratting
					//$rating = $this->userrattingsection($id,1);
					$rating=5;
					$credit_cards=null;
					$data = array(
						"user_id"=>$id,
						"f_name"=>$registerArray['User']['f_name'],
						"l_name"=>$registerArray['User']['l_name'],
						"email"=>$registerArray['User']['email'],
						"mobile"=>$registerArray['User']['mobile'],
						"profile_img"=>	$userPic,
						"blocked"=>'0',
						"refferal_code"=>$registerArray['User']['my_refferal_code'],
						'credit_cards'=>$credit_cards,
						'insurance_doc'=>$insurancedoc,
						'authority_card_doc'=>$authdoc,
						'license_doc'=>$licensedoc,
						'vehicle_operator_doc'=>$operatordoc,
						'payingcommisionpercent'=>$payingcommisionpercent,
						'buycreadit'=>$buycreadit,
						'credit_warning'=>$credit_warning,
						'rating'=>$rating,
						'vehicles'=>array(),
						'status'=>'0'
					);
					die(json_encode(array(
							'status'=>'1',
							'msg'=>'Registration successfully',
							"user_id"=>$id,
							"f_name"=>$registerArray['User']['f_name'],
							"l_name"=>$registerArray['User']['l_name'],
							"email"=>$registerArray['User']['email'],
							"mobile"=>$registerArray['User']['mobile'],
							"profile_img"=>	$userPic,
							"blocked"=>'0',
							"data"=>$data,
							"refferal_code"=>$registerArray['User']['my_refferal_code'],
							'credit_cards'=>$credit_cards,
							'insurance_doc'=>$insurancedoc,
							'authority_card_doc'=>$authdoc,
							'license_doc'=>$licensedoc,
							'vehicle_operator_doc'=>$operatordoc,
							'payingcommisionpercent'=>$payingcommisionpercent,
							'buycreadit'=>$buycreadit,
							'credit_warning'=>$credit_warning,
							'rating'=>$rating,
							'vehicles'=>array()
							//'status'=>'1'
					)));
				}
				else{
					die(json_encode(array('status'=>'0','msg'=>'Try again ',)));
				}	
			}
			else {
				die(json_encode(array('status'=>'0','msg'=>'Registration Failed',)));
			}
			
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Requiest','userPic'=>'')));
	}
	
	//test section
	public function add(){
		//$this->updateusercurrentearning(169);
	}
	
	public function makefavride(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				//
				$ride_id = (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0)?$this->request->data['ride_id']:'0';
				$user_id = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:'0';
				$makefav = (isset($this->request->data['makefav']) && $this->request->data['makefav']>0)?$this->request->data['makefav']:'0'; //makefav =1 for fav and 0= not fav
				//validate ride and user
				if($ride_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Information.')));
				}
				if($user_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid User Information.')));
				}
				//now load the model
				$this->loadModel('Ride');
				//now unbind the others model from ride
				$this->Ride->unbindModel(array(
					'belongsTo'=>array('User','Driver','City')
				));
				//now update the ride table
				$this->Ride->id=$ride_id;
				$this->Ride->saveField('is_faviorate',$makefav);
				die(json_encode(array('status'=>'1','msg'=>'Saved Successfully.')));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request.')));
	}
	
	/**
	* usersRideCommisions
	*/
	public function usersridecommisions(){
		header('Content-Type:application/json');
		if($this->request->is('post')){
			//load a model
			$this->loadModel('User');
			if( isset($this->request->data['device_type']) && $this->request->data['device_type']>0 ){
				//valid request
				$user_id 	= (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
				$devicetype 	= (isset($this->request->data['device_type']) && $this->request->data['device_type']!='')?$this->request->data['device_type']:0;
				$pageno 	= (isset($this->request->data['page_no']) && $this->request->data['page_no']>0)?$this->request->data['page_no']:0;
				//pagination section added
				$offset=0;
				$limit=100;
				if($pageno>0){
					$limit=50;
					$offset = ($pageno-1)*$limit;
				}
				
				if($user_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid User Request')));
				}
				//now get user details
				$this->User->unbindModel(array(
					'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail'),
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
				));
				$userDetails = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
				//pr($userDetails);
				if(is_array($userDetails) && count($userDetails)==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid user','reffdata'=>'','currentcredit'=>'0')));
				}
				$currentcredit = number_format($userDetails['User']['currentcredit'],'2','.','');
				//now get all the refferal commition what user earn
				//$query = "SELECT UserRideCommitions.*,SUM(UserRideCommitions.amount) amount FROM `tc_user_ride_commitions` UserRideCommitions WHERE UserRideCommitions.`user_id`='".$user_id."' GROUP BY UserRideCommitions.`ride_id` ORDER BY UserRideCommitions.`id` DESC LIMIT ".$offset.",".$limit;
				
				$query = "SELECT UserRideCommitions.* FROM `tc_user_ride_commitions` UserRideCommitions WHERE UserRideCommitions.`user_id`='".$user_id."' ORDER BY UserRideCommitions.`id` DESC LIMIT ".$offset.",".$limit;
				$refResult  = $this->User->query($query);
				//pr($refResult);
				$reffArray = array();
				if(isset($refResult) && $refResult!='' && is_array($refResult)){
					//valied query
					foreach($refResult as $res){
						
						/*foreach($res as $key=>$val){
							pr($val);
							array_push($reffArray,$val);
						}*/
						if(isset($res['UserRideCommitions']) && is_array($res['UserRideCommitions']) && count($res['UserRideCommitions'])>0){
							//$res['UserRideCommitions']['amount'] = (isset($res['0']['amount']))?$res['0']['amount']:$res['UserRideCommitions']['amount'];
							array_push($reffArray,$res['UserRideCommitions']);
						}
					}
					//now get retunt
					die(json_encode(array('status'=>'1','msg'=>'Refferal commitions','reffdata'=>$reffArray,'currentcredit'=>$currentcredit)));
				}
				else{
					die(json_encode(array('status'=>'1','msg'=>'No Refferal commitions','reffdata'=>$reffArray,'currentcredit'=>$currentcredit)));	
				}
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
		
	}
	
	/*tets section*/
	public function rideinfo(){
		$ride_id = (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0)?$this->request->data['ride_id']:0;
		if($ride_id>0){
			$this->loadModel('Ride');
			//unbind user models
			$this->Ride->User->unbindModel(array(
				'hasOne'=>array('DriverCustom','VehicleDetail'),
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
			));
			//unbind ride model
			$this->Ride->unbindModel(array(
				'belongsTo'=>array('City')
			));
			//unbind driver model
			$this->Ride->Driver->unbindModel(array(
				'hasOne'=>array('CustomerCustom','VehicleDetail'),
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
			));
			$rDetails = $this->Ride->find('first',array(
				'recursive'=>2,
				'conditions'=>array('Ride.id'=>$ride_id)
			));
			//now section for refferal section edited on 30-12-2014 By mrinmoy das
			$custonerid=0;
			$customer_refferalby_id=0;
			$driverid=0;
			$driver_refferalby_id=0;
			$tacycelCommition = 12;
			$refferaldistributioncommision=50;
			$userCommitionAmount = 0;
			$drivercommision=0;
			$customercommision=0;
			//configuration settings
			
			if(isset($rDetails['Ride']['distance_cost']) && $rDetails['Ride']['distance_cost']>0){
				$userCommitionAmount = (($rDetails['Ride']['distance_cost']*$tacycelCommition)/100);
				$userCommitionAmount = (($userCommitionAmount*$refferaldistributioncommision)/100);
			}
			//first chech the refferal id of user (customer)
			if(isset($rDetails['User']['reffered_by']) && $rDetails['User']['reffered_by']>0){
				$customer_refferalby_id = $rDetails['User']['reffered_by'];
				$custonerid = $rDetails['User']['id'];
			}
			//first chech the refferal id of user (driver)
			if(isset($rDetails['Driver']['reffered_by']) && $rDetails['Driver']['reffered_by']>0){
				$driver_refferalby_id = $rDetails['Driver']['reffered_by'];
				$driverid = $rDetails['Driver']['id'];
			}
			if($userCommitionAmount>0){
				if($driver_refferalby_id>0 && $customer_refferalby_id>0){
					$userCommitionAmount=number_format($userCommitionAmount/2,2);
				}
				//now make the payment
				if($customer_refferalby_id>0){
					$customercommision=$this->testrefferaldistribution($userCommitionAmount,$ride_id,$custonerid,$customer_refferalby_id);
				}
				if($driver_refferalby_id>0){
					
					$drivercommision=$this->testrefferaldistribution($userCommitionAmount,$ride_id,$driverid,$driver_refferalby_id);	
				}
			}
			die(json_encode(array("ride"=>$rDetails,
					      'cuscall'=>$customer_refferalby_id,
					      'drvcall'=>$driver_refferalby_id,
					      'cuscom'=>$customercommision,
					      'drvcom'=>$drivercommision,
					      "amount"=>$userCommitionAmount
			)));
		}
		die(json_encode(array("ride"=>"nor valid")));
	}
	
	/**
	* refferaldistribution
	* @param amount
	* @param ride_id
	* @param user_id
	* @param driverrefferbycode
	*/
	public function testrefferaldistribution($amount=0,$ride_id=0,$user_id=0,$userrefferby=0){
		$this->loadModel('User'); //for access data connection
		$ref_commision=$amount;
		$insertedAmount=array();
		//echo $amount." r: ".$ride_id." U: ".$user_id." REf: ".$userrefferby;
		if($amount==0 || $user_id==0 || $ride_id==0){
			return $ref_commision;
		}
		//refferer code
		
		if($userrefferby>0){
			$usersheirchy = array(
				'fuserid'=>$user_id,
				'suserid'=>$userrefferby
			);
			//now get the reffere details
			$quey = "SELECT IFNULL(SU.id,'0') suser_id,IF(SU.reffered_by>0,(SELECT TU.id from tc_users TU WHERE TU.id=SU.reffered_by),'0') as tuser_id FROM tc_users FU
			LEFT JOIN tc_users SU ON FU.reffered_by=SU.id WHERE FU.id='".$userrefferby."'";
			$queryExe = $this->User->query($quey);
			//pr($queryExe);
			if(isset($queryExe) && is_array($queryExe) && count($queryExe)>0){
				foreach($queryExe[0] as $otherusers){
					//pr($otherusers);
					if(isset($otherusers['suser_id']) && $otherusers['suser_id']>0){
						$usersheirchy['tuserid']=$otherusers['suser_id'];
						if(isset($otherusers['tuser_id']) && $otherusers['tuser_id']>0)
							$usersheirchy['fuuserid']=$otherusers['tuser_id'];
					}
				}
			}
			//pr($usersheirchy);
			//percentage distributions
			$fuser = $suser = $tuser = $fuuser =0;
			
			if(count($usersheirchy)==4){
				$fuser = $suser = $tuser = $fuuser=25;
			}
			elseif(count($usersheirchy)==3){
				/*$fuser = 50;
				$suser = $tuser = 25;*/
				$fuser = $suser = $tuser =33.3;
			}
			else{
				$fuser = $suser =50;
			}
			
			//now distribution of refferal amount
			foreach($usersheirchy as $key=>$val){
				$refamount = 0;
				$userid = $val;
				if($key=='fuserid'){
					//echo $fuser;
					$refamount = number_format((($amount*$fuser)/100),2);
					$ref_commision = $refamount;
				}
				elseif($key=='suserid'){
					//echo $suser;
					$refamount = number_format((($amount*$suser)/100),2);	
				}
				elseif($key=='tuserid'){
					//echo $tuser;
					$refamount = number_format((($amount*$tuser)/100),2);	
				}
				elseif($key=='fuuserid'){
					//echo $fuuser;
					$refamount = number_format((($amount*$fuuser)/100),2);	
				}
				else{
					
				}
				if($refamount>0){
					//insert into data base section is pendding
					$insertedAmount[$key]=$refamount;
				}
			}
		}
		return array('userfr'=>$ref_commision,'tot'=>$insertedAmount);
	}
	
	//document upload section crt on : 21-04-15 by mrinmoy
	public function docummentuploads(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$user_id = isset($this->request->data['user_id'])?$this->request->data['user_id']:0;
				$user_type = isset($this->request->data['user_type'])?$this->request->data['user_type']:0;
				$document_type = isset($this->request->data['document_type'])?$this->request->data['document_type']:'';
				$document_expiry_date = isset($this->request->data['document_expiry_date'])?$this->request->data['document_expiry_date']:'';
				$filename='';
				$uploaddocdtls=array();
				$baseflpath = FULL_BASE_URL.$this->base."/userDoc/";
				//validate user data is valid or not
				if($user_id<1 || $user_id==null){
					die(json_encode(array('status'=>'0','msg'=>'Invalid user')));
				}
				if($user_type=='' || $user_type==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid user type')));
				}
				if($document_type=='' || $document_type==null){
					die(json_encode(array('status'=>'0','msg'=>'Invalid user document type')));
				}
				if($document_expiry_date=='' || $document_expiry_date==null){
					die(json_encode(array('status'=>'0','msg'=>'Invalid user document expity date')));
				}
				//make default expiry date
				$expdate =date("Y-m-d",strtotime($document_expiry_date));
				//if file esixt
				
				if(isset($_FILES['user_image']) && $_FILES['user_image']['size']>0){
					$filename = time().trim(str_replace(' ','_',$_FILES['user_image']['name']));
					$uploadpath = WWW_ROOT."userDoc/".$filename;
					if(!move_uploaded_file($_FILES['user_image']['tmp_name'],$uploadpath)){
						$filename='';
					}
				}
				if($user_type=='1'){
					//for driver
					//load model for driver doccuments
					$this->loadModel('DriverDocument');
					//now removed old file fron directory
					if($filename!=''){
						//load model
						$condition = array('DriverDocument.user_id'=>$user_id);
						$options = array(
							'recursive'=>'0',
							'conditions'=>$condition
						);
						//unbind user model
						$this->DriverDocument->unbindModel(array(
							'belongsTo'=>array('User')
						));
						$driverDoccument = $this->DriverDocument->find('first',$options);
						if(isset($driverDoccument) && is_array($driverDoccument) && count($driverDoccument)>0){
							//update the old data of the user
							$driverDoccumentid = $driverDoccument['DriverDocument']['id'];
							$condition['DriverDocument.id']=$driverDoccumentid;
							//pr($condition);
							$status = '1';
							$msg = "update successfully";
							//unbind user model for update section
							$this->DriverDocument->unbindModel(array(
								'belongsTo'=>array('User')
							));
							$oldflname='';
							if($document_type=='insurance'){
								$oldflname = $driverDoccument['DriverDocument']['filename'];
								//now update the record
								$updateparam = array('DriverDocument.filename'=>'"'.$filename.'"','DriverDocument.expiry_date'=>'"'.$expdate.'"');
								$this->DriverDocument->updateAll($updateparam,$condition);
							}
							elseif($document_type=='authority_card'){
								$oldflname = $driverDoccument['DriverDocument']['filename_auth'];
								//now update the record
								$updateparam = array('DriverDocument.filename_auth'=>'"'.$filename.'"','DriverDocument.expiry_date_auth'=>'"'.$expdate.'"');
								$this->DriverDocument->updateAll($updateparam,$condition);
								
							}
							elseif($document_type=='license'){
								$oldflname = $driverDoccument['DriverDocument']['filename_lic'];
								//now update the record
								$updateparam = array('DriverDocument.filename_lic'=>'"'.$filename.'"','DriverDocument.expiry_date_lic'=>'"'.$expdate.'"');
								$this->DriverDocument->updateAll($updateparam,$condition);
							}
							elseif($document_type=='vehicle_operator'){
								$oldflname = $driverDoccument['DriverDocument']['filename_oper'];
								//now update the record
								$updateparam = array('DriverDocument.filename_oper'=>'"'.$filename.'"','DriverDocument.expiry_date_oper'=>'"'.$expdate.'"');
								$this->DriverDocument->updateAll($updateparam,$condition);
							}
							else{
								//do nothing go back
								$status='0';
								$msg="Invalid file type";
							}
							//unling the old file
							if($oldflname!=''){
								$oldflpath = WWW_ROOT."userDoc/".$oldflname;
								if(file_exists($oldflpath)){
									unlink($oldflpath);
								}	
							}
							$uploaddocdtls = array(
								'docpath'=>$baseflpath.$filename,
								'expdate'=>$expdate
							);
							
							die(json_encode(array('status'=>$status,'msg'=>$msg,'uploaddocdtls'=>$uploaddocdtls)));
						}
						else{
							$status='0';
							$msg='saved error';
							//create new data for that user
							if($document_type=='insurance'){
								$driverdoc = array(
									'DriverDocument'=>array(
										'filename'=>$filename,
										'expiry_date'=>$expdate,
										'user_id'=>$user_id
									)
								);
								if($this->DriverDocument->save($driverdoc)){
									$status='1';
									$msg='saved';
								}
							}
							elseif($document_type=='authority_card'){
								$driverdoc = array(
									'DriverDocument'=>array(
										'filename_auth'=>$filename,
										'expiry_date_auth'=>$expdate,
										'user_id'=>$user_id
									)
								);
								if($this->DriverDocument->save($driverdoc)){
									$status='1';
									$msg='saved';
								}
							}
							elseif($document_type=='license'){
								$driverdoc = array(
									'DriverDocument'=>array(
										'filename_lic'=>$filename,
										'expiry_date_lic'=>$expdate,
										'user_id'=>$user_id
									)
								);
								if($this->DriverDocument->save($driverdoc)){
									$status='1';
									$msg='saved';
								}
							}
							elseif($document_type=='vehicle_operator'){
								$driverdoc = array(
									'DriverDocument'=>array(
										'filename_oper'=>$filename,
										'expiry_date_oper'=>$expdate,
										'user_id'=>$user_id
									)
								);
								if($this->DriverDocument->save($driverdoc)){
									$status='1';
									$msg='saved';
								}
							}
							else{
								//do nothing go back
							}
							$uploaddocdtls = array(
								'docpath'=>$baseflpath.$filename,
								'expdate'=>$expdate
							);
							die(json_encode(array('status'=>$status,'msg'=>$msg,'uploaddocdtls'=>$uploaddocdtls)));
						}
					}
					else{
						die(json_encode(array('status'=>'0','msg'=>'Invalid document file')));	
					}
				}
				else{
					//invalid request
					die(json_encode(array('status'=>'0','msg'=>'Invalid user type request')));
				}
				
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid request')));
	}
	//pay commission
	public function paycommissions(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$user_id = isset($this->request->data['user_id'])?$this->request->data['user_id']:0;
				$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
				//load model
				$this->loadModel('Ride');
				//menual query
				$paingamount=0;
				$buycreadit=0;
				$credit_warning=0;
				$payingcommisionpercent=0;
				$usercurrentcredit=0;
				$ride_ids=0;
				$payingridecost = $this->Ride->query("SELECT IFNULL(sum(`Ride`.`commission_cost`),0) commissioncost,group_concat(CAST(`Ride`.`id` as CHAR)) ride_ids FROM `tc_rides` `Ride` WHERE `Ride`.`driver_id`='".$user_id."' AND `Ride`.`commission_paid`='0' AND `Ride`.`status`='4' AND `Ride`.`company_id`='".$company_id."'");
				//pr($payingridecost);
				if(isset($payingridecost) && is_array($payingridecost) && count($payingridecost)>0){
					foreach($payingridecost[0] as $totalcostarray){
						$paingamount = isset($totalcostarray['commissioncost'])?$totalcostarray['commissioncost']:0;
						$ride_ids =(isset($totalcostarray['ride_ids']))?explode(",",$totalcostarray['ride_ids']):array();
					}
				}
				
				//now update the ride table
				$this->Ride->unbindModel(array('belongsTo'=>array('User','Driver','City')));
				$this->Ride->updateAll(array('Ride.commission_paid'=>'1'),array('Ride.driver_id'=>$user_id,'Ride.commission_paid'=>'0','Ride.id'=>$ride_ids));
				
				//now insert the record into the
				$this->Ride->query("INSERT INTO `tc_commission_payments` (`user_id`,`scheme_id`,`paying_cost`,`paying_date`,`payment_type`,`company_id`) VALUES('".$user_id."','0','".$paingamount."','".date('Y-m-d')."','2','".$company_id."')");
				//insert int0 tc_user_ride_commitions to trace from one area
				$reccomment="commiton debited for ".count($ride_ids)." Rides";
				$this->Ride->query("INSERT INTO tc_user_ride_commitions(`user_id`,`ride_id`,`amount`,`is_withdrawl`,`crt_date`,`credit_debit`,`reccomment`) VALUES('".$user_id."','0','".$paingamount."','0','".date('Y-m-d')."','2','".$reccomment."')");
				
				//now deduct the amount from user table
				$this->Ride->query('Update `tc_users` User SET User.`currentcredit`=(User.`currentcredit`-'.$paingamount.') WHERE User.`id`='.$user_id);
				
				//user current status of creadit after recharge
				$usercreditperandbuycredit = $this->getpayingpercentageandbuycredit($user_id);
				$payingcommisionpercent = $usercreditperandbuycredit['payingcommisionpercent'];
				$buycreadit = $usercreditperandbuycredit['buycreadit'];
				$credit_warning = $usercreditperandbuycredit['credit_warning'];
				die(json_encode(array('status'=>'1','msg'=>'Your request done','payingcommisionpercent'=>$payingcommisionpercent,'buycreadit'=>$buycreadit,'credit_warning'=>$credit_warning)));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid request')));
	}
	
	//user creadit card
	public function usercreditcard($user_id=0){
		$cardsdtls=array();
		if($user_id>0){
			$this->loadModel('User');
			$this->User->unbindModel(array('hasMany'=>array('CustomerRide','DriverRide'),'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail')));
			$findCustCustom = $this->User->find('first',array(
				'conditions'=>array('User.id'=>$user_id)
			));
			//pr($findCustCustom);
			if( $findCustCustom && isset($findCustCustom['UserCreditDetail']) ){
				$cardsdtls = $this->makecardarray($findCustCustom['UserCreditDetail']);
			}
		}
		return $cardsdtls;
	}
	//test section of due paying commitin persentage
	public function tstduepayment(){
		$user_id = isset($this->request->data['user_id'])?$this->request->data['user_id']:0;
		$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
		if($user_id==0){
			die(json_encode(array('status'=>'0','msg'=>'Invalid request')));
		}
		//load model
		$this->loadModel('Ride');
		//menual query
		$paingamount=0;
		$payingcommisionpercent=0;
		$payingridecost = $this->Ride->query("SELECT sum(`Ride`.`commission_cost`) commissioncost FROM `tc_rides` `Ride` WHERE `Ride`.`driver_id`='".$user_id."' AND `Ride`.`commission_paid`='0' AND `Ride`.`status`='4' AND `Ride`.`company_id`>='".$company_id."'");
		//pr($payingridecost);
		if(isset($payingridecost) && is_array($payingridecost) && count($payingridecost)>0){
			foreach($payingridecost[0] as $totalcostarray){
				$paingamount = isset($totalcostarray['commissioncost'])?$totalcostarray['commissioncost']:0;
			}
		}
		//get user
		//unbind user model
		$this->Ride->User->unbindModel(array(
			'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		$result = $this->Ride->User->find('first',array('recursive'=>'0','conditions'=>array('User.id'=>$user_id,'User.user_type'=>'1','User.company_id'=>$company_id)));
		//pr($result);
		$currentcredit = $result['User']['currentcredit'];
		if($currentcredit>0){
			$payingcommisionpercent = (($paingamount/$currentcredit)*100);
		}
		die(json_encode(array('payingcost'=>$paingamount,'currentcredit'=>$currentcredit,'persent'=>$payingcommisionpercent)));
	}
	
	//recharge the account
	public function rechargedaccount(){
		header('Content-Type: application/json');
		//$this->write_log($this->request->data);
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$user_id = isset($this->request->data['user_id'])?$this->request->data['user_id']:0;
				$amount = isset($this->request->data['amount'])?$this->request->data['amount']:0;
				$card_id = isset($this->request->data['card_id'])?$this->request->data['card_id']:0;
				$scheme_id = isset($this->request->data['scheme_id'])?$this->request->data['scheme_id']:0;
				$scheme_points=0;
				$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
				//load the model
				$this->loadModel('User');
				$this->loadModel('RechargeScheme');
				//user validate
				if($user_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid User Information')));
				}
				//card
				if($card_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid Card chossen')));
				}
				//get schem details
				if($scheme_id>0){
					//get full information of the scheme
					$amount=0;
					//do custome query
					//$schemeDetals = $this->User->query("SELECT * FROM `tc_recharge_schemes` `RechargeScheme` WHERE `RechargeScheme`.`id`='".$scheme_id."' AND `RechargeScheme`.`isactive`='1'");
					$schemdetail = $this->RechargeScheme->find('first',array('conditions'=>array('RechargeScheme.id'=>$scheme_id,'RechargeScheme.company_id'=>$company_id,'RechargeScheme.isactive'=>'1')));
					//pr($schemdetail);
					/*if(is_array($schemeDetals)){
						foreach($schemeDetals as $ky=>$val){
							$schemdetail = $val;
							break;
						}
					}*/
					if(isset($schemdetail) && is_array($schemdetail)){
						$amount = (isset($schemdetail['RechargeScheme']['amount']))?$schemdetail['RechargeScheme']['amount']:0;
						$scheme_points = (isset($schemdetail['RechargeScheme']['point']))?$schemdetail['RechargeScheme']['point']:0;
					}
					else{
						die(json_encode(array('status'=>'0','msg'=>'Invalid Scheme chossen not present')));
					}
				}
				else{
					die(json_encode(array('status'=>'0','msg'=>'Invalid Scheme chossen')));
				}
				//make payment api call
				$ispayment=1;
				$paymsg="";
				$transectionid = 0;
				$paymentreturn = $this->usercardpayment($card_id,$amount);
				//pr($paymentreturn);
				if(is_array($paymentreturn)){
					$ispayment = isset($paymentreturn['status'])?$paymentreturn['status']:0;
					$paymsg = isset($paymentreturn['msg'])?$paymentreturn['msg']:'';
					$transectionid = isset($paymentreturn['transactionid'])?$paymentreturn['transactionid']:'0';
				}
				//payment error
				if($ispayment!=1){
					die(json_encode(array('status'=>'0','msg'=>$paymsg)));
				}
				//echo $amount;
				
				if($user_id>0 && $amount>0 && $ispayment==1){
					
					//first insert into commission_payments
					$this->User->query("INSERT INTO `tc_commission_payments` (`user_id`,`scheme_id`,`paying_cost`,`paying_date`,`payment_type`,`company_id`,`transection_id`) VALUES('".$user_id."','".$scheme_id."','".$amount."','".date('Y-m-d')."','1','".$company_id."','".$transectionid."')");
					//now insert  into the
					$reccomment="commiton credited by the scheme recharge rith points".$scheme_points;
					$this->User->query("INSERT INTO tc_user_ride_commitions(`user_id`,`ride_id`,`amount`,`is_withdrawl`,`crt_date`,`credit_debit`,`reccomment`) VALUES('".$user_id."','0','".$amount."','0','".date('Y-m-d')."','1','".$reccomment."')");
					
					//now add the amount from user table
					$this->User->query('Update `tc_users` User SET User.`currentcredit`=(User.`currentcredit`+'.$amount.') WHERE User.`id`='.$user_id);
					//user current status of creadit after recharge
					$usercreditperandbuycredit = $this->getpayingpercentageandbuycredit($user_id);
					$payingcommisionpercent = $usercreditperandbuycredit['payingcommisionpercent'];
					$buycreadit = $usercreditperandbuycredit['buycreadit'];
					$credit_warning = $usercreditperandbuycredit['credit_warning'];
					die(json_encode(array('status'=>'1','msg'=>'Your acount rechared','payingcommisionpercent'=>$payingcommisionpercent,
							      'buycreadit'=>$buycreadit,'credit_warning'=>$credit_warning,'amount'=>$amount,'point'=>$scheme_points)));
				}
				die(json_encode(array('status'=>'0','msg'=>'Invalid user or amount')));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid request')));
	}
	
	//get info of the credit
	public function getpayingpercentageandbuycredit($user_id=0){
		$payingcommisionpercent=0;
		$buycreadit=0;
		$creaditwarning=0;
		if($user_id>0){
			$this->loadModel('User');
			//get after rechared the credit persentage and buycredit
			$paingamount=0;
			$payingridecost = $this->User->query("SELECT sum(`Ride`.`commission_cost`) commissioncost FROM `tc_rides` `Ride` WHERE `Ride`.`driver_id`='".$user_id."' AND `Ride`.`commission_paid`='0' AND `Ride`.`status`='4'");
			//pr($payingridecost);
			if(isset($payingridecost) && is_array($payingridecost) && count($payingridecost)>0){
				foreach($payingridecost[0] as $totalcostarray){
					$paingamount = isset($totalcostarray['commissioncost'])?$totalcostarray['commissioncost']:0;
				}
			}
			//get user
			//unbind user model
			$this->User->unbindModel(array(
				'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail'),
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
			));
			$result = $this->User->find('first',array('recursive'=>'0','conditions'=>array('User.id'=>$user_id,'User.user_type'=>'1')));
			//pr($result);
			$currentcredit = (isset($result['User']['currentcredit']) && $result['User']['currentcredit']!='')?$result['User']['currentcredit']:0;
			//validate with min amount
			$company_id = (isset($result['User']['company_id']))?$result['User']['company_id']:1;
			$this->siteconfiguration($company_id);
			
			if($currentcredit>0){
				$payingcommisionpercent = (($paingamount/$currentcredit)*100);
			}
			//warning section for buy credit
			if($currentcredit>$this->minimumcreditforride && $currentcredit<=$this->buycreditwarning){
				$creaditwarning='1';
			}
			if($currentcredit < $this->minimumcreditforride){
				$buycreadit='1';
				$creaditwarning='1';
			}
		}
		$returnarray = array('payingcommisionpercent'=>$payingcommisionpercent,'buycreadit'=>$buycreadit,"credit_warning"=>$creaditwarning);
		return $returnarray;
	}
	
	//recharge schems
	public function rechargeschemes(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$user_id = isset($this->request->data['user_id'])?$this->request->data['user_id']:0;
				$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:1;
				//load model
				$this->loadModel("User");
				$schemeDetals = $this->User->query("SELECT * FROM `tc_recharge_schemes` `RechargeScheme` WHERE `RechargeScheme`.`isactive`='1' AND `RechargeScheme`.`company_id`='".$company_id."'");
				$scheamsArr = array();
				if(is_array($schemeDetals)){
					foreach($schemeDetals as $scheme){
						$data = array(
						'id'=>$scheme['RechargeScheme']['id'],
						'amount'=>$scheme['RechargeScheme']['amount'],
						'point'=>$scheme['RechargeScheme']['point']
					);
					array_push($scheamsArr,$data);
					}
				}
				//get user current credit balance
				if(count($scheamsArr)==0){
					array_push($scheamsArr,array());
				}
				die(json_encode(array('status'=>'1','msg'=>'Recharge scheams','scheams'=>$scheamsArr)));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid request')));
	}
	
	public function getlastrideid(){
		$this->loadModel('Ride');
		
		$ride = $this->Ride->find('all',array('order'=>array('Ride.id'=>'DESC')));
		die(json_encode($ride));
	}
	
	
	//get creditcard s type name
	public function cardtypename($cardnumber=''){
		$cardtypename = "Unknown";
		if($cardnumber!=''){
			$pattern_visa = "/^([4]{1})([0-9]{12,15})$/";//Visa
			$pattern_mast = "/^([51|52|53|54|55]{2})([0-9]{14})$/";//Mastercard
			$pattern_disc = "/^([6011]{4})([0-9]{12})$/";//Discover Card
			$pattern_dinc = "/^([30|36|38]{2})([0-9]{12})$/";//Diner's Club
			$pattern_amex = "/^([34|37]{2})([0-9]{13})$/";//American Express
			if(preg_match($pattern_visa,$cardnumber)){
				$cardtypename="visa";
			}
			elseif(preg_match($pattern_mast,$cardnumber)){
				$cardtypename="master";
			}
			elseif(preg_match($pattern_disc,$cardnumber)){
				$cardtypename="discover";
			}
			elseif(preg_match($pattern_dinc,$cardnumber)){
				$cardtypename="dinners";
			}
			elseif(preg_match($pattern_amex,$cardnumber)){
				$cardtypename="amex";
			}
			else{
				
			}
		}
		return $cardtypename;
	}
	
	public function makedefaulcard(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$this->loadModel('UserCreditDetail');
				//$user_id = isset($this->request->data['user_id'])?$this->request->data['user_id']:0;
				$card_id = isset($this->request->data['creditcardid'])?$this->request->data['creditcardid']:0;
				$prvdef = isset($this->request->data['prev_default_card_id'])?$this->request->data['prev_default_card_id']:0;
				$user_id=1;
				if($user_id>0 && $card_id>0){
					$this->UserCreditDetail->unbindModel(array('belongsTo'=>array('User')));
					//$conds=array('UserCreditDetail.user_id'=>$user_id);
					//removed old default card first
					if($prvdef>0){
						$conds=array('UserCreditDetail.id'=>$prvdef);
						$this->UserCreditDetail->updateAll(array('UserCreditDetail.isdefaultcard'=>'0'),$conds);
					}
					
					//now make the selecter id ad default
					$this->UserCreditDetail->unbindModel(array('belongsTo'=>array('User')));
					//$conds['UserCreditDetail.id']=$card_id;
					$conds=array('UserCreditDetail.id'=>$card_id);
					$this->UserCreditDetail->updateAll(array('UserCreditDetail.isdefaultcard'=>'1'),$conds);
					//get user apll cards
					$cards=array();
					//$cards = $this->usercreditcard($user_id);
					die(json_encode(array('status'=>'1','msg'=>'make default successfully','credit_cards'=>$cards)));
				}
				die(json_encode(array('status'=>'0','msg'=>'Invalid Informations')));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
	}
	
	public function makecardarray($cardsarray=array()){
		$cards=array();
		foreach($cardsarray as $card){
			
			$card_id = $card['id'];
			$default = $card['is_active'];
			$cardnolen = strlen($card['credit_card_no']);
			$padstr = substr($card['credit_card_no'],-4);
			$card_display = str_pad( $padstr, $cardnolen-4,"x",STR_PAD_LEFT);
			$card_type = $card['cardtype'];
			$cardtypename = $card['cardtypename'];
			$isdefault = $card['isdefaultcard'];
			$isdeleted = $card['isdeleted'];
			$data=array(
				'card_id'=>$card_id,
				'default'=>$isdefault,
				'card_display'=>$card_display,
				'card_type'=>$card_type,
				'cardtypename'=>$cardtypename,
				'isactive'=>$default
			);
			if(!$isdeleted){
				array_push($cards,$data);	
			}
		}
		return $cards;
	}
	
	//delete the card
	public function removecreditcard(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$this->loadModel('UserCreditDetail');
				//$user_id = isset($this->request->data['user_id'])?$this->request->data['user_id']:0;
				$user_id=1;
				$card_id = isset($this->request->data['creditcardid'])?$this->request->data['creditcardid']:0;
				if($user_id>0 && $card_id>0){
					$this->loadModel('UserCreditDetail');
					$this->UserCreditDetail->unbindModel(array('belongsTo'=>array('User')));
					//$conds=array('UserCreditDetail.user_id'=>$user_id,'UserCreditDetail.id'=>$card_id);
					$conds=array('UserCreditDetail.id'=>$card_id);
					$this->UserCreditDetail->updateAll(array('UserCreditDetail.isdeleted'=>'1'),$conds);
					//get user apll cards
					$cards=array();
					//$cards = $this->usercreditcard($user_id);
					die(json_encode(array('status'=>'1','msg'=>'card deleted successfully','credit_cards'=>$cards)));
				}
				die(json_encode(array('status'=>'0','msg'=>'Invalid Informations')));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
	}
	
	
	public function usercardpayment($card_id=0,$amount=0,$company_id=1){
		$returndata = array();
		if($card_id==0 || $amount==0){
			$returndata=array('status'=>'0','msg'=>'Invalid payment data set','transactionid'=>'0');
		}
		//now load card model
		$this->loadModel('UserCreditDetail');
		//unbind the userfor now
		$this->UserCreditDetail->unbindModel(array('belongsTo'=>array('User')));
		$usercreditdetl = $this->UserCreditDetail->find('first',array('conditions'=>array('UserCreditDetail.id'=>$card_id)));
		if(is_array($usercreditdetl)){
			if(isset($usercreditdetl['UserCreditDetail']) && is_array($usercreditdetl['UserCreditDetail']) && count($usercreditdetl['UserCreditDetail'])>0){
				$cardno = $usercreditdetl['UserCreditDetail']['credit_card_no'];
				$cardcvv = $usercreditdetl['UserCreditDetail']['cvvno'];
				$transactionid = 0;
				$chargestatus = $this->chargecreditcard($cardno,$amount,$company_id);
				if(is_array($chargestatus) && count($chargestatus)>0){
					$transactionid = $chargestatus['transactionid'];
				}
				$returndata=array('status'=>'1','msg'=>'Payment done','transactionid'=>$transactionid);
			}
		}
		return $returndata;
	}
	
	public function schemeenter(){
		header('Content-Type: application/json');
		$scmname = (isset($this->request->data['name']))?$this->request->data['name']:'Taxicel';
		$amount = (isset($this->request->data['amount']))?$this->request->data['amount']:'150';
		$point = (isset($this->request->data['point']))?$this->request->data['point']:'100';
		//load model
		$this->loadModel('User');
		$this->User->query("INSERT INTO `tc_recharge_schemes` (`name`,`amount`,`point`) VALUES ('".$scmname."','".$amount."','".$point."')");
		die(json_encode(array('status'=>'1')));
	}
	
	//work on 20-05-15
	public function nearestdriverdetails(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$user_id = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
				$userlat = (isset($this->request->data['lat']))?$this->request->data['lat']:'0.0';
				$userlon = (isset($this->request->data['lon']))?$this->request->data['lon']:'0.0';
				$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
				if($user_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid User Request')));
				}
				
				//set server variables
				$this->siteconfiguration($company_id);
				//now get the drivers detaild according nearest
				$driverss = $this->getNearestdrivers($userlat,$userlon,$this->driverfindrange,1,0,$company_id);
				//pr($drivers);
				$driverdeatilsss=array();
				if(is_array($driverss) && count($driverss)>0){
					$isnearest=0;
					
					//$drivers = $drivers[0];
					foreach($driverss as $drivers ){
						$driverdeatils=array(
							"duration" => 0,
							"distance" => 0,
							"durationinminit" => 0,
							'dlat'=>'0.0',
							'dlon'=>'0.0',
							'isnearest'=>'0',
							'status'=>'10'
						);
						if($isnearest==0){
							$driverdeatils['isnearest']=1;
							$isnearest=1;
						}
						$driverlat = $drivers['DriverCustom']['lat'];
						$driverlon = $drivers['DriverCustom']['long'];
						//$distanceDuration  = $this->getDistanceAndDuration($userlat,$userlon,$driverlat,$driverlon,$this->googleServerKey);
						//pr($distanceDuration);
						$distanceDuration['status']=0;
						if(isset($distanceDuration['status']) && $distanceDuration['status']==1){
							$driverdeatils = array_slice($distanceDuration,1);
						}
						else{
							$distance = isset($drivers['0']['distance'])?($drivers['0']['distance']/1000):0; //km
							$distance = round($distance);
							$timeneed = (($distance*60)/40); //minute
							$timeneed = round($timeneed);
							
							$driverdeatils['duration']=$timeneed;
							$driverdeatils['distance']=$distance;
							$driverdeatils['durationinminit']=$timeneed;
						}
						//add driver lat lon
						$driverdeatils['dlat']=$driverlat;
						$driverdeatils['dlon']=$driverlon;
						array_push($driverdeatilsss,$driverdeatils);
					}
					
					die(json_encode(array('status'=>'1','msg'=>'driver','driver'=>$driverdeatilsss)));
				}
				else{
					die(json_encode(array('status'=>'0','msg'=>'no driver found','driver'=>$driverdeatilsss)));
				}
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request','driver'=>array())));
	}
	
	// work on 22-05-15
	/*public function cancelride(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$user_id = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
				$ride_id = (isset($this->request->data['ride_id']))?$this->request->data['ride_id']:'0';
				$user_type = (isset($this->request->data['user_type']))?$this->request->data['user_type']:'2';
				if($user_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid User Request')));
				}
				if($ride_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Information')));
				}
				//get ride information and send the notification to the driver or the customer about canceletion
				//load model
				$this->loadModel('Ride');
				//un bind the models
				$this->Ride->unbindModel(array('belongsTo'=>array('City')));
				$this->Ride->User->unbindModel(array(
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
					'hasOne'=>array('DriverCustom','VehicleDetail')
				));
				$this->Ride->Driver->unbindModel(array(
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
					'hasOne'=>array('CustomerCustom','VehicleDetail')
				));
				//$ridecon = array('Ride.id'=>$ride_id,'Ride.status <'=>'3','Ride.payment_option >'=>'0','Ride.card_id >'=>'0');
				$ridecon = array('Ride.id'=>$ride_id,'Ride.status <'=>'3');
				if($user_type==2){
					$ridecon['Ride.user_id']=$user_id;
				}
				else{
					$ridecon['Ride.user_id >']='0';
					$ridecon['Ride.driver_id']=$user_id;
				}
				//pr($ridecon);
				$rDetails = $this->Ride->find('first',array('recursive'=>2,'conditions'=>$ridecon));
				//pr($rDetails);
				if(is_array($rDetails) && count($rDetails)==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid ride')));
				}
				$ride_dispatch_time = $rDetails['Ride']['date_time'];
				$ride_create_time = $rDetails['Ride']['ordercreatetime'];
				$current_date_time = date("Y-m-d G:i");
				$ridetype = $rDetails['Ride']['ride_type'];
				$cancelattioncharge = 0;//in %
				$card_id = $rDetails['Ride']['card_id'];
				//difference 
				//get the cancelation charges of the ride
				$ridecomitionsetting = $this->ridecommitionsetting();
				//pr($ridecomitionsetting);
			
				if(is_array($ridecomitionsetting) && count($ridecomitionsetting)>0){
					//apply charge
					$ridenowcharge = $ridecomitionsetting['ride_now_cancellation_fee']; // in fixed
					$ridelatercharge = $ridecomitionsetting['cancellation_charge']; //in fidex amount
					
					$ridenowtimelimit = $ridecomitionsetting['ride_now_canceled_in']; //in minutes
					$ridelatertimelimit = $ridecomitionsetting['no_fee_before']; //hour
					if($ridetype==0){
						//ride now
						$currenttimestamp = strtotime($current_date_time);
						$ridetimestam = strtotime($ride_create_time);
						if($currenttimestamp>$ridetimestam){
							$different = (($currenttimestamp - $ridetimestam)/60); // in minutes
							if($different > $ridenowtimelimit){
								$cancelattioncharge = $ridenowcharge;
							}
						}
						else{
							//no charge apply
							//$different = (($ridetimestam - $currenttimestamp)/60); // in minutes
						}
					}
					elseif($ridetype==1){
						//ride later
						$currenttimestamp = strtotime($current_date_time);
						$ridetimestam = strtotime($ride_dispatch_time);
						//ride dispath time should be greter
						if($currenttimestamp<$ridetimestam){
							$different = (($ridetimestam - $currenttimestamp)/3600); // in hour
							if($different < $ridelatertimelimit){
								$cancelattioncharge = $ridelatercharge;
							}
						}
						else{
							//should apply charge
							$cancelattioncharge = $ridelatercharge;
						}
					}
					else{
						//do nothing
					}
				}
				//now make payment for the cancelation charge
				if($card_id>0){
					//$chargestatus = $this->chargecreditcard($card_id,$cancelattioncharge);
					$chargestatus = $this->usercardpayment($card_id,$cancelattioncharge);
					$transactionid=0;
					$paymentdone=0;
					if(is_array($chargestatus) && count($chargestatus)>0){
						$transactionid = $chargestatus['transactionid'];
						if($transactionid>0){
							$paymentdone=1;
						}
					}
				}
				else{
					//make payment with users refferal point
					//$refferalamount = (isset($rDetails['User']['currentcredit']))?$rDetails['User']['currentcredit']:0;
					if($cancelattioncharge>0){
						die(json_encode(array('status'=>'0','msg'=>'You Couldnot Cancelled')));
					}
					
				}
				//now update the ride staus and associated fields
				$ridesewtfield = array('Ride.status'=>'5','Ride.transaction_id'=>$transactionid,'Ride.distance_cost'=>$cancelattioncharge,'Ride.paymentdone'=>$paymentdone);
				$this->Ride->updateAll($ridesewtfield,$ridecon);
				//now send the notification to the corrospond user
				$pushid='';
				$devicetype=0;
				$googlepushsendkey='';
				//load site config settinf
				$this->siteconfiguration();
				if($user_type==2){
					//notify to the driver
					if(isset($rDetails['Driver']['DriverCustome']) && count($rDetails['Driver']['DriverCustome'])>0){
						$pushid = $rDetails['Driver']['DriverCustome']['device_unique_id'];
						$googlepushsendkey = $this->DriverAppkey;
						$devicetype = $rDetails['Driver']['DriverCustome']['device_type'];
					}
				}
				else{
					//notify to the customer
					if(isset($rDetails['User']['CustomerCustome']) && count($rDetails['User']['CustomerCustome'])>0){
						$pushid = $rDetails['User']['CustomerCustome']['device_unique_id'];
						$googlepushsendkey = $this->CustomerAppkey;
						$devicetype = $rDetails['User']['CustomerCustome']['device_type'];
					}
				}
				
				$cancelattioncharge = '$'.number_format($cancelattioncharge,2);
				$textmsg = "Ride Cancel";
				$custom = array( 
					'cancel_cost'=>$cancelattioncharge,
					'ride_id'=> $ride_id,
					'text'=>$textmsg
				);
				//now send the push
				if($devicetype==1){
					if($pushid!='' && $googlepushsendkey!=''){
						$registration_ids = array($pushid);
						$this->appandroidpushnotify($registration_ids,$googlepushsendkey,$textmsg,$custom);
					}
				}
				else{
					//do nothing
				}
				
				die(json_encode(array('status'=>'1','msg'=>'Cancelation succeful','cancelcharge'=>$cancelattioncharge)));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
	}*/
	
	public function cancelride(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$user_id = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
				$ride_id = (isset($this->request->data['ride_id']))?$this->request->data['ride_id']:'0';
				$user_type = (isset($this->request->data['user_type']))?$this->request->data['user_type']:'2';
				$cancelreson = (isset($this->request->data['reason_ride_cancellation']))?$this->request->data['reason_ride_cancellation']:'';//reason_ride_cancellation
				$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
				if($user_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid User Request')));
				}
				if($ride_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Information')));
				}
				//get ride information and send the notification to the driver or the customer about canceletion
				//load model
				$this->loadModel('Ride');
				//un bind the models
				$this->Ride->unbindModel(array('belongsTo'=>array('City')));
				$this->Ride->User->unbindModel(array(
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
					'hasOne'=>array('DriverCustom','VehicleDetail')
				));
				$this->Ride->Driver->unbindModel(array(
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
					'hasOne'=>array('CustomerCustom','VehicleDetail')
				));
				//$ridecon = array('Ride.id'=>$ride_id,'Ride.status <'=>'3','Ride.payment_option >'=>'0','Ride.card_id >'=>'0');
				$ridecon = array('Ride.id'=>$ride_id,'Ride.status <'=>'3');
				if($user_type==2){
					$ridecon['Ride.user_id']=$user_id;
				}
				else{
					$ridecon['Ride.user_id >']='0';
					$ridecon['Ride.driver_id']=$user_id;
				}
				//pr($ridecon);
				$rDetails = $this->Ride->find('first',array('recursive'=>2,'conditions'=>$ridecon));
				//pr($rDetails);
				if(is_array($rDetails) && count($rDetails)==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid ride')));
				}
				$ride_dispatch_time = $rDetails['Ride']['date_time'];
				$ride_create_time = $rDetails['Ride']['ordercreatetime'];
				$current_date_time = date("Y-m-d G:i");
				$ridetype = $rDetails['Ride']['ride_type'];
				$cancelattioncharge = 0;//in %
				$card_id = $rDetails['Ride']['card_id'];
				//difference 
				//get the cancelation charges of the ride
				$ridecomitionsetting = $this->ridecommitionsetting($company_id);
				//pr($ridecomitionsetting);
			
				if(is_array($ridecomitionsetting) && count($ridecomitionsetting)>0){
					//apply charge
					$ridenowcharge = $ridecomitionsetting['ride_now_cancellation_fee']; // in fixed
					$ridelatercharge = $ridecomitionsetting['cancellation_charge']; //in fidex amount
					
					$ridenowtimelimit = $ridecomitionsetting['ride_now_canceled_in']; //in minutes
					$ridelatertimelimit = $ridecomitionsetting['no_fee_before']; //hour
					if($ridetype==0){
						//ride now
						$currenttimestamp = strtotime($current_date_time);
						$ridetimestam = strtotime($ride_create_time);
						if($currenttimestamp>$ridetimestam){
							$different = (($currenttimestamp - $ridetimestam)/60); // in minutes
							if($different > $ridenowtimelimit){
								$cancelattioncharge = $ridenowcharge;
							}
						}
						else{
							//no charge apply
							//$different = (($ridetimestam - $currenttimestamp)/60); // in minutes
						}
					}
					elseif($ridetype==1){
						//ride later
						$currenttimestamp = strtotime($current_date_time);
						$ridetimestam = strtotime($ride_dispatch_time);
						//ride dispath time should be greter
						if($currenttimestamp<$ridetimestam){
							$different = (($ridetimestam - $currenttimestamp)/3600); // in hour
							if($different < $ridelatertimelimit){
								$cancelattioncharge = $ridelatercharge;
							}
						}
						else{
							//should apply charge
							$cancelattioncharge = $ridelatercharge;
						}
					}
					else{
						//do nothing
					}
				}
				//now make payment for the cancelation charge
				//$chargestatus = $this->chargecreditcard($card_id,$cancelattioncharge);
				$chargestatus = $this->usercardpayment($card_id,$cancelattioncharge,$company_id);
				$transactionid=0;
				$paymentdone=0;
				if(is_array($chargestatus) && count($chargestatus)>0){
					$transactionid = $chargestatus['transactionid'];
					if($transactionid>0){
						$paymentdone=1;
					}
				}
				//now update the ride staus and associated fields
				$ridesewtfield = array('Ride.status'=>'5','Ride.transaction_id'=>$transactionid,'Ride.distance_cost'=>$cancelattioncharge,'Ride.paymentdone'=>$paymentdone,'Ride.cancelreason'=>'"'.$cancelreson.'"');
				$this->Ride->updateAll($ridesewtfield,$ridecon);
				//now send the notification to the corrospond user
				$pushid='';
				$devicetype=0;
				$googlepushsendkey='';
				//load site config settinf
				$this->siteconfiguration($company_id);
				if($user_type==2){
					//notify to the driver
					if(isset($rDetails['Driver']['DriverCustom']) && count($rDetails['Driver']['DriverCustom'])>0){
						$pushid = $rDetails['Driver']['DriverCustom']['device_unique_id'];
						$googlepushsendkey = $this->DriverAppkey;
						$devicetype = $rDetails['Driver']['DriverCustom']['device_type'];
					}
				}
				else{
					//notify to the customer
					if(isset($rDetails['User']['CustomerCustom']) && count($rDetails['User']['CustomerCustom'])>0){
						$pushid = $rDetails['User']['CustomerCustom']['device_unique_id'];
						$googlepushsendkey = $this->CustomerAppkey;
						$devicetype = $rDetails['User']['CustomerCustom']['device_type'];
					}
				}
				
				$cancelattioncharge = '$'.number_format($cancelattioncharge,2);
				$textmsg = "Ride Cancel";
				$custom = array( 
					'cancel_cost'=>$cancelattioncharge,
					'ride_id'=> $ride_id,
					'text'=>$textmsg,
					'status'=>5
				);
				//now send the push
				if($devicetype==1){
					if($pushid!='' && $googlepushsendkey!=''){
						$registration_ids = array($pushid);
						$this->appandroidpushnotify($registration_ids,$googlepushsendkey,$textmsg,$custom,1);
					}
				}
				elseif($devicetype==2){
					if($pushid!=''){
						$this->iospushnotification($pushid,$textmsg,$custom,1,1,$company_id);
					}
				}
				else{
					//do nothing
				}
				
				die(json_encode(array('status'=>'1','msg'=>'Cancelation succeful','cancelcharge'=>$cancelattioncharge)));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
	}
	
	
	/**
	 * reject_order
	 */
	public function rejectorder(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			$this->write_log($this->request->data);
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$driver_id = (isset($this->request->data['driver_id']) && $this->request->data['driver_id']>0)?$this->request->data['driver_id']:0;
				$ride_id = (isset($this->request->data['ride_id']))?$this->request->data['ride_id']:'0';
				$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
				if($driver_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid User Request')));
				}
				if($ride_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Information')));
				}
				//load model
				$this->loadModel('Ride');
				//unbind model
				$this->Ride->unbindModel(array('belongsTo'=>array('Driver','City')));
				$this->Ride->User->unbindModel(array(
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
					'hasOne'=>array('DriverCustom','VehicleDetail')
				));
				$this->Ride->Driver->unbindModel(array(
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
					'hasOne'=>array('CustomerCustom','VehicleDetail')
				));
				
				$rDetails = $this->Ride->find('first',array('recursive'=>'2','conditions'=>array('Ride.id'=>$ride_id,'Ride.user_id >'=>'0','Ride.driver_id'=>'0','Ride.status'=>'0')));
				//pr($rDetails);
				if(is_array($rDetails) && count($rDetails)==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Informations')));
				}
				//now get the next nearest driver and send the notification of new ride
				//basic ride info
				$pick_up_lat = $rDetails['Ride']['pick_lat'];
				$pick_up_lon = $rDetails['Ride']['pick_long'];
				$pick_up = $rDetails['Ride']['pick_up'];
				$drop_off = $rDetails['Ride']['drop_off'];
				$street_address=$rDetails['Ride']['street_address'];
				$nearby_address = $rDetails['Ride']['nearby_address'];
				
				$user_id = $rDetails['Ride']['user_id'];
				//now get user details
				$userName='';
				$userMobileNo='';
				$userPic='';
				$customerpushid='';
				$customerdevicetype=0;
				if(is_array($rDetails['User']) && count($rDetails['User'])>0){
					$userName = ucwords($rDetails['User']['f_name'].' '.$rDetails['User']['l_name']);
					$userMobileNo = $rDetails['User']['mobile'];
					if(isset($rDetails['User']['CustomerCustom']['id'])){
						if( $rDetails['User']['CustomerCustom']['user_image']!=''){
							$userPic=FULL_BASE_URL.$this->base."/userPic/".$rDetails['User']['CustomerCustom']['user_image'];
						}
						if($rDetails['User']['CustomerCustom']['device_type']!=''){
							$customerdevicetype = $rDetails['User']['CustomerCustom']['device_type'];
						}
						if($rDetails['User']['CustomerCustom']['device_unique_id']!=''){
							$customerpushid = $rDetails['User']['CustomerCustom']['device_unique_id'];
						}
					}
					
				}
				//ride now and ride later
				$innoredrier = $driver_id;
				$estTime = "0 Min";
				$this->siteconfiguration($company_id);
				
				$dDetails = $this->getNearestdrivers($pick_up_lat, $pick_up_lon,$this->driverfindrange,0,$innoredrier);
				// Searching for the nearest driver online
				$devicetype = 0;
				if(is_array($dDetails) && count($dDetails)>0){
					$driver = $dDetails['0'];
					//find estimation time beetween driver and the user
					$driverlat = $driver['DriverCustom']['lat'];
					$driverlon = $driver['DriverCustom']['long'];
					$devicetype = $driver['DriverCustom']['device_type'];
					$pushid = $driver['DriverCustom']['device_unique_id'];
					if($pushid!=''){
						$distanceDuration  = $this->getDistanceAndDuration($pick_up_lat,$pick_up_lon,$driverlat,$driverlon,$this->googleServerKey);
						//pr($distanceDuration);
						if(isset($distanceDuration['status']) && $distanceDuration['status']==1){
							$driverdeatils = array_slice($distanceDuration,1);
						}
						else{
							$distance = isset($driver['0']['distance'])?($driver['0']['distance']/1000):0; //km
							$distance = round($distance);
							$timeneed = (($distance*60)/40); //minute
							$timeneed = round($timeneed);
							
							$driverdeatils['duration']=$timeneed;
							$driverdeatils['distance']=$distance;
							$driverdeatils['durationinminit']=$timeneed;
						}
						
						//pr($driverdeatils);
						
						$estTime = $driverdeatils['durationinminit'];
						//push sending logic
						//get user rating
						$rating = $this->userrattingsection($user_id,2);
						//send  notifications custome data
						$textmsg = "New ride alloted";
						$custom = array( 
							'estTime'=>$estTime,
							'c_name'=>$userName,
							'c_rating'=>$rating,
							'c_address'=>$pick_up,
							'c_lat'=>$pick_up_lat,
							'c_long'=>$pick_up_lon,
							'c_mobile'=>$userMobileNo,
							'c_dropaddress'=>$drop_off,
							'c_pic'=>$userPic,
							'ride_id'=> $ride_id,
							'text'=>$textmsg,
							'street_address'=>$street_address,
							'nearby_address'=>$nearby_address,
							'status'=>'0'
						);
						//pr($custom);
						if($devicetype=='1'){
							$registration_ids = array($pushid);
							$this->appandroidpushnotify($registration_ids,$this->DriverAppkey,$textmsg,$custom);
						}
						elseif($devicetype=='2'){
							$this->iospushnotification($pushid,$textmsg,$custom,1,1,$company_id);
						}
						else{
							//device type two
						}
					}
					die(json_encode(array('status'=>'1','msg'=>'driver found')));
				}
				else{
					//no driver found
					//send notification to the customer about no driver found
					if($customerpushid!=''){
						$textmsg = "Your Recent Ride can not completed. please try again.";
						$customeArray = array(
							'text'=>$textmsg,
							'status'=>6
						);
						if($customerdevicetype==1){
							// android push
							$registration_ids = array($customerpushid);
							$this->appandroidpushnotify($registration_ids,$this->CustomerAppkey,$textmsg,$customeArray,1);
						}
						elseif($customerdevicetype==2){
							$this->iospushnotification($customerpushid,$textmsg,$customeArray,1,2,$company_id);
						}
						else{
							//do nothing
						}
						die(json_encode(array('status'=>'1','msg'=>'no more driver push send')));
					}
					die(json_encode(array('status'=>'1','msg'=>'no more driver')));
				}
				
			}
			die(json_encode(array('status'=>'1','msg'=>'Invalid Device type')));
		}
		die(json_encode(array('status'=>'1','msg'=>'Invalid Request')));
	}
	
	public function drivervehicles(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			//$this->write_log($this->request->data);
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$driver_id = (isset($this->request->data['driver_id']) && $this->request->data['driver_id']>0)?$this->request->data['driver_id']:0;
				if($driver_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid User Request')));
				}
				$vehicles = $this->driverallvehicles($driver_id);
				die(json_encode(array('status'=>'1','msg'=>'Your vehicles','vehicles'=>$vehicles)));
			}
		}
		die(json_encode(array('status'=>'1','msg'=>'Invalid Request')));
	}
	
	public function driverallvehicles($driver_id=0){
		$vehicles = array();
		if($driver_id>0){
			//load driver vehicle module
			$this->loadModel('VehicleDetail');
			//unbind models
			$this->VehicleDetail->unbindModel(array('belongsTo'=>array('User')));
			$conditions = array('VehicleDetail.user_id'=>$driver_id,'VehicleDetail.isapproved'=>'1','VehicleDetail.car_id >'=>'0');
			$driverVehicles = $this->VehicleDetail->find('all',array('recursive'=>'0','conditions'=>$conditions));
			//pr($driverVehicles);
			if(is_array($driverVehicles) && count($driverVehicles)>0){
				foreach($driverVehicles as $driverVehicle){
					//pr($driverVehicle);
					$id=$driverVehicle['VehicleDetail']['id'];
					$isdefalt=$driverVehicle['VehicleDetail']['isdefault'];
					$manufactureing_date=$driverVehicle['VehicleDetail']['manufactureing_date'];
					$vehiclenumber = $driverVehicle['VehicleDetail']['vehicle_no'];
					$vehiclemodel = '';
					$vehiclecar=$driverVehicle['Car']['name'];
					if(isset($driverVehicle['CarModel']['name'])){
						$vehiclemodel = $driverVehicle['CarModel']['name'];
					}
					//set the value tothe appropriat param
					
					$data = array(
						'vhcleid'=>$id,
						'number'=>$vehiclenumber,
						'model'=>$vehiclemodel,
						'car'=>$vehiclecar,
						'mfdate'=>$manufactureing_date,
						'isdefault'=>$isdefalt
					);
					array_push($vehicles,$data);
				}
			}
		}
		return $vehicles;
	}
	
	public function makedefaultcar(){
		header('Content-Type: application/json');
		if($this->request->is('post')){
			if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
				$driver_id = (isset($this->request->data['driver_id']) && $this->request->data['driver_id']>0)?$this->request->data['driver_id']:0;
				$vhcleid = (isset($this->request->data['vhcleid']) && $this->request->data['vhcleid']>0)?$this->request->data['vhcleid']:0;
				if($driver_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid User Request')));
				}
				if($vhcleid==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid Vehicle Request')));
				}
				//load model
				$this->loadModel('VehicleDetail');
				//unbind models
				$this->VehicleDetail->unbindModel(array('belongsTo'=>array('User','Car')));
				$condition = array('VehicleDetail.user_id'=>$driver_id,'VehicleDetail.isdefault'=>'1');
				$this->VehicleDetail->updateAll(array('VehicleDetail.isdefault'=>'0'),$condition);
				//now make default current vehicles
				$this->VehicleDetail->unbindModel(array('belongsTo'=>array('User','Car')));
				$condition = array('VehicleDetail.user_id'=>$driver_id,'VehicleDetail.isdefault'=>'0','VehicleDetail.id'=>$vhcleid);
				$this->VehicleDetail->updateAll(array('VehicleDetail.isdefault'=>'1'),$condition);
				//update the driver custom data with selected device
				$this->VehicleDetail->User->DriverCustom->unbindModel(array('belongsTo'=>array('User','City')));
				$this->VehicleDetail->User->DriverCustom->updateAll(array('DriverCustom.vehicle_detail_id'=>$vhcleid),array('DriverCustom.user_id'=>$driver_id));
				die(json_encode(array('status'=>'1','msg'=>'Your vehicles set as default')));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
	}
	
	//new change on 04-06-15
	// get user details
	public function userbasicdetails(){
		header('Content-Type: application/json');
		$this->loadModel('User');
		if(!$this->request->is('post')){
			die(json_encode(array('status'=>'0','msg'=>'Invalid request')));	
		}
		if(isset($this->request->data['device_type']) && $this->request->data['device_type']>0){
			$user_id = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
			$user_type = (isset($this->request->data['user_type']) && $this->request->data['user_type']>0)?$this->request->data['user_type']:0;
			$ride_id = (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0)?$this->request->data['ride_id']:0;
			$device_unique_id	= isset($this->request->data['device_unique_id'])?$this->request->data['device_unique_id']:'';
			$lat			= isset($this->request->data['lat'])?$this->request->data['lat']:'';
			$lon			= isset($this->request->data['lon'])?$this->request->data['lon']:'';
			$device_type		=$this->request->data['device_type'];
			$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
			//driver secton
			$licensedoc=array('docpath'=>'','expdate'=>'');
			$insurancedoc=array('docpath'=>'','expdate'=>'');
			$authdoc=array('docpath'=>'','expdate'=>'');
			$operatordoc=array('docpath'=>'','expdate'=>'');
			$payingcommisionpercent = 0;
			
			if($user_type==2){
				//customer
				//unbind the model
				$this->User->unbindModel(array(
					'hasMany'=>array('DriverRide','CustomerRide','UserCreditDetail'),
					'hasOne'=>array('DriverCustom','VehicleDetail')
				));
			}
			elseif($user_type==1){
				//driver
				//bind model
				$this->User->bindModel(array(
					'hasOne'=>array(
						'DriverDocument'=>array(
							'className' => 'DriverDocument',
							'foreignKey' => 'user_id',
						)
					)
				));
				//unbind models
				$this->User->unbindModel(
					array(
						'hasOne'=>array('CustomerCustom','VehicleDetail'),
						'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
					)
				);
			}
			else{
				die(json_encode(array('status'=>'0','msg'=>'Invalid User type request')));
			}
			
			$result = $this->User->find('first',array(
				'conditions'=>array('User.id'=>$user_id,'User.user_type'=>$user_type)
			));
			//pr($result);
			if( $result ){
				$userPic ='';
				$rating=0;
				//update users current credit value 
				$this->updateusercurrentearning($user_id);
				// Updating customer location
				if($user_type==2){
					//validate if not set any how
					//validate if custome set or not in signup processes
					if(isset($result['CustomerCustom']['id'])){
						$this->User->CustomerCustom->updateAll(
							array('CustomerCustom.device_unique_id'=>"'".$device_unique_id."'", 'CustomerCustom.lat'=>"'".$lat."'", 'CustomerCustom.long'=>"'".$lon."'",'CustomerCustom.device_type'=>"'".$device_type."'"),
							array( 'CustomerCustom.user_id' => $user_id )
						);	
					}
					else{
						$custome = array(
							'CustomerCustom'=>array(
								'user_id'=>$user_id,
								'device_unique_id'=>$device_unique_id,
								'lat'=>$lat,
								'long'=>$lon,
								'device_type'=>$device_type
								)
							);
						$this->User->CustomerCustom->save($custome);
					}
					if(isset($result['CustomerCustom']['user_image']) && $result['CustomerCustom']['user_image']!=''){
						$userPic = FULL_BASE_URL.$this->base."/userPic/".$result['CustomerCustom']['user_image'];
					}
					$rating = $this->userrattingsection($user_id,2);
				}
				if($user_type==1){
					//validate if not custom set
					if(isset($result['DriverCustom']['id'])){
						$this->User->DriverCustom->updateAll(array('DriverCustom.device_unique_id'=>"'".$device_unique_id."'", 'DriverCustom.lat'=>"'".$lat."'", 'DriverCustom.long'=>"'".$lon."'",'DriverCustom.device_type'=>"'".$device_type."'"),
									       array( 'DriverCustom.user_id' => $user_id ));
					}
					else{
						//create record
						$custome = array(
							'DriverCustom'=>array(
								'user_id'=>$user_id,
								'device_unique_id'=>$device_unique_id,
								'lat'=>$lat,
								'long'=>$lon,
								'device_type'=>$device_type
								)
							);
						$this->User->DriverCustom->save($custome);
					}
					//driver update
					
					if(isset($result['DriverCustom']['user_pic']) && $result['DriverCustom']['user_pic']!=''){
						$userPic = FULL_BASE_URL.$this->base."/userPic/".$result['DriverCustom']['user_pic'];
					}
					$drSatatus = (isset($result['DriverCustom']['status']))?$result['DriverCustom']['status']:0;
					$rating = $this->userrattingsection($user_id,1);
					//driver doc details
					if(isset($result['DriverDocument'])){
						$baseflpath = FULL_BASE_URL.$this->base."/userDoc/";
						// insurance
						if(isset($result['DriverDocument']['filename']) && $result['DriverDocument']['filename']!=''){
							$insurancedoc=array(
								'docpath'=>$baseflpath.$result['DriverDocument']['filename'],
								'expdate'=>$result['DriverDocument']['expiry_date']
							);	
						}
						// authorization doc
						if(isset($result['DriverDocument']['filename_auth']) && $result['DriverDocument']['filename_auth']!=''){
							$authdoc=array(
								'docpath'=>$baseflpath.$result['DriverDocument']['filename_auth'],
								'expdate'=>$result['DriverDocument']['expiry_date_auth']
							);	
						}
						// license doc
						if(isset($result['DriverDocument']['filename_lic']) && $result['DriverDocument']['filename_lic']!=''){
							$licensedoc=array(
								'docpath'=>$baseflpath.$result['DriverDocument']['filename_lic'],
								'expdate'=>$result['DriverDocument']['expiry_date_lic']
							);	
						}
						// vehicle operator doc
						if(isset($result['DriverDocument']['filename_oper']) && $result['DriverDocument']['filename_oper']!=''){
							$operatordoc=array(
								'docpath'=>$baseflpath.$result['DriverDocument']['filename_oper'],
								'expdate'=>$result['DriverDocument']['expiry_date_oper']
							);	
						}
					}
					//user current status of creadit after recharge
					$usercreditperandbuycredit = $this->getpayingpercentageandbuycredit($user_id);
					$payingcommisionpercent = $usercreditperandbuycredit['payingcommisionpercent'];
					$buycreadit = $usercreditperandbuycredit['buycreadit'];
					$credit_warning = $usercreditperandbuycredit['credit_warning'];
					//get driver vesicles list
					$vehicles = $this->driverallvehicles($user_id);
				}
				//card details
				$credit_cards = $this->usercreditcard($user_id);
				//get user ratting
				$data = array(
					'user_id'=>$user_id,
					'f_name'=>$result['User']['f_name'],
					'l_name'=>$result['User']['l_name'],
					'email'=>$result['User']['email'],
					'mobile'=>$result['User']['mobile'],
					'profile_img'=>$userPic,
					'refferal_code'=>$result['User']['my_refferal_code'],
					'credit_cards'=>$credit_cards,
					'rating'=>$rating
				);
				
				if($user_type==1){
					$data['insurance_doc']=$insurancedoc;
					$data['authority_card_doc']=$authdoc;
					$data['license_doc']=$licensedoc;
					$data['vehicle_operator_doc']=$operatordoc;
					$data['payingcommisionpercent']=$payingcommisionpercent;
					$data['buycreadit']=$buycreadit;
					$data['credit_warning']=$credit_warning;
					$data['vehicles']=$vehicles;
					$data['status']=$drSatatus;
				}
				
				//if ride id present then get the ride status
				$custom = $this->usercurrentrideinformation($user_id,$ride_id,$user_type,$company_id);
				//add this param to the retun ogject
				if(is_array($custom) && count($custom)>0){
					$data['ride']=$custom;
				}
				//get site confic function
				$congiggallery = $this->configurationall();
				die(json_encode(array('data'=>$data,'status'=>'1','msg'=>'userdetails.','siteconfig'=>$congiggallery)));
			}else{
				die(json_encode(array('status'=>'0','msg'=>'Invalid User Info.')));
			}
		}else{
			//error message
			die(json_encode(array('status'=>'0','msg'=>'Device type parameter is missing, please try again.')));
		}
	}
	//edited on 18-07-2015
	public function updateusercurrentearning($user_id=0){
		if($user_id>0){
			$this->loadModel('UserRideCommition');
			$selquery = "SELECT sum(UserRideCommition.`amount`) `amount` FROM `tc_user_ride_commitions` UserRideCommition WHERE UserRideCommition.`credit_debit`='1' AND UserRideCommition.`user_id`='".$user_id."'";
			$resEarning = $this->UserRideCommition->query($selquery);
			//pr($resEarning);
			$earningamount=0;
			$payingamount=0;
			if(isset($resEarning['0']) && is_array($resEarning['0']) && count($resEarning['0'])>0){
				foreach($resEarning['0'] as $earn){
					$earningamount+=$earn['amount'];
				}
			}
			//buy credit
			$selquery = "SELECT sum(UserRideCommition.`amount`) `amount` FROM `tc_user_ride_commitions` UserRideCommition WHERE UserRideCommition.`credit_debit`='2' AND UserRideCommition.`user_id`='".$user_id."'";
			$resPaying = $this->UserRideCommition->query($selquery);
			//pr($resPaying);
			if(isset($resPaying['0']) && is_array($resPaying['0']) && count($resPaying['0'])>0){
				foreach($resPaying['0'] as $earn){
					$payingamount+=$earn['amount'];
				}
			}
			//now update the user current income
			$currentcredit = $earningamount-$payingamount;
			$this->UserRideCommition->query("UPDATE `tc_users` SET `tc_users`.`currentcredit`='".$currentcredit."' WHERE `tc_users`.`id`='".$user_id."'");
			//die(json_encode(array('earn'=>$earningamount,'buy'=>$payingamount)));
		}
	}
	//change on 12-06-15
	public function ridecurrentstatus(){
		header('Content-type:application/json');
		if($this->request->is('post')){
			$user_id = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
			$user_type = (isset($this->request->data['user_type']) && $this->request->data['user_type']>0)?$this->request->data['user_type']:0;
			$ride_id = (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0)?$this->request->data['ride_id']:0;
			$device_unique_id	= isset($this->request->data['device_unique_id'])?$this->request->data['device_unique_id']:'';
			$lat			= isset($this->request->data['lat'])?$this->request->data['lat']:'';
			$lon			= isset($this->request->data['lon'])?$this->request->data['lon']:'';
			$device_type		= (isset($this->request->data['device_type']) && $this->request->data['device_type']>0)?$this->request->data['device_type']:0;
			$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
			if($device_type==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid Device Request')));
			}
			if($user_id==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid User Request')));
			}
			if(!in_array( $user_type,array(1,2))){
				die(json_encode(array('status'=>'0','msg'=>'Invalid User Type Request')));
			}
			if($ride_id==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Request')));
			}
			//get user ride current status
			$custom = $this->usercurrentrideinformation($user_id,$ride_id,$user_type,$company_id);
			//retun the custome values
			if(is_array($custom) && count($custom)>0){
				die(json_encode(array('status'=>'1','msg'=>'Ride Current Info','coustom'=>$custom)));
			}
			else{
				die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Info Status')));
			}
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
	}
	
	//edit on 15/06/15
	public function usercurrentrideinformation($user_id=0,$ride_id=0,$user_type=0,$company_id=1){
		$custom = array();
		if($user_id==0 || $ride_id==0 || $user_type==0){
			return $custom;
		}else{
			//now load the model ride
			$this->loadModel('Ride');
			//now bind and unbind the ride model
			$this->Ride->unbindModel(array('belongsTo'=>array('City')));
			//unbind user model
			$this->Ride->User->unbindModel(array(
				'hasMany'=>array('DriverRide','CustomerRide','UserCreditDetail'),
				'hasOne'=>array('DriverCustom','VehicleDetail')
			));
			//unbind driver model
			$this->Ride->Driver->unbindModel(array(
				'hasMany'=>array('DriverRide','CustomerRide','UserCreditDetail'),
				'hasOne'=>array('CustomerCustom','VehicleDetail')
			));
			//condition of the
			$ridecondition = array('Ride.id'=>$ride_id,'Ride.status'=>array(1,2,3,4));
			if($user_type==1){
				//driver
				$ridecondition['Ride.driver_id']=$user_id;
				$ridecondition['Ride.user_id >']='0';
			}
			if($user_type==2){
				//user customer
				$ridecondition['Ride.user_id']=$user_id;
				$ridecondition['Ride.driver_id >']='0';
			}
			//pr($ridecondition);
			
			$rDetails = $this->Ride->find('first',array('recursive'=>'2','conditions'=>$ridecondition));
			//pr($rDetails);
			if(is_array($rDetails) && count($rDetails)==0){
				//die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Data Request')));
				return $custom;
			}
			//after get valid ride info formate the return arra
			$ridestatus = $rDetails['Ride']['status'];
			$pickuplat = $rDetails['Ride']['pick_lat'];
			$pickuplon = $rDetails["Ride"]['pick_long'];
			$pickup = $rDetails["Ride"]['pick_up'];
			$driver_id = $rDetails['Ride']['driver_id'];
			$drop_off = $rDetails["Ride"]['drop_off'];
			$customer_id = $rDetails["Ride"]['user_id'];
			$street_address = $rDetails["Ride"]['street_address'];
			$nearby_address = $rDetails["Ride"]['nearby_address'];
			//new variable
			$dropofflat=$rDetails["Ride"]['drop_lat'];
			$dropofflon=$rDetails["Ride"]['drop_long'];
			$text = "";
			switch($ridestatus){
				case 1:
					$text="Ride has been accepted.";
					break;
				case 2:
					$text="Driver is arriving.";
					break;
				case 3:
					$text="Trip Started";
					break;
				case 4:
					$text="Trip Ended";
					break;
				default:
					$text="";
					break;
			}
			//commone variable
			$referral_allowed=1;
			$customercommision="0";
			$companyname = "";
			$driverimg='';
			$drivername = '';
			$drivermobileno = '';
			//lat long of the user and the driver
			$ulat="";
			$ulon="";
			$dlat="";
			$dlon="";
			$vehicleid ="0";
			$customername="";
			$customerpic="";
			$customermobile="";
			
			//user
			if(isset($rDetails['User']['CustomerCustom']) && count($rDetails['User']['CustomerCustom'])>0){
				$ulat = $rDetails['User']['CustomerCustom']['lat'];
				$ulon = $rDetails['User']['CustomerCustom']['long'];
				if($rDetails['User']['CustomerCustom']['user_image']!=''){
					$customerpic = FULL_BASE_URL.$this->base."/userPic/thumb_".$rDetails['User']['CustomerCustom']['user_image'];
				}
			}
			//driver
			if(isset($rDetails['Driver']['DriverCustom']) && count($rDetails['Driver']['DriverCustom'])>0){
				$dlat = $rDetails['Driver']['DriverCustom']['lat'];
				$dlon = $rDetails['Driver']['DriverCustom']['long'];
				$vehicleid = $rDetails['Driver']['DriverCustom']['vehicle_detail_id'];
				$companyname = $rDetails['Driver']['DriverCustom']['company_name'];
				if($rDetails['Driver']['DriverCustom']['user_pic']!=''){
					$driverimg = FULL_BASE_URL.$this->base."/userPic/thumb_".$rDetails['Driver']['DriverCustom']['user_pic'];
				}
			}
			//driver details
			if(isset($rDetails['Driver']) && is_array($rDetails['Driver']) && count($rDetails['Driver'])>0){
				$drivername = ucwords($rDetails['Driver']['f_name']." ".$rDetails['Driver']['l_name']);
				$drivermobileno = $rDetails['Driver']['mobile'];
			}
			//user details
			if(isset($rDetails['User']) && is_array($rDetails['User']) && count($rDetails['User'])>0){
				$customername = ucwords($rDetails['User']['f_name']." ".$rDetails['User']['l_name']);
				$customermobile = $rDetails['User']['mobile'];
			}
			
			if($user_type==2){
				//customers push data formate set from here
				if($ridestatus==4){
					//find the commition wha he get
					$query = "SELECT * FROM `tc_user_ride_commitions` UserRideCimmitions WHERE `user_id`='".$user_id."' AND `ride_id`='".$ride_id."'";
					$rideCommition = $this->Ride->query($query);
					//pr($rideCommition);
					if(is_array($rideCommition) && count($rideCommition)>0){
						$rideCommition = $rideCommition['0'];
						$customercommision = (isset($rideCommition['UserRideCimmitions']['amount']))?$rideCommition['UserRideCimmitions']['amount']:0;
					}
					//formate basic custom data
					$adjusted_cost = number_format(($rDetails['Ride']['distance_cost'] - $rDetails['Ride']['discount']),2,'.','');
					$custom = array( 
						'text'=> $text,
						'dlat'=>$dlat,
						'dlon'=> $dlon,
						'cost'=> "$".$rDetails['Ride']['distance_cost'],
						'cupon_code'=>$rDetails['Ride']['cupon_code'],
						'discount'=>$rDetails['Ride']['discount'],
						'adjusted_cost'=>$adjusted_cost,
						'referral_allowed'=>$referral_allowed,
						'status'=> 4,
						'ride_id'=>$ride_id,
						'ref_commision' => $customercommision
					);
				}
				else{
					//car basic info
					$vhcmanufacdate = "2003";
					$vhcplateno = 'UN02 2312';
					$vhcname = 'Ferrari';
					$vhcmodelname = 'Ambassador';
					if($rDetails['Ride']['vehicleinfo']!=''){
						$vehiclDtl = explode(" ",$rDetails['Ride']['vehicleinfo']);
						if(is_array($vehiclDtl) && count($vehiclDtl)>1){
							$vhcname = isset($vehiclDtl[0])?$vehiclDtl[0]:'';
							$vhcmodelname = isset($vehiclDtl[1])?$vehiclDtl[1]:'';
							$vhcmanufacdate = isset($vehiclDtl[2])?$vehiclDtl[2]:'';
							$vhcplateno = isset($vehiclDtl[3])?$vehiclDtl[3]:'';
						}
					}
					else{
						// get drier vehicled details
						$vehiclecon = array('VehicleDetail.user_id'=>$driver_id);
						$this->Ride->Driver->VehicleDetail->unbindModel(array('belongsTo'=>array('User')));
						$selectedVehicle = $this->Ride->Driver->VehicleDetail->find('first',array('conditions'=>$vehiclecon,'order'=>array('VehicleDetail.isdefault'=>'DESC','VehicleDetail.id'=>'DESC'),'limit'=>'1'));
						//pr($selectedVehicle);
						if(is_array($selectedVehicle) && count($selectedVehicle)>0){
							//$vehicleid = $selectedVehicle['VehicleDetail']['id'];
							$vhcmanufacdate = date("Y",strtotime($selectedVehicle['VehicleDetail']['manufactureing_date']));
							$vhcmodelname =  isset($selectedVehicle['CarModel']['name'])?$selectedVehicle['CarModel']['name']:'';
							$vhcplateno = $selectedVehicle['VehicleDetail']['vehicle_no'];
							$vhcname = isset($selectedVehicle['Car']['name'])?$selectedVehicle['Car']['name']:'';
						}	
					}
					
					//rating of the driver
					$drating = $this->userrattingsection($driver_id,'1');
					$estTime=0;
					if($ridestatus!=3){
						$estTime='';
						$this->siteconfiguration($company_id);
						$distanceDuration  = $this->getDistanceAndDuration($pickuplat,$pickuplon,$dlat,$dlon,$this->googleServerKey);
						//pr($distanceDuration);
						if(isset($distanceDuration['status']) && $distanceDuration['status']==1){
							$driverdeatils = array_slice($distanceDuration,1);
							$estTime = $driverdeatils['duration'];
						}
					}
					$alert = ($ridestatus==1)?"Order accepted":$text;
					//custome section
					$custom = array( 
						'alert'=>$alert,
						'ride_id'=> $ride_id,
						'drid'=> $driver_id,
						'drname'=> $drivername,
						'drtel'=> $drivermobileno,
						'drmfd'=> $vhcmanufacdate,
						'drplateno'=> $vhcplateno,
						'drcarnm'=> $vhcname,
						'drcarmodel'=>$vhcmodelname,
						'drimg'=> $driverimg,
						'taktm'=> $estTime,
						'text'=> $text,
						'status'=> $ridestatus,
						'dlat'=> $dlat,
						'dlon'=> $dlon,
						'clat'=> $ulat,
						'clon'=> $ulon,
						'companynm'=> $companyname,
						'drating'=>$drating
					);
				}
			}
			elseif($user_type==1){
				//drivers push response
				if($ridestatus==4){
					//find the commition wha he get
					$drivercommision=0;
					$referral_allowed=1;
					$query = "SELECT * FROM `tc_user_ride_commitions` UserRideCimmitions WHERE `user_id`='".$user_id."' AND `ride_id`='".$ride_id."'";
					$rideCommition = $this->Ride->query($query);
					//pr($rideCommition);
					if(is_array($rideCommition) && count($rideCommition)>0){
						$rideCommition = $rideCommition['0'];
						$drivercommision = (isset($rideCommition['UserRideCimmitions']['amount']))?$rideCommition['UserRideCimmitions']['amount']:0;
					}
					//formate basic custom data
					$adjusted_cost = $rDetails['Ride']['distance_cost'];
					if(isset($rDetails['Ride']['cupon_code']) && $rDetails['Ride']['cupon_code']!=''){
						$adjusted_cost = number_format(($rDetails['Ride']['distance_cost'] - $rDetails['Ride']['discount']),2,'.','');
					}
					$paymentmode = isset($rDetails['Ride']['paymentdone'])?$rDetails['Ride']['paymentdone']:0;
					$custom = array(
						'total_cost'=>number_format($rDetails['Ride']['distance_cost'],2),
						'cupon_code'=>$rDetails['Ride']['cupon_code'],
						'discount'=>$rDetails['Ride']['discount'],
						'adjusted_cost'=>$adjusted_cost,
						'referral_allowed'=>$referral_allowed,
						'paymentmode'=>$paymentmode,
						'ride_id'=>$ride_id,
						'ref_commision'=>$drivercommision,
						'status'=>'4'
					);
				}
				elseif($ridestatus==5){
					$textmsg="Ride Cancel";
					$cancelattioncharge = number_format($rDetails['Ride']['distance_cost'],2);
					$custom = array( 
						'cancel_cost'=>$cancelattioncharge,
						'ride_id'=> $ride_id,
						'text'=>$textmsg,
						'status'=>5
					);
				}
				else{
					//ride between 1 to 3
					/*$custom = array( 
						'ride_id'=> $ride_id,
						'text'=>"Ride In Progress",
						'status'=>$ridestatus
					);*/
					// accept object in all section
					$textmsg = "Ride In Progress";
					//estimate time
					$estTime=0;
					$this->siteconfiguration($company_id);
					$distanceDuration  = $this->getDistanceAndDuration($pickuplat,$pickuplon,$dlat,$dlon,$this->googleServerKey);
					//pr($distanceDuration);
					if(isset($distanceDuration['status']) && $distanceDuration['status']==1){
						$driverdeatils = array_slice($distanceDuration,1);
						$estTime = $driverdeatils['duration'];
					}
					//get customer rating
					$rating = $this->userrattingsection($customer_id,'2');
					$custom = array( 
						'estTime'=>$estTime,
						'c_name'=>$customername,
						'c_rating'=>$rating,
						'c_address'=>$pickup,
						'c_lat'=>$pickuplat,
						'c_long'=>$pickuplon,
						'c_mobile'=>$customermobile,
						'c_dropaddress'=>$drop_off,
						'c_pic'=>$customerpic,
						'ride_id'=> $ride_id,
						'text'=>$textmsg,
						'street_address'=>$street_address,
						'nearby_address'=>$nearby_address,
						'status'=>$ridestatus,
						'c_drop_lat'=>$dropofflat,
						'c_drop_lon'=>$dropofflon
					);
					
				}
			}
			else{
				///nothing
			}
			return $custom;
		}
	}
	
	//push testing section
	public function sendiospush(){
		header('Content-Type:application/json');
		$device_id=(isset($this->request->data['device_id']) && $this->request->data['device_id']!='')?$this->request->data['device_id']:'';
		$user_type=(isset($this->request->data['user_type']) && $this->request->data['user_type']>0)?$this->request->data['user_type']:'0';
		$alert = (isset($this->request->data['alert']) && $this->request->data['alert']!='')?$this->request->data['alert']:'alert not set';
		$pushreturn = $this->iospushnotification($device_id,$alert,array(),1,$user_type);
		die(json_encode(array('status'=>'1','msg'=>'push send in ios device')));
	}
	
	//update driver positions with ride trace
	public function riderootupdate(){
		header('Content-type:application/json');
		if($this->request->is('post')){
			$user_id = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
			$user_type = (isset($this->request->data['user_type']) && $this->request->data['user_type']>0)?$this->request->data['user_type']:0;
			$ride_id = (isset($this->request->data['ride_id']) && $this->request->data['ride_id']>0)?$this->request->data['ride_id']:0;
			$device_unique_id	= isset($this->request->data['device_unique_id'])?$this->request->data['device_unique_id']:'';
			$lat			= isset($this->request->data['lat'])?$this->request->data['lat']:'';
			$lon			= isset($this->request->data['lon'])?$this->request->data['lon']:'';
			$device_type		= (isset($this->request->data['device_type']) && $this->request->data['device_type']>0)?$this->request->data['device_type']:0;
			$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:'1';
			
			/*if($device_type==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid Device Request')));
			}
			if($user_id==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid User Request')));
			}
			if(!in_array( $user_type,array(1,2))){
				die(json_encode(array('status'=>'0','msg'=>'Invalid User Type Request')));
			}
			if($ride_id==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid Ride Request')));
			}*/
			//load the track module
			$this->loadModel('RideTrace');
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Ride hit Request')));
	}
	/**
	 * driver profile update method
	 *
	 * @return void
	 */
	// update user information(driver) profile update

		public function profileupdate(){
			header('Content-type:application/json');
			$this->loadModel('User');
			$this->write_log($this->request->data);
			if($this->request->is('post')){
				$user_id = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
				
				$device_type = (isset($this->request->data['device_type']) && $this->request->data['device_type']>0)?$this->request->data['device_type']:0;
				
				$user_type = (isset($this->request->data['user_type']) && $this->request->data['user_type']>0)?$this->request->data['user_type']:0;
				
				$txtUmobile = (isset($this->request->data['txtUmobile']) && $this->request->data['txtUmobile']!='')?$this->request->data['txtUmobile']:'';
				
				$txtUlname = (isset($this->request->data['txtUlname']) && $this->request->data['txtUlname']!='')?$this->request->data['txtUlname']:'';
				
				$txtUfname = (isset($this->request->data['txtUfname']) && $this->request->data['txtUfname']!='')?$this->request->data['txtUfname']:'';
				
				$device_unique_id = (isset($this->request->data['device_unique_id']) && $this->request->data['device_unique_id']!='')?$this->request->data['device_unique_id']:'';
				
				//validation sections
				if($device_type==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid device type set')));
				}
				if($user_id==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid user details')));
				}
				if($user_type==0){
					die(json_encode(array('status'=>'0','msg'=>'Invalid user type set')));
				}
				//user update field validation section
				if($txtUmobile=='' || $txtUfname=='' || $txtUlname==''){
					die(json_encode(array('status'=>'0','msg'=>'All field required')));
				}
				//image upload section
				$uploaddirectory = WWW_ROOT."userPic/";
				$usercustome = array();
				$filename='';
				$userimagefile = isset($_FILES['user_image'])?$_FILES['user_image']:'';
				//$this->write_log($userimagefile);
				$oldimagename='';
				if($userimagefile!=''){
					if($user_type==1){
						$usercustome = $this->User->DriverCustom->find('first',array('recursive'=>'1','conditions'=>array('DriverCustom.user_id'=>$user_id)));
					}
					if($user_type==2){
						$usercustome = $this->User->CustomerCustom->find('first',array('recursive'=>'1','conditions'=>array('CustomerCustom.user_id'=>$user_id)));
					}
					//pr($usercustome);
					//image upload section 
					if(is_array($usercustome) && count($usercustome)>0){
						$filename = time().str_replace(' ','_',$userimagefile['name']);
						if(move_uploaded_file($userimagefile['tmp_name'],$uploaddirectory.$filename)){
							$source = $uploaddirectory.$filename;
							$destination = $uploaddirectory."thumb_".$filename;
							$this->Thumb->createthumbs($source,$destination,100,80);
						}
						else{
							$filename='';
						}
					}
					
				}
				//now database update section
				if($filename!=''){
					$image_path = FULL_BASE_URL.$this->base."/userPic/thumb_".$filename;
					if($user_type==1){
						$oldimagename = $usercustome['DriverCustom']['user_pic'];
						//image remove old
						//$this->User->DriverCustom->id=$usercustome['DriverCustom']['id'];
						//$this->User->DriverCustom->saveField('user_pic',$filename);
						$this->User->DriverCustom->updateAll(array('DriverCustom.user_pic'=>'"'.$filename.'"','DriverCustom.device_unique_id'=>'"'.$device_unique_id.'"','DriverCustom.device_type'=>$device_type),array('DriverCustom.id'=>$usercustome['DriverCustom']['id']));
					}
					if($user_type==2){
						$oldimagename = $usercustome['CustomerCustom']['user_image'];
						//$this->User->CustomerCustom->id=$usercustome['CustomerCustom']['id'];
						//$this->User->CustomerCustom->saveField('user_image',$filename);
						$this->User->CustomerCustom->updateAll(array('CustomerCustom.user_image'=>'"'.$filename.'"','CustomerCustom.device_unique_id'=>'"'.$device_unique_id.'"','CustomerCustom.device_type'=>$device_type),array('CustomerCustom.id'=>$usercustome['CustomerCustom']['id']));
					}
					
					//unlink the old image
					
					if($oldimagename!=''){
						$imgpath = $uploaddirectory.$oldimagename;
						$thumimgpath = $uploaddirectory."thumb_".$oldimagename;
						if(file_exists($imgpath)){
							unlink($imgpath);
						}
						if(file_exists($thumimgpath)){
							unlink($thumimgpath);
						}
					}
					
				}
				else{
					$image_path='';
				}
				
				$option=array(
					'User.id'=>$user_id
				);
				
				 $savefields=array(
					'User.f_name'=>"'".$txtUfname."'",
					'User.l_name'=>"'".$txtUlname."'",
					'User.mobile'=>"'".$txtUmobile."'"
				);
				//update driver fields and driver custom firld
				$this->User->updateAll($savefields,$option);
				die(json_encode(array('status'=>'1','msg'=>'update profile','image_path'=>$image_path)));
			}
			die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
		}
		
	/**
	 * return car model and car type service
	 *
	 * @return void
	 */
	// update user information(driver) profile update	
	
	public function returnCarDetails(){
		header('Content-Type: application/json');
		//$this->loadModel('CarModel');
		$this->loadModel('Car');
		
		if($this->request->is('post')){
			$user_id = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
			
			$device_type = (isset($this->request->data['device_type']) && $this->request->data['device_type']>0)?$this->request->data['device_type']:0;
			
			$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:1;
			
			//validation sections
			if($device_type==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid device type set')));
			}
			if($user_id==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid user details')));
			}
			
			//unbind models
			$this->Car->unbindModel(
				array(
					'belongsTo'=>array('CarModel')
				)
			);
			
			$this->Car->bindModel(array(
				'hasMany'=>array(
					'CarModel'=>array(
						'className' => 'CarModel',
						'foreignKey' => 'car_id',
						'conditions' => array('is_active'=>'1')
					)
				)
			));
			$this->Car->CarModel->unbindModel(array('belongsTo'=>array('Car')));
			$option = array(
					'conditions'=>array(
						'Car.is_active'=>'1',
						'Car.company_id'=>$company_id
					)
				);
			$detas	=array();
			$carDetail = $this->Car->find('all',$option);
			//pr($carDetail);
			 foreach($carDetail as $values){
				
				$data=array(
					'carname'=>$values['Car']['name'],
					'carid'=>$values['Car']['id']
				);
				$modelData = array();
				foreach($values['CarModel'] as $model){
					$mdlData = array(
						'model_id'=>$model['id'],
						'model_name'=>$model['name']
					);
					array_push($modelData,$mdlData);
				}
				$data['models']=$modelData;
				array_push($detas,$data);
			}
			//pr($detas);
			//die();
			
			die(json_encode(array('status'=>'1','msg'=>'Car details are :','datas'=>$detas)));
		}
		die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
	}
	
	/**
	 * addVehicleService service
	 *
	 * @return void
	 */
	// update user information(driver) profile update	
	
	public function addVehicleService(){
		header('Content-Type: application/json');
		$this->loadModel('VehicleDetail');
		
		if($this->request->is('post')){
			$user_id = (isset($this->request->data['user_id']) && $this->request->data['user_id']>0)?$this->request->data['user_id']:0;
				
			$device_type = (isset($this->request->data['device_type']) && $this->request->data['device_type']>0)?$this->request->data['device_type']:0;
				
			$company_id = (isset($this->request->data['company_id']) && $this->request->data['company_id']>0)?$this->request->data['company_id']:0;
			
			$car_id = (isset($this->request->data['car_id']) && $this->request->data['car_id']>0)?$this->request->data['car_id']:0;
			
			$car_model_id = (isset($this->request->data['car_model_id']) && $this->request->data['car_model_id']>0)?$this->request->data['car_model_id']:0;
			
			$manufactureing_date = (isset($this->request->data['manufactureing_date']) && $this->request->data['manufactureing_date']!='')?$this->request->data['manufactureing_date']:'';
			
			$vehicle_no = (isset($this->request->data['vehicle_no']) && $this->request->data['vehicle_no']!='')?$this->request->data['vehicle_no']:'';
			 
			
			//validation sections
			if($device_type==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid device type set')));
			}
			if($user_id==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid user details')));
			}
			if($car_id==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid car details')));
			}
			if($car_model_id==0){
				die(json_encode(array('status'=>'0','msg'=>'Invalid car model ')));
			}
			if($manufactureing_date==''){
				die(json_encode(array('status'=>'0','msg'=>'Invalid manufacturing date')));
			}
			if($vehicle_no==''){
				die(json_encode(array('status'=>'0','msg'=>'Invalid vehicle no')));
			}
			
			$this->VehicleDetail->create();
			
			if ($this->VehicleDetail->save($this->request->data)){
				$saveData = $this->VehicleDetail->id;
				die(json_encode(array('status'=>'1','msg'=>'Vehicle details saved successfully.','id'=>$saveData)));
			}
			else{
				die(json_encode(array('status'=>'0','msg'=>'Cannot saved , please try again later.')));
			}	
			die(json_encode(array('status'=>'0','msg'=>'Invalid Request')));
		}	
		
	}
	
}