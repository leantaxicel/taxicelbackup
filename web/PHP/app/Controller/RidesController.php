<?php
App::uses('AppController', 'Controller');
/**
 * Rides Controller
 *
 * @property Ride $Ride
 */
class RidesController extends AppController {

public $layout = "indexLayout";
public $helpers = array ('Session','App','Html');

/**
 * index method
 *
 * @return void
 */
	public function index($id=null) {
		if ($this->request->is('post')) {
			$this->Ride->create();
			$this->request->data['Ride']['pick_up'] 	= $this->request->data['frm_location'];
			$this->request->data['Ride']['drop_off'] 	= $this->request->data['to_location'];
			$this->request->data['Ride']['date_time'] 	= $this->request->data['date_travel'];
			$this->request->data['Ride']['pick_lat'] 	= ($this->request->data['frm_lat']!='')?$this->request->data['frm_lat']:0;
			$this->request->data['Ride']['pick_long'] 	= ($this->request->data['frm_lon']!='')?$this->request->data['frm_lon']:0;
			$this->request->data['Ride']['drop_lat'] 	= ($this->request->data['to_lat'])?$this->request->data['to_lat']:0;
			$this->request->data['Ride']['drop_long'] 	= ($this->request->data['to_lon'])?$this->request->data['to_lon']:0;
			//now change to decide the ride type
			$this->request->data['Ride']['ride_type'] 	= '1';
			$this->request->data['Ride']['ordercreatetime'] 	= date("Y-m-d G:i:s");
			$this->request->data['Ride']['company_id']='1';
			//find the date difference
			$currentday = strtotime(date("Y-m-d G:i"));
			$pickupdate = strtotime($this->request->data['date_travel']);
			$hourDif = (($pickupdate - $currentday)/3600);
			//valied date
			if($hourDif<1){
				$this->request->data['Ride']['ride_type'] = '0';
			}
			
			if(isset($id) && $id>0){
				$this->request->data['Ride']['id'] 	= $id;
			}
			$user_id = 0;
			if($this->Session->check('customer_id') && $this->Session->read('customer_id')>0){
				$user_id = $this->Session->read('customer_id');
				$this->request->data['Ride']['user_id']=$user_id;
				//get user details
				$this->request->data['Ride']['company_id']=$this->Session->read('customer_comp_id');
			}
			
			if ($this->Ride->save($this->request->data)) {
				//$this->Session->setFlash(__('The ride has been saved'));
				$id = $this->Ride->id;
				if($user_id>0){
					$this->redirect(array('action' => 'bookingsteptwo',$id,1));
				}
				else{
					$this->redirect(array('action' => 'bookingsteptwo',$id));
				}
				
			} else {
				$this->Session->setFlash(__('The ride could not be saved. Please, try again.'));
			}
		}
		if(isset($id) && $id>0){
			$options = array('conditions' => array('Ride.' . $this->Ride->primaryKey => $id));
			$this->set('ride', $this->Ride->find('first', $options));
		}else{
			$this->set('id',$id);
			$this->set('ride',null);
		}
		$this->blogFooter();
	}
	
/**
 * bookingsteptwo method
 *
 * @return void
 */
	
	public function bookingsteptwo($id=null,$status=null){
		
		if ($this->request->is('post')) {
			$this->loadModel('User');
			$saveData['User']['username'] 	= $this->request->data['txtUname'];
			$saveData['User']['f_name'] 	= $this->request->data['txtFname'];
			$saveData['User']['l_name'] 	= $this->request->data['txtLname'];
			$saveData['User']['email'] 	= $this->request->data['txtEmail'];
			$saveData['User']['mobile'] 	= $this->request->data['txtMno'];			
			$saveData['User']['user_type'] 	= '2';
			$saveData['User']['pass'] 	= $this->request->data['txtPass'];
			$company_id=1;
			//checked emailallready present or not
			$password = $saveData['User']['pass'];
			$email = $saveData['User']['email'];
			if($this->duplicateemail($saveData['User']['email'])){
				$this->Session->setFlash(__('This Email Already Present.'));
			}
			else{
				//password match
				if($saveData['User']['pass']!=$this->request->data['txtRpass']){
					$this->Session->setFlash(__('Password mismatched'));
				}
				else{
					//password section
					$randCode = $this->generaterefferalcode();
					//add refferal code to the user
					$saveData['User']['my_refferal_code']=$randCode;
					//create date 
					$saveData['User']['reg_date']=date("Y-m-d G:i:s");
					//add driver default creadit balance first time creation
					//$saveData['User']['currentcredit']=$this->usercurrentcreditminlimit;
					$saveData['User']['pass']=md5($saveData['User']['pass']);
					$saveData['User']['company_id']=$company_id;
					
					//adding user address from pickup user address  
					/*$findRideAdd = $this->Ride->find('first',array(
						'conditions'=>array('Ride.id'=>$id)
					));
					$this->request->data['User']['address'] = $findRideAdd['Ride']['pick_up'];
					*/
					
					if ($this->User->save( $saveData ) && $id>0) {
						$user_id = $this->User->id;
						//saved the customer custome data
						$saveCustom['CustomerCustom']['user_image'] 		= "";
						$saveCustom['CustomerCustom']['device_type'] 		= "0";
						$saveCustom['CustomerCustom']['user_id'] 		= $user_id;
						$saveCustom['CustomerCustom']['device_unique_id'] 	= "";
					
						if ($this->User->CustomerCustom->save($saveCustom)) {
							$this->Session->write('customer_id', $user_id);
							$this->Session->write('customer_comp_id',$company_id);
							// updating ride userid & payment_option
							$this->Ride->updateAll( array('Ride.user_id'=> $user_id,'Ride.company_id'=>$company_id), array( 'Ride.id' => $id ) );
							// creating random genreted password for user
							//$pass = 'Taxi-'.rand(99,9999).$user_id;
							//$this->User->updateAll( array('User.pass'=> "'".md5($pass)."'"), array( 'User.id' => $user_id ) );
							$status = '1';
							//send email
							$serverIsLocalHost = $this->serverDetect();
							if(!$serverIsLocalHost){
								//now set the siteconfig data
								$this->siteconfiguration($company_id);
								// Email to user and admin 
								// admin email
								
								$name = ucwords($this->request->data['txtFname']." ".$this->request->data['txtLname']);
								$contactno = $this->request->data['txtMno'];
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
										'refer_code'	=> $randCode
									));
								$Email->emailFormat('html');
								
								$Email->from(array($this->adminFromEmail=>'TaxiCel Team'));// admin email
								$Email->to(array($email=>$name));
								$Email->subject('Thanks for register with TaxiCel.');
								$Email->send();	
								// end email section
							}
							
							$this->redirect(array('action' => 'bookingsteptwo',$id,$status));
						}
						else{
							$this->Session->setFlash(__('Registration could not completed. Please, try again.'));
						}
					} else {
						$this->Session->setFlash(__('Registration could not completed. Please, try again.'));
					}
				}
			}
			
		}
		$this->blogFooter();
		$options = array('conditions' => array('Ride.' . $this->Ride->primaryKey => $id));
		$this->set('ride', $this->Ride->find('first', $options));
		$this->set('status',$status);
		$this->set('id',$id);
	}

/**
 * booklogin method
 *
 * @return void
 */
	public function booklogin( $id=null ){
		if ($this->request->is('post')) {
			$email 		= $this->request->data['txtemail'];
			$password 	= $this->request->data['txtpass'];
			
			$this->loadModel('User');
			$validUser = $this->User->find('first',array(
				'conditions'=>array('User.email'=>$email, 'User.pass'=>md5($password), 'User.user_type'=>'2')
			));
			
			if($validUser){
				$user_id = $validUser['User']['id'];
				$company_id = $validUser['User']['company_id'];
				$this->Ride->updateAll( array('Ride.user_id'=> $user_id,'Ride.company_id'=>$company_id), array( 'Ride.id' => $id ) );
				$this->Session->write('customer_id', $user_id);
				$this->Session->write('customer_comp_id',$company_id);
				$status = '1';
				$this->redirect(array('action' => 'bookingsteptwo',$id,$status));
			}else{
				$status = 'error';
				$this->redirect(array('action' => 'bookingsteptwo',$id,$status));
			}
		}
		
		/*$this->blogFooter();
		$options = array('conditions' => array('Ride.' . $this->Ride->primaryKey => $id));
		$this->set('ride', $this->Ride->find('first', $options));
		$this->set('status',$status);
		$this->set('id',$id);*/
	}
	
	public function forgotpassword($id=null) {
		$this->loadModel('User');
		//set site config data
		$company_id=1;
		$this->siteconfiguration($company_id);
		$status = 'fgerror';
		$isreload=true;
		if ($this->request->is('post')){
			$useremail = $this->request->data['txtfgemail'];
			$isreload = (isset($this->request->data['isredirect']) && $this->request->data['isredirect']==0)?false:true;
			//unbind user model
			$this->User->unbindModel(array(
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
				'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail')
			));
			$findEmail = $this->User->find('first',array(
				'conditions'=> array('User.email'=>$useremail,'User.user_type'=>'2')
			));

			if (is_array($findEmail) && count($findEmail)>0){
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
				$serverIsLocalHost = $this->serverDetect();
				if(!$serverIsLocalHost){
					//EMAIL TO USER
					$Email = new CakeEmail();
					$Email->template('forgot_pass','complaint_email');
					$Email->viewVars(array(
							'useremail' 	=> $email,
							'username' 	=> $name,
							'password' 	=> $resetpasslink
					));
					$Email->emailFormat('html');
					$Email->from(array($this->adminFromEmail));
					$Email->to($email);
					$Email->subject('Password Reset Link');
					$Email->send();
				}
				
				$status = 'send';	
			}
			else{
				$status = 'notsend';
			}
		}
		if($isreload){
			$this->redirect(array('action' => 'bookingsteptwo',$id,$status));	
		}
		else{
			die(json_encode(array("status"=>$status)));
		}
	}
	
	public function useremailvalidate(){
		
		$email = (isset($this->request->data['email']))?$this->request->data['email']:'';
		$status=1;
		if($this->duplicateemail($email)){
			$status=0;
		}
		die(json_encode(array('status'=>$status)));
	}

/**
 * paymentdetail method
 *
 * @return void
 */
	public function paymentdetail( $id=null ){
		if ($this->request->is('post')) {
			$customer_id=0;
			$company_id=1;
			if($this->Session->check('customer_id') && $this->Session->read('customer_id')>0){
				$customer_id = $this->Session->read('customer_id');
				$company_id = $this->Session->read('customer_comp_id');
			}
			if($customer_id==0){
				$this->redirect(array('action' => 'bookingsteptwo',$id));
			}
			
			$cashRadio = $this->request->data['txtPoption'];
			if($cashRadio==0){
				// UPDATING THE RIDE AS CASH PAYMENT
				$this->Ride->updateAll( array('Ride.payment_option'=> $cashRadio), array( 'Ride.id' => $id ) );
				
			}else{
				$this->loadModel('UserCreditDetail');
				// SAVING DETAILS IN CREDIT TABLE
				$saveData['UserCreditDetail']['credit_card_no'] = $this->request->data['txtPoption'];
				$saveData['UserCreditDetail']['holdername'] 	= $this->request->data['txtHname'];
				$saveData['UserCreditDetail']['expirydate'] 	= $this->request->data['txtEDate'];
				$saveData['UserCreditDetail']['cvvno'] 			= $this->request->data['txtCSV'];
				$saveData['UserCreditDetail']['address'] 		= $this->request->data['txtAddress'];
				$saveData['UserCreditDetail']['cardtype'] 		= $this->request->data['txtCType'];
				$saveData['UserCreditDetail']['postcode'] 		= $this->request->data['txtPCode'];
				$saveData['UserCreditDetail']['user_id']		= $customer_id;
				
				if($this->UserCreditDetail->save($saveData)){
					// UPDATING THE RIDE AS CREDIT CARD PAYMENT
					$cardid = $this->UserCreditDetail->id;
					$this->Ride->updateAll( array('Ride.payment_option'=> $cashRadio,'Ride.card_id'=>$cardid), array( 'Ride.id' => $id ) );
				}
				else{
					$this->Session->setFlash(__('Your Card Not Saved. Please, try again.'));
					$this->redirect(array('action' => 'bookingsteptwo',$id,'1'));
				}
				
			}
			//validate ride type and then call thedriver find service and send notification to the driver
			$this->findcityanddriver($id);
			
			// REDIRECTING THE USER TO THE SUCCESSFULL PAGE 
			$this->redirect(array('action' => 'thankspage',$customer_id));
		}
	}
	
	//set basic information of the ride and call the driver
	public function findcityanddriver($id=null){
		// city id fetching from lat and long
		$this->Ride->unbindModel(array('belongsTo'=>array('Driver','City')));
		$this->Ride->User->unbindModel(array(
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
			'hasOne'=>array('DriverCustom','VehicleDetail'),
		));
		$ridedata = $this->Ride->find('first',array('conditions'=>array('Ride.id'=>$id)));
		if(is_array($ridedata) && count($ridedata)>0){	
			$pick_up_lat = $ridedata['Ride']['pick_lat'];
			$pick_up_lon = $ridedata['Ride']['pick_long'];
			$pick_up = $ridedata['Ride']['pick_up'];
			$drop_off = $ridedata['Ride']['drop_off'];
			$picupcityname='';
			$street_address=$ridedata['Ride']['street_address'];
			$nearby_address=$ridedata['Ride']['nearby_address'];
			$drop_off_lat = $ridedata['Ride']['drop_lat'];
			$drop_off_lon = $ridedata['Ride']['drop_long'];
				
			$ridetype =$ridedata['Ride']['ride_type']; 
			//ride type decided
			$currentday = strtotime(date("Y-m-d G:i"));
			$pickupdate = strtotime($ridedata['Ride']['date_time']);
			$hourDif = (($pickupdate - $currentday)/3600);
			//valied date
			$updatearray['Ride']['ride_type']=1;
			$ridetype=1;
			if($hourDif<1){
				$updatearray['Ride']['ride_type'] = '0';
				$ridetype=0;
			}
			$company_id = $ridedata['Ride']['company_id'];
			//get servet setting
			$this->siteconfiguration($company_id);
			
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
			//get city address
			$cityresult = $this->Ride->City->find('first',array(
			   'conditions'=>array('City.name LIKE'=>'%'.$picupcityname.'%','City.company_id'=>$company_id,'City.is_active'=>'0')
			));
	
			if(is_array($cityresult) && count($cityresult)==0){
				$cityresult = $this->Ride->City->find('first',array(
				   'conditions'=>array('City.is_active'=>'0','City.company_id'=>$company_id)
				));
			}
			//pr($cityresult);
			//die();
			$cityid  = (isset($cityresult['City']['id']))?$cityresult['City']['id']:0;
			//update the ride information
			$this->Ride->updateAll(array('Ride.city_id'=>$cityid,'Ride.ride_type'=>$ridetype),array('Ride.id'=>$id));
			
			//send the notification to the driver for this ride
			if($ridetype==0){
				$estTime = "0";
				$pushid='';
				$dDetails = $this->getNearestdrivers($pick_up_lat, $pick_up_lon,$this->driverfindrange,0,0,$company_id);
				//pr($dDetails);
				// Searching for the nearest driver online
				$user_id = $ridedata['Ride']['user_id'];
				$rating=0;
				$userMobileNo='';
				$userName='';
				$userPic ='';
				
				if(is_array($ridedata['User']) && count($ridedata['User'])>0){
					$user_id = $ridedata['User']['id'];
					$userName = $ridedata['User']['username'];
					$userName = ucwords($ridedata['User']['f_name']." ".$ridedata['User']['l_name']);
					$userMobileNo = $ridedata['User']['mobile'];
					
					if(isset($ridedata['User']['CustomerCustom']['user_image']) && $ridedata['User']['CustomerCustom']['user_image']!=''){
						$userPic = FULL_BASE_URL.$this->base."/userPic/".$ridedata['User']['CustomerCustom']['user_image'];
					} 
				}
				//get user rating
				if($user_id>0){
					$rating = $this->userrattingsection($user_id,2);	
				}
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
						'ride_id'=> $id,
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
							//echo "ando";
							//send android notifications
							$registration_ids = array($pushid);
							$this->appandroidpushnotify($registration_ids,$this->DriverAppkey,$textmsg,$custom);
						}
						elseif($devicetype=='2'){
							//echo "ios";
							$this->iospushnotification($pushid,$textmsg,$custom,1,1,$company_id);
						}
					}
				}
				
				/*$devicetype = 0;
				if(is_array($dDetails) && count($dDetails)>0){
					$driver = $dDetails['0'];
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
						$distance = number_format($distance,2,'.','');
						$timeneed = (($distance*60)/40); //minute
						$timeneed = number_format($timeneed,2,'.','');
						
						$driverdeatils['duration']=$timeneed;
						$driverdeatils['distance']=$distance;
						$driverdeatils['durationinminit']=$timeneed;
					}
					
					$estTime = $driverdeatils['durationinminit'];
					$devicetype = $driver['DriverCustom']['device_type'];
					$pushid = $driver['DriverCustom']['device_unique_id'];
				}
				
				//user details
				$user_id = $ridedata['Ride']['user_id'];
				$rating=0;
				$userMobileNo='';
				$userName='';
				$userPic ='';
				
				if(is_array($ridedata['User']) && count($ridedata['User'])>0){
					$user_id = $ridedata['User']['id'];
					$userName = $ridedata['User']['username'];
					$userName = ucwords($ridedata['User']['f_name']." ".$ridedata['User']['l_name']);
					$userMobileNo = $ridedata['User']['mobile'];
					
					if(isset($ridedata['User']['CustomerCustom']['user_image']) && $ridedata['User']['CustomerCustom']['user_image']!=''){
						$userPic = FULL_BASE_URL.$this->base."/userPic/".$ridedata['User']['CustomerCustom']['user_image'];
					} 
				}
				//get user rating
				if($user_id>0){
					$rating = $this->userrattingsection($user_id,2);	
				}
				
				//create push data
				$textmsg = "New Ride";
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
					'ride_id'=> $id,
					'text'=>$textmsg,
					'street_address'=>$street_address,
					'nearby_address'=>$nearby_address
				);
				//pr($custom);
				//die();
				if($devicetype=='1'){
					//send android notifications
					if($pushid!=''){
						$registration_ids = array($pushid);
						$this->appandroidpushnotify($registration_ids,$this->DriverAppkey,$textmsg,$custom);
					}
				}
				//pr($pushid);
				//die();
				elseif($devicetype==2){
					if($pushid!=''){
						$this->iospushnotification($pushid,$textmsg,$custom,1,1,$company_id);
					}
				}
				else{
					
				}*/
			}
		}
		
	}
	
/**
 * thankspage method
 *
 * @return void
 */
	public function thankspage( $customer_id=null ){
		$this->loadModel('User');
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $customer_id));
		$this->set('user', $this->User->find('first', $options));
		//$this->Session->destroy();
		$this->Session->delete('customer_id');
		$this->blogFooter();
	}
	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ride->exists($id)) {
			throw new NotFoundException(__('Invalid ride'));
		}
		$options = array('conditions' => array('Ride.' . $this->Ride->primaryKey => $id));
		$this->set('ride', $this->Ride->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Ride->create();
			if ($this->Ride->save($this->request->data)) {
				$this->Session->setFlash(__('The ride has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ride could not be saved. Please, try again.'));
			}
		}
		$users = $this->Ride->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Ride->exists($id)) {
			throw new NotFoundException(__('Invalid ride'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ride->save($this->request->data)) {
				$this->Session->setFlash(__('The ride has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ride could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ride.' . $this->Ride->primaryKey => $id));
			$this->request->data = $this->Ride->find('first', $options);
		}
		$users = $this->Ride->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		/*$this->Ride->id = $id;
		if (!$this->Ride->exists()) {
			throw new NotFoundException(__('Invalid ride'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Ride->delete()) {
			$this->Session->setFlash(__('Ride deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ride was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}
	
	/**
	 * ADMIN SECTION START FROM HERE
	 */

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($ride_type='-1') {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->Ride->recursive = 0;
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		$ridecond = array('Ride.company_id'=>$company_id);
		
		if($ride_type>-1){
			$ridecond['Ride.ride_type']=$ride_type;
		}
		if($ride_type==0){
			$ridecond['Ride.driver_id >']="0";
		}
		$this->paginate = array(
			'conditions'=>$ridecond,
			'offset'=>'0',
			'limit'=>30
		);
		$this->Ride->order=array('Ride.id'=>'DESC');
		$this->set('rides', $this->paginate());
		$this->set('ridetype',$ride_type);
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->Ride->exists($id)) {
			//throw new NotFoundException(__('Invalid ride'));
			$this->redirect(array('action'=>'index','admin'=>true));
		}
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		//unbind the models
		$this->Ride->User->unbindModel(array(
			'hasOne'=>array('DriverCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		$this->Ride->Driver->unbindModel(array(
			'hasOne'=>array('CustomerCustom'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		$this->Ride->unbindModel(array('belongsTo'=>array('City')));
		//bind credit card model with the ride
		$this->Ride->bindModel(array(
			'belongsTo'=>array(
				'CreditCard' => array(
					'className' => 'UserCreditDetail',
					'foreignKey' => 'card_id',
					'dependent' => false
				),
			)
		));
		$options = array('recursive'=>2,'conditions' => array('Ride.' . $this->Ride->primaryKey => $id,'Ride.company_id'=>$company_id));
		$this->set('ride', $this->Ride->find('first', $options));
	}
	
	/**
	 * admin_onlinedrivers method
	 */
	public function admin_onlinedrivers($id=null){
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->Ride->exists($id)) {
			$this->redirect(array('action'=>'index','admin'=>true));
		}
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		//unbind the models
		$this->Ride->unbindModel(array('belongsTo'=>array('User','Driver','City')));
		$ride = $this->Ride->find('first',array('conditions'=>array('Ride.id'=>$id,'Ride.driver_id'=>'0','Ride.user_id >'=>'0','Ride.status'=>'0','Ride.company_id'=>$company_id)));
		$dDetails=array();
		if(isset($ride) && is_array($ride) && count($ride)>0){
			//
			$pick_up_lat = $ride['Ride']['pick_lat'];
			$pick_up_lon = $ride['Ride']['pick_long'];
			$this->siteconfiguration($company_id); //set site config variables
			$dDetails = $this->getNearestdrivers($pick_up_lat, $pick_up_lon,$this->driverfindrange,1,0,$company_id);
		}
		$this->set('rideid',$id);
		$this->set('drivers',$dDetails);
	}
	
	/**
	 * admin_dispatchorder method
	 */
	public function admin_dispatchorder($rideid=null,$driverid=null){
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->Ride->exists($rideid)) {
			$this->Session->setFlash(__('Invalid ride .'));
			$this->redirect(array('action'=>'index','admin'=>true));
		}
		//unbind the models
		$this->Ride->User->unbindModel(array(
			'hasOne'=>array('DriverCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		
		$this->Ride->unbindModel(array('belongsTo'=>array('Driver','City')));
		$ridecond =array('Ride.id'=>$rideid,'Ride.status'=>'0','Ride.user_id >'=>'0','Ride.driver_id'=>'0'); 
		$rDetails = $this->Ride->find('first',array('recursive'=>2,'conditions'=>$ridecond));
		if(is_array($rDetails) && count($rDetails)>0){
			$pick_up_lat = $rDetails['Ride']['pick_lat'];
			$pick_up_lon = $rDetails['Ride']['pick_long'];
			$pick_up = $rDetails['Ride']['pick_up'];
			$drop_off = $rDetails['Ride']['drop_off'];
			$street_address=$rDetails['Ride']['street_address'];
			$nearby_address=$rDetails['Ride']['nearby_address'];
			$company_id = $rDetails['Ride']['company_id'];
			$drop_off_lat = $rDetails['Ride']['drop_lat'];
			$drop_off_lon = $rDetails['Ride']['drop_long'];
			//now find the assign drivers details
			$estTime = "0";
			$pushid='';
			$devicetype = 0;
			$this->Ride->Driver->unbindModel(array(
				'hasOne'=>array('CustomerCustom','VehicleDetail'),
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
			));
			$dDetails = $this->Ride->Driver->find('first',array('conditions'=>array('Driver.id'=>$driverid)));
			//pr($dDetails);
			// Searching for the nearest driver online
			
			if(is_array($dDetails) && count($dDetails)>0 && isset($dDetails['DriverCustom'])){
				
				$this->siteconfiguration($company_id);
				$driver = $dDetails;
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
					$distance = number_format($distance,2,'.','');
					$timeneed = (($distance*60)/40); //minute
					$timeneed = number_format($timeneed,2,'.','');
					
					$driverdeatils['duration']=$timeneed;
					$driverdeatils['distance']=$distance;
					$driverdeatils['durationinminit']=$timeneed;
				}
				
				$estTime = $driverdeatils['durationinminit'];
				$devicetype = $driver['DriverCustom']['device_type'];
				$pushid = $driver['DriverCustom']['device_unique_id'];
				
				//user data for det push data
				//user details
				$user_id = $rDetails['Ride']['user_id'];
				$rating=0;
				$userMobileNo='';
				$userName='';
				$userPic ='';
				$street_address='';
				$nearby_address='';
				if(isset($rDetails['User']) && is_array($rDetails['User']) && count($rDetails['User'])>0){
					$user_id = $rDetails['User']['id'];
					$userName = $rDetails['User']['username'];
					$userName = ucwords($rDetails['User']['f_name']." ".$rDetails['User']['l_name']);
					$userMobileNo = $rDetails['User']['mobile'];
					
					if(isset($rDetails['User']['CustomerCustom']['user_image']) && $rDetails['User']['CustomerCustom']['user_image']!=''){
						$userPic = FULL_BASE_URL.$this->base."/userPic/".$rDetails['User']['CustomerCustom']['user_image'];
					} 
				}
				else{
					//get user details
					//$this->loadModel('User');
					$this->Ride->User->unbindModel(array(
						'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
						'hasOne'=>array('DriverCustom','VehicleDetail'),
					));
					$ridedata = $this->Ride->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
					if(isset($ridedata['User']) && is_array($ridedata['User']) && count($ridedata['User'])>0){
						$user_id = $ridedata['User']['id'];
						$userName = $ridedata['User']['username'];
						$userName = ucwords($ridedata['User']['f_name']." ".$ridedata['User']['l_name']);
						$userMobileNo = $ridedata['User']['mobile'];
						
						if(isset($ridedata['User']['CustomerCustom']['user_image']) && $ridedata['User']['CustomerCustom']['user_image']!=''){
							$userPic = FULL_BASE_URL.$this->base."/userPic/".$ridedata['User']['CustomerCustom']['user_image'];
						} 
					}
				}
				//get user rating
				if($user_id>0){
					$rating = $this->userrattingsection($user_id,2);	
				}
				
				//create push data
				$textmsg = "New Ride";
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
					'ride_id'=> $rideid,
					'text'=>$textmsg,
					'street_address'=>$street_address,
					'nearby_address'=>$nearby_address,
					'status'=>'0',
					'c_drop_lat'=>$drop_off_lat,
					'c_drop_lon'=>$drop_off_lon
				);
				//pr($custom);
				if($devicetype=='1'){
					//send android notifications
					if($pushid!=''){
						$registration_ids = array($pushid);
						$this->appandroidpushnotify($registration_ids,$this->DriverAppkey,$textmsg,$custom);
						$this->Session->setFlash(__('Acceptance Notification Send to the driver andro .'));
					}
				}
				elseif($devicetype==2){
					if($pushid!=''){
						$this->iospushnotification($pushid,$textmsg,$custom,1,1,$company_id);
						$this->Session->setFlash(__('Acceptance Notification Send to the driver ios .'));
					}
				}
				else{
					
				}
				
			}
			else{
				$this->Session->setFlash(__('Invalid Driver .'));
			}
		}
		else{
			$this->Session->setFlash(__('Invalid ride .'));
		}
		$this->redirect(array('action'=>'index','admin'=>true));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		/*if ($this->request->is('post')) {
			$this->Ride->create();
			if ($this->Ride->save($this->request->data)) {
				$this->Session->setFlash(__('The ride has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ride could not be saved. Please, try again.'));
			}
		}
		$users = $this->Ride->User->find('list');
		$this->set(compact('users'));*/
		
		$this->homepageredirect();
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		/*if (!$this->Ride->exists($id)) {
			throw new NotFoundException(__('Invalid ride'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ride->save($this->request->data)) {
				$this->Session->setFlash(__('The ride has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ride could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ride.' . $this->Ride->primaryKey => $id));
			$this->request->data = $this->Ride->find('first', $options);
		}
		$users = $this->Ride->User->find('list');
		$this->set(compact('users'));*/
		$this->homepageredirect();
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->adminsessionvalidation();
		$this->Ride->id = $id;
		if (!$this->Ride->exists()) {
			//throw new NotFoundException(__('Invalid ride'));
			$this->Session->setFlash(__('Invalid ride .'));
			$this->redirect(array('action'=>'index','admin'=>true));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Ride->delete()) {
			$this->Session->setFlash(__('Ride deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ride was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	/**
	 * admin_commitionsearn
	 */
	public function admin_commitionsearn($driver_id=0){
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		//unbind the model
		$this->Ride->unbindModel(array('belongsTo'=>array('User','City')));
		$this->Ride->Driver->unbindModel(array(
			'hasOne'=>array('CustomerCustom','DriverCustome','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		$this->Ride->recursive=0;
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		//$this->Ride->conditions=array('Ride.status'=>'4','Ride.driver_id >'=>'0');
		//$this->Ride->order=array('Ride.commission_paid'=>'DESC','Ride.id'=>'DESC');
		$cond = array('Ride.status'=>'4','Ride.driver_id >'=>'0','Ride.company_id'=>$company_id);
		if($driver_id>0){
			$cond = array('Ride.status'=>'4','Ride.driver_id'=>$driver_id,'Ride.company_id'=>$company_id);
		}
		$this->paginate = array(
			'order' => array('Ride.commission_paid'=>'ASC','Ride.id'=>'DESC'),
			'conditions'=>$cond,
			'offset'=>'0',
			'limit'=>30
		);
		$this->set('rides', $this->paginate());
		//get all drivers
		/*$this->Ride->Driver->unbindModel(array(
			'hasOne'=>array('CustomerCustom','DriverCustome','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		*/
		$this->Ride->Driver->displayField = 'email';
		$drivers = $this->Ride->Driver->find('list',array('conditions'=>array('Driver.user_type'=>'1','Driver.company_id'=>$company_id)));
		$this->set('drivers',$drivers);
		$this->set('selectusers',$driver_id);
	}
	
	public function commitionsearnfilter(){
		$this->homepageredirect();
	}
	
	/**
	 * ADMIN SECTION END
	 */
	
/**
 * driver_index method
 *
 * @return void
 */
	public function driver_index() {
		$this->driversessionchecked();
		$this->layout="driverLayout";
		
		$this->paginate = array(
			'order' => array('Ride.id' => 'DESC'),
			'conditions'=>array('Ride.driver_id'=>$this->Session->read('driver_id'),'Ride.driverviewoff'=>'0')
		);
		$rides = $this->paginate('Ride');
		$this->set(compact('rides'));
	}
	
	public function driver_delete($id=null){
		$this->driversessionchecked();
		$this->Ride->id = $id;
		if (!$this->Ride->exists()) {
			throw new NotFoundException(__('Invalid ride'));
		}
		/*$this->request->onlyAllow('post', 'delete');
		if ($this->Ride->delete()) {
			$this->Session->setFlash(__('Ride deleted'));
			$this->redirect(array('action' => 'index'));
		}*/
		$this->Ride->saveField('driverviewoff','1');
		$this->Session->setFlash(__('Ride was deleted'));
		$this->redirect(array('action' => 'index','driver'=>true));
	}
}
