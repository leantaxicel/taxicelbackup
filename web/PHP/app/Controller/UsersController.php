<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

public $helpers = array ('Session','App','Html');
public $components = array('Paginator','Session','Thumb');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->User->recursive = 0;
		$this->set('users', $this->paginate());*/
		$this->homepageredirect();
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		/*if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));*/
		$this->homepageredirect();
	}
/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}*/
		$this->homepageredirect();
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		/*if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}*/
		$this->homepageredirect();
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		/*$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}
	public function resetpassword(){
		$userid=0;
		if($this->request->is('post')){
			$baseurls = FULL_BASE_URL.$this->base;
			//pr($this->request->data);
			$this->User->unbindModel(array(
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
				'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail')
			));
			$id = isset($this->request->data['User']['passid'])?$this->request->data['User']['passid']:0;
			$encptstr = isset($this->request->data['User']['linkid'])?$this->request->data['User']['linkid']:0;
			$nwpass = isset($this->request->data['User']['password'])?$this->request->data['User']['password']:0;
			$cpass = isset($this->request->data['User']['repassword'])?$this->request->data['User']['repassword']:0;
			if($nwpass==''){
				$this->Session->setFlash(__('Password required'));
				$this->redirect(array('action'=>'resetpassword',$encptstr));
			}
			if($nwpass!=$cpass){
				$this->Session->setFlash(__('Confirm password not matched'));
				$this->redirect(array('action'=>'resetpassword',$encptstr));
			}
			$user = $this->User->find('first',array('conditions'=>array('User.passretrivestr'=>$encptstr,'User.id'=>$id)));
			//pr($user);
			//die();
			
			if(is_array($user) && count($user)>0){
				//now update the user passwords
				$this->User->updateAll(array('User.pass'=>'"'.md5($nwpass).'"'),array('User.passretrivestr'=>$encptstr,'User.id'=>$id));
				
				//valid url hit and now go to the valied url for reset the password
				//$this->Session->setFlash(__('Password Reset'));
				if($user['User']['user_type']==1){
					//driver section reset password
					$this->redirect($baseurls."/driver");
				}
				elseif($user['User']['user_type']==2){
					//customer section reset password
					$this->redirect($baseurls);
				}
				elseif($user['User']['user_type']==0){
					//admin section reset password
					$this->redirect($baseurls."/admin");
				}
			}
			else{
				$this->redirect($baseurls);
			}
		}
		else{
			$encriptedlink = isset($this->params['pass'][0])?$this->params['pass'][0]:'';
			$encripteddatas = $this->decriptlinkstr($encriptedlink);
			//pr($encripteddatas);
			//now validate the request and go pahead
			if(is_array($encripteddatas) && count($encripteddatas)==2){
				$email = $encripteddatas[1];
				$encptstr = $encripteddatas[0];
				//now validate
				$this->User->unbindModel(array(
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
					'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail')
				));
				$user = $this->User->find('first',array('conditions'=>array('User.passretrivestr'=>$encptstr,'User.email'=>$email)));

				if(is_array($user) && count($user)>0){
					$this->layout = "indexLayout";
					$userid = $user['User']['id'];
					$this->blogFooter();
					$this->set('passid',$userid);
					$this->set('linkid',$encptstr);
				}
				else{
					die("Invalid Link");
				}
			}
			else{
				die("Invalid Link");
			}
		}
		
	}
	
/**
 * NORMAL USER SECTION END
 */
	
/**
 *ADMIN SECTION START HERE 
 */

/**
 * admin_driver method
 *
 * @return void
 */
	public function admin_driver() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		//unbind model
		$this->User->unbindModel(array(
			'hasOne'=>array('CustomerCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		
		
		$condition = array('User.user_type'=>'1');
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if($company_id>0){
			$condition = array('User.user_type'=>'1','User.company_id'=>$company_id);
		}
		
		$this->User->recursive = 0;
		$this->paginate = array(
			'conditions'=>$condition,
			'offset'=>'0',
			'limit'=>30
		);
		$this->User->order=array('User.id'=>'DESC');
		$users = $this->paginate('User');
		$this->set(compact('users'));
	}

		
	
/**
 * admin_customer method
 *
 * @return void
 */
	public function admin_customer() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		//$this->User->recursive = 0;
		//unbind model
		$this->User->unbindModel(array(
			'hasOne'=>array('DriverCustom','VehicleDetail'),
			'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')
		));
		$condition = array('User.user_type'=>'2');
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if($company_id>0){
			$condition = array('User.user_type'=>'2','User.company_id'=>$company_id);
		}
		
		$this->paginate = array(
			'conditions'=>$condition,
			'offset'=>'0',
			'limit'=>30
		);
		$this->User->order=array('User.id'=>'DESC');
		$users = $this->paginate('User');
		$this->set(compact('users'));
	}		

	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->homepageredirect();
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null,$user_type=1) {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->User->exists($id)) {
			//throw new NotFoundException(__('Invalid user'));
			$this->redirect(array('controller'=>'Dashboards','admin'=>true));
		}
		//load ride model
		$this->loadModel('Ride');
		
		$usercond =  array('User.' . $this->User->primaryKey => $id,'User.user_type'=>$user_type);
		//company wise validation
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if($company_id>0){
			$usercond['User.company_id']=$company_id;
		}
		//model unbind section
		$userridecon = array();
		if($user_type==1){
			//driver
			$this->User->unbindModel(array(
				'hasOne'=>array('CustomerCustom','VehicleDetail'),
				'hasMany'=>array('CustomerRide','DriverRide')
			));
			$userridecon = array('Ride.driver_id'=>$id);
			$this->User->DriverCustom->unbindModel(array('belongsTo'=>array('User')));
			$this->User->VehicleDetail->unbindModel(array('belongsTo'=>array('User')));
			//bind vehicles models
			$this->User->bindModel(array('hasMany'=>array(
				'VehicleDetail' => array(
					'className' => 'VehicleDetail',
					'foreignKey' => 'user_id',
					'dependent' => false,
					'conditions' => '',
				)
			)));
		}
		else{
			//customer
			$this->User->unbindModel(array(
				'hasOne'=>array('DriverCustom','VehicleDetail'),
				'hasMany'=>array('CustomerRide','DriverRide')
			));
			$this->User->CustomerCustom->unbindModel(array('belongsTo'=>array('User')));
			$userridecon = array('Ride.user_id'=>$id);
		}
		$this->User->UserCreditDetail->unbindModel(array('belongsTo'=>array('User')));
		//total ride done by tha user
		$options = array('recursive'=>'2','conditions' =>$usercond);
		$user = $this->User->find('first', $options);
		if(is_array($user) && count($user)==0){
			$this->redirect(array('controller'=>'Dashboards','admin'=>true));
		}
		$this->set('user',$user);
		$titalridedone = $this->Ride->find('count',array('conditions'=>$userridecon));
		$this->set('user_type',$user_type);
		$this->set('titalridedone',$titalridedone);
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		/*if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}*/
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
		/*if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}*/
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			//throw new NotFoundException(__('Invalid user'));
			$this->redirect(array('controller'=>'Dashboards','admin'=>true));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_drivercitymap method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_drivercitymap() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		//get all active city
		$this->loadModel('City');
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		//get forst city or default city
		$fstCity = $this->City->find('first',array('conditions'=>array('City.is_active'=>'1','City.company_id'=>$company_id)));
		$citylat = '';
		$citylon = '';
		$cityid='';
		if(is_array($fstCity) && count($fstCity)>0){
			$citylat = $fstCity['City']['center_lat'];
			$citylon = $fstCity['City']['center_lon'];
			$cityid = $fstCity['City']['id'];
		}
		$cities = $this->City->find('list',array('conditions'=>array('City.is_active'=>'1','City.company_id'=>$company_id)));
		$this->set(compact('cities'));
		$this->set('citylat',$citylat);
		$this->set('citylon',$citylon);
		$this->set('cityid',$cityid);
	}
	
	
	public function admin_driversonline(){
		
		header('Content-Type:application/json');
		$cityid = (isset($_POST['cityid']) && $_POST['cityid']>0)?$_POST['cityid']:0;
		
		//unbind the model
		$this->User->DriverCustom->City->unbindMOdel(array(
			'belongsTo'=>array('Country'),
			'hasOne'=>array('CityConfiguration','PriceSetting')
		));
		$this->User->DriverCustom->City->bindModel(array(
			'hasMany'=>array(
				'DriverCustom' => array(
					'className' => 'DriverCustom',
					'foreignKey' => 'city_id',
					'dependent' => false,
					'conditions' => array('DriverCustom.status >'=>'0')
				)
			)
		));
		//company wise validation
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if($company_id>0){
			$this->User->DriverCustom->City->DriverCustom->bindModel(array(
				'belongsTo'=>array(
					'User' => array(
						'User' => 'User',
						'foreignKey' => 'user_id',
						'dependent' => false,
						'conditions' => array('User.company_id'=>$company_id)
					)
				)
			));
		}
		//unbind the model
		$this->User->DriverCustom->City->DriverCustom->unbindModel(array(
			'belongsTo'=>array('City')
		));
		
		$citydrivercustomes = $this->User->DriverCustom->City->find('first',array('recursive'=>'2','conditions'=>array('City.id'=>$cityid)));
		//pr($citydrivercustomes);
		$driverposdetails=array();
		$citycenterlat='';
		$citycenterlon='';
		if(is_array($citydrivercustomes) && count($citydrivercustomes)>0){
			//get city details
			$citycenterlat=isset($citydrivercustomes['City']['center_lat'])?$citydrivercustomes['City']['center_lat']:'0.0';
			$citycenterlon=isset($citydrivercustomes['City']['center_lon'])?$citydrivercustomes['City']['center_lon']:'0.0';
			$drivercustomes = isset($citydrivercustomes['DriverCustom'])?$citydrivercustomes['DriverCustom']:array();
			foreach($drivercustomes as $drivercustome){
				$driername = isset($drivercustome['User']['f_name'])?$drivercustome['User']['f_name']:'';
				$lat=isset($drivercustome['lat'])?$drivercustome['lat']:'';
				$lon=isset($drivercustome['long'])?$drivercustome['long']:'';
				$data = array(
					'name'=>$driername,
					'lat'=>$lat,
					'lon'=>$lon
				);
				array_push($driverposdetails,$data);
			}
		}
		die(json_encode(array('status'=>'1','drivers'=>$driverposdetails,'citycenterlat'=>$citycenterlat,'citycenterlon'=>$citycenterlon)));
	}
	
/**
 * driver_contactinfo method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function driver_contactinfo() {
		$this->driversessionchecked();
		$id = $this->Session->read('driver_id');
		$this->layout="driverLayout";
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->set('user', $this->User->find('first', $options));
		}
	}

/**
 * driver_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function driver_edit($id = null) {
		$this->driversessionchecked();
		
		$this->layout="driverLayout";
		$this->loadModel('DriverCustom');
		$this->loadModel('User');
		
		$this->loadModel('City');
		$this->loadModel('Country');
		$this->City->unbindModel(array('belongsTo'=>array('Country')));
		
		$city= $this->City->find('all');
		$country= $this->Country->find('all');
		
		
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			//update Driver Custom Field
			$redult =$this->DriverCustom->find('first',array(
				'conditions'=>array('DriverCustom.user_id'=>$id)
			));
			$oldimg = $redult['DriverCustom']['user_pic'];
			
			/* image upload */
			if(isset($this->request->data['User']['user_pic']['name']) && $this->request->data['User']['user_pic']['name']!=''){
				$filename2 = trim(time().str_replace(' ','_',$this->request->data['User']['user_pic']['name']));
				if(move_uploaded_file($this->request->data['User']['user_pic']['tmp_name'],WWW_ROOT."userPic/".$filename2)){
					$source = WWW_ROOT."userPic/".$filename2;
					$destination = WWW_ROOT."userPic/thumb_".$filename2;
					$this->Thumb->createthumbs($source,$destination,100,80);
					if($oldimg!=''){
						$oldimgpath = WWW_ROOT."userPic/".$oldimg;
						if(file_exists($oldimgpath)){
							unlink($oldimgpath);
						}
					}
				}
				else{
					$filename2='';
				}
			}else{
				$filename2=$redult['DriverCustom']['user_pic'];
			}
			//update Driver Custom Field
			$saveData['User']['f_name'] 	= $this->request->data['txtFname'];
			$saveData['User']['l_name'] 	= $this->request->data['txtLname'];
			$saveData['User']['mobile'] 	= $this->request->data['txtMobile'];
			$saveData['User']['username'] 	= $this->request->data['txtUname'];
			$saveData['User']['email'] 	= $this->request->data['txtEmail'];
			$saveData['User']['id'] 	= $id;
			$nwpass = $this->request->data['txtPass'];
			if($nwpass!='' && $nwpass==$this->request->data['txtCPass']){
				$saveData['User']['pass'] 	= md5($nwpass);
			}
			$this->User->save($saveData);
			
			$this->request->data['DriverCustom']['user_pic'] = $filename2;
			
			$saveData2['DriverCustom']['city_id']    	 = $this->request->data['txtCcity'];
			$saveData2['DriverCustom']['country_id'] 	 = $this->request->data['txtCcountry'];
			$saveData2['DriverCustom']['user_pic']   	 = $filename2;
			$saveData2['DriverCustom']['company_name']	 = $this->request->data['txtCname'];
			$saveData2['DriverCustom']['address1']		 = $this->request->data['txtCadd1'];
			$saveData2['DriverCustom']['address2']		 = $this->request->data['txtCadd2'];
			$saveData2['DriverCustom']['region'] 		 = $this->request->data['txtCregin'];
			$saveData2['DriverCustom']['postal_code']	 = $this->request->data['txtZip'];
			$saveData2['DriverCustom']['mobile']		 = $this->request->data['txtCnumber'];
			$saveData2['DriverCustom']['arg_bus_card']	 = $this->request->data['txtABN'];
			$saveData2['DriverCustom']['id'] 			 = $redult['DriverCustom']['id'];
			
			$this->DriverCustom->save($saveData2);
			
			$this->Session->setFlash(__('The user has been saved successfully'));
			$this->redirect(array('action' => 'contactinfo','driver'=>true));
			
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->set('user', $this->User->find('first', $options));
		}
		$this->set('city',$city);
		$this->set('country',$country);
	
	}


/**
 * customer  referal registration method
 *
 * @return void
 */
	public function referal_registration($reffcode='',$status=null){
		if($status==1){
			$this->set('status',$status);
		}
		$this->set('refcode',$reffcode);
	}
	
/**
 * customer  referal registration method
 *
 * @return void
 */
	public function savereferal_registration(){
		if ($this->request->is('post')) {
			$email = $this->request->data['email'];
			$option = array(
				'conditions'=>array('User.email'=>$email),
			);
			$existingUser = $this->User->find('count',$option);
			if(isset($existingUser) && $existingUser>0){
				$this->Session->setFlash(__('Email already exists.Please try another.'));
				$this->redirect(array('action'=>'referal_registration',$this->request->data['my_refferal_code']));
			}
			$randCode = $this->generaterefferalcode();
			$refer_code = $randCode;
			$password = $this->request->data['pass'];
			$saveData['User']['username'] 	= $this->request->data['username'];
			$saveData['User']['email'] 	= $this->request->data['email'];
			$saveData['User']['pass'] 	= md5($this->request->data['pass']);
			
			$saveData['User']['user_type'] 	= $this->request->data['selectName'];
			$company_id='1';
			if(isset($this->request->data['my_refferal_code']) && $this->request->data['my_refferal_code']!=''){
				$option = array(
					'conditions'=>array(
						'User.my_refferal_code'=>$this->request->data['my_refferal_code']
					),
				);
				$this->User->unbindModel(array(
					'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail'),
					'hasMany'=>array('CustomerRide','DriverRide')
				));
				$userData = $this->User->find('first',$option);	
				if(isset($userData['User']) && count($userData)>0){
					$saveData['User']['reffered_by'] = $userData['User']['id'];
					$company_id = $userData['User']['company_id'];
				}
			}
			$saveData['User']['my_refferal_code'] = $refer_code;
			$saveData['User']['company_id']=$company_id;
			
			$this->siteconfiguration($company_id);
			//if driver get register then he get a free point
			if($saveData['User']['user_type']==1){
				$saveData['User']['currentcredit'] = $this->usercurrentcreditminlimit;
			}
			$this->User->create();
			if($this->User->save($saveData)){
				$user_id = $this->User->id;
				if($user_id>0 && $saveData['User']['user_type']==1){
					//enter the free credit in payment commition
					$this->loadModel('CommissionPayment');
					$commitionpay = array('CommissionPayment'=>array(
						'company_id'=>$company_id,
						'user_id'=>$user_id,
						'scheme_id'=>'0',
						'paying_cost'=>$this->usercurrentcreditminlimit,
						'points'=>$this->usercurrentcreditminlimit,
						'paying_date'=>date('Y-m-d'),
						'payment_type'=>'1',
						'transection_id'=>'0',
						'is_admin_give'=>'1'
					));
				}
				$userFetch = $this->User->find('first',array(
					'conditions'=>array('User.id'=>$user_id)
				));
					
				$name 	   = $userFetch['User']['username'];
				$email 	   = $userFetch['User']['email'];
				//$password  = $userFetch['User']['pass'];
				$refercode  = $userFetch['User']['my_refferal_code'];
				// Email to user and admin
				if(!$this->serverDetect()){
					// admin email
					$Email = new CakeEmail();
					$Email->from(array($email => $name));
					$Email->to(array($this->adminToEmail));// admin email address
					$Email->subject('New user have registered successfully');
					$body='Hello Admin ,
							Following user newly register with you. Please find below the details.
						Name : '.$name.',
						Email : '.$email.'
						
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
							'password' 		=> $password,
							'refer_code'	=> $refercode
						));
					$Email->emailFormat('html');
								
					$Email->from(array($this->adminFromEmail));// admin email
					$Email->to($email);
					$Email->subject('Thanks for register with TaxiCel.');
					$Email->send();
				}
			}
			// end email section
			$this->redirect(array('action' => 'referal_registration','',1));
		}
	}
	
	/**
	 * driver_recharge_scheme method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function driver_rechargescheme() {
		$this->driversessionchecked();
		$driver_id = $this->Session->read('driver_id');
		$this->layout="driverLayout";
		//$this->loadModel('RechargeScheme');
		$this->loadModel('CommissionPayment');
		
		$this->CommissionPayment->bindModel(array(
			'belongsTo'=>array(
				'RechargeScheme'=>array(
					'className' => 'RechargeScheme',
					'foreignKey' => 'scheme_id'
				)
			)
		));
		$option=array(
			'conditions'=>array(
				'CommissionPayment.user_id'=>$driver_id,
				'CommissionPayment.payment_type'=>'1'
			),
		);
		$recharge=$this->CommissionPayment->find('all',$option);
		//pr($recharge);
		$this->set('recharge',$recharge);
	}	
	
	/**
	 * driver_pramotion method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	 public function driver_pramotion() {
		$this->driversessionchecked();
		$driver_id = $this->Session->read('driver_id');
		$this->layout="driverLayout";
		$option=array(
			'conditions'=>array(
				'User.id'=>$driver_id
			),
		);
		$pramotions=$this->User->find('all',$option);
		//pr($recharge);
		
		$this->set('pramotions',$pramotions);
	}
	
	/**
 * admin_retrivepass Password method  service
 *
 * @return void
 * retrive password service call for customer/driver
 */	
	public function admin_retrivepass(){
		if ($this->request->is('post')) {
			$useremail 	= $this->request->data['email'];
			$password 	= $this->request->data['pass'];
			
			$findEmail = $this->User->find('first',array(
				'conditions'=> array('User.email'=>$useremail)
			));
			
			if ( $findEmail ){
				$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):1;
				$this->siteconfiguration($company_id);
				$id=$findEmail['User']['id']; 
				$email = $findEmail['User']['email'];
				$name = ucwords($findEmail['User']['f_name']." ".$findEmail['User']['l_name']);
				$encriptbase= md5($password);
				//unbind the user model
				$this->User->unbindModel(array(
					'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
					'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail')
				));
				$this->User->updateAll(array('User.pass'=>"'".$encriptbase."'"),array('User.id'=>$id));
				//get encripted string
				/* $encriptlink = $this->encriptlinkstr($email,$encriptbase);
				$resetpasslink = FULL_BASE_URL.$this->base.'/users/resetpassword/'.$encriptlink; */
				//EMAIL TO USER
				$Email = new CakeEmail();
				$Email->template('update_pass','complaint_email');
				$Email->viewVars(array(
						'useremail' => $email,
						'username' 	=> $name,
						'password' 	=> $password
				));
				$Email->emailFormat('html');
				$Email->from(array($this->adminFromEmail));
				$Email->to($email);
				$Email->subject('Password changed by admin.');
				
				$Email->send(); 
				$this->Session->setFlash(__('Password Send Successfully.'));
				$this->redirect(array('action' => 'retrivepass'));
			}else{
				//error message
				echo "Email does not exist";
			}
		}else{
			$this->layout="adminLayout";
		}
	}
}
