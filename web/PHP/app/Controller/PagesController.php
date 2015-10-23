<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

	public $adminFromEmail = "taxiceladmin@taxicel.com";
/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public $components = array('Session');
	public $layout = "indexLayout";
	public $helpers = array ('Session','App','Html');
 
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
	
	public function index(){
		$this->blogFooter();
	}
	
	public function admin_login($pqrs=0){
		if( $this->Session->read('admin_id') ) {
			$this->redirect( array('controller' => 'Dashboards', 'action' => 'admin_index') );
		}
		$this->layout = "adminloginLayout";
		$this->loadModel('User');
		if ($this->request->is('post')) {
			$username = $this->request->data['txtusername'];
			$password = $this->request->data['txtpassword'];
			//unbind model
			$this->User->unbindModel(array(
				'hasMany'=>array('CustomerRide','DriverRide'),
				'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail')
				)
			);
			//bind the company module
			$this->User->bindModel(array(
				'belongsTo'=>array(
					'Company' => array(
						'className' => 'Company',
						'foreignKey' => 'company_id',
						'dependent' => false,
						'conditions' => array('Company.is_deleted'=>'0'),
					),
				)
			));
			$findUser = $this->User->find('first',array(
				'conditions'=> array('User.username'=>$username,'User.pass'=>md5($password),'User.user_type'=>'0')
			));
			
			if ( $findUser ){
				$username=$findUser['User']['username'];
				$companylogos="";
				$companysiteurl="";
				$companyid='';
				
				//if found the company details
				if(isset($findUser['Company']['id'])){
					if($findUser['Company']['company_logo']!=''){
						$companylogos=$findUser['Company']['company_logo'];
						$companysiteurl=$findUser['Company']['website'];
						$companyid = $findUser['Company']['id'];
					}
				}
				if($findUser['User']['is_super_admin']==1){
					$this->Session->write('superadmin',1);
				}
				$id=$findUser['User']['id'];
				$this->Session->write('sitelogo',$companylogos);
				$this->Session->write('siteurl',$companysiteurl);
				$this->Session->write('siteid',$companyid);
				$this->Session->write('username',$username);
				//$this->Session->write(array('sitelogo'=>$companylogos,'admin_id'=> $id,'username'=> $companylogos,));
				
				//$this->Session-write('admin',);
					
				$this->Session->write('admin_id', $id);
				$this->redirect( array('controller' => 'Dashboards', 'action' => 'admin_index') );
			}else{
				
				$this->redirect(array('action' => 'admin_login',1,'admin' => true));
				//$this->Session->setFlash(__('Invalid username or password. Please, try again', true)); 
			}
		}
		$this->set('pqrs',$pqrs);	
	}
	
	public function driver_login($stat=0){
		if( $this->Session->check('driver_id') && $this->Session->read('driver_id')>0 ) {
			$this->redirect( array('controller' => 'Dashboards', 'action' => 'driver_index') );
		}
		$this->layout = "driverloginLayout";
		$this->loadModel('User');
		if ($this->request->is('post')) {
			$username = $this->request->data['txtusername'];
			$password = $this->request->data['txtpassword'];
			//unbind the user model
			$this->User->unbindModel(array('hasMany'=>array('CustomerRide','DriverRide'),
						       'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail')));
			//now bind the company
			$this->User->bindModel(array(
				'belongsTo'=>array(
					'Company' => array(
						'className' => 'Company',
						'foreignKey' => 'company_id',
						'dependent' => false,
						'conditions' => array('Company.is_deleted'=>'0'),
					),
				)
			));
			$findUser = $this->User->find('first',array(
				'conditions'=> array('User.email'=>$username,'User.pass'=>md5($password),'User.user_type'=>'1')
			));

			if ( $findUser ){
				$username=$findUser['User']['username'];
				$username = ucwords($findUser['User']['f_name']);
				$id=$findUser['User']['id'];
				$this->Session->write('dusername', $username);
				$this->Session->write('driver_id', $id);
				$comname = "taxicel.com.ar";
				$company_id='1';
				if(isset($findUser['Company']['company_logo']) && $findUser['Company']['company_logo']!=''){
					$this->Session->write('dcomlogo', $findUser['Company']['company_logo']);
				}
				if(isset($findUser['Company']['website']) && $findUser['Company']['website']!=''){
					$comname = $findUser['Company']['website'];
				}
				$company_id = (isset($findUser['Company']['id']) && $findUser['Company']['id']>0)?$findUser['Company']['id']:'1';
				//
				$this->Session->write('dcompname',$comname);
				$this->Session->write('dcompany_id',$company_id);
				$this->redirect( array('controller' => 'Dashboards', 'action' => 'driver_index') );
			}else{
			
				$this->redirect(array('action' => 'driver_login',2,'driver' => true));
				//$this->Session->setFlash(__('Invalid username or password. Please, try again', true)); 
			}
			
		}
		$this->set('stat',$stat);	
	}
	
	// forgot password and reset password save into data base
	
	public function forgotpass($stat=0) {
		$this->layout = "adminloginLayout";
		$this->loadModel('User');
		
		if ($this->request->is('post')) {
			$useremail = $this->request->data['txtEmails'];
			//unbind user model
			$this->User->unbindModel(array(
				'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide'),
				'hasOne'=>array('CustomerCustom','DriverCustom','VehicleDetail')
			));
			$findEmail = $this->User->find('first',array(
				'conditions'=> array('User.email'=>$useremail,'User.user_type'=>'1')
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
				
				/*
				$userpass= 'Taxicel-'.rand(999,99999);
				$id= $findEmail['User']['id']; 
				
				$this->User->updateAll(array('User.pass'=>"'".md5($userpass)."'"),array('User.id'=>$id));
				
				$email = $findEmail['User']['email'];
				$name = $findEmail['User']['username'];
				*/
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
				
				$this->redirect(array('action' => 'driver_login',3,'driver' => true));
				//$this->Session->setFlash(__('Password send successfully to your email. '));
				
				// End OF EMAIL
					
			}
			else{
				$this->redirect(array('action' => 'driver_login',4,'driver' => true));
				//$this->Session->setFlash(__('Invalid Email id. Please, try again', true)); 
			}
		}
		$this->redirect(array('action' => 'driver_login',0,'driver' => true));
		$this->set('stat',$stat);
	}
	
}
