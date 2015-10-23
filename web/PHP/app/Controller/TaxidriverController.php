<?php
App::uses('AppController', 'Controller');
/**
 * Taxidriver Controller
 *
 * @property User $User
 */
class TaxidriverController extends AppController {

public $layout = "indexLayout";
public $helpers = array ('Session','App');

/**
 * index method
 *
 * @return void
 */
	public function index($status=0) {
		
		$this->loadModel('City');
		$this->loadModel('Country');
		$this->City->unbindModel(array('belongsTo'=>array('Country')));
		$company_id=1;
		$citi= $this->City->find('all',array('conditions'=>array('City.company_id'=>$company_id,'City.is_active'=>'1')));
		$country= $this->Country->find('all');
		
		if ($this->request->is('post')) {
			$this->loadModel('User');
			$this->loadModel('DriverCustom');
			
			// User table Data
			$userdata['User']['user_type'] 	= '1';
			$userdata['User']['username'] 	= isset($this->request->data['txtUname'])?$this->request->data['txtUname']:'';
			$userdata['User']['f_name'] 	= isset($this->request->data['txtUfname'])?$this->request->data['txtUfname']:'';
			$userdata['User']['l_name'] 	= isset($this->request->data['txtUlname'])?$this->request->data['txtUlname']:'';
			$userdata['User']['email'] 	= isset($this->request->data['txtUemail'])?$this->request->data['txtUemail']:'';
			$userdata['User']['mobile'] 	= isset($this->request->data['txtUmobile'])?$this->request->data['txtUmobile']:'';
			$userdata['User']['address'] 	= isset($this->request->data['txtUaddress'])?$this->request->data['txtUaddress']:'';
			$userdata['User']['pass'] 	= isset($this->request->data['txtUpass'])?$this->request->data['txtUpass']:'';
			$userdata['User']['company_id'] = $company_id;
			
			// Checking password match
			$uPass = $userdata['User']['pass'];
			$cPass = isset($this->request->data['txtUcpass'])?$this->request->data['txtUcpass']:'';
			//create user custome data
			$userCustomeData['DriverCustom']['drive_city'] 	= isset($this->request->data['txtDCity'])?$this->request->data['txtDCity']:'';
			$userCustomeData['DriverCustom']['company_name'] = isset($this->request->data['txtCcname'])?$this->request->data['txtCcname']:'';
			$userCustomeData['DriverCustom']['address1'] 	= isset($this->request->data['txtCaddress1'])?$this->request->data['txtCaddress1']:'';
			$userCustomeData['DriverCustom']['address2'] 	= isset($this->request->data['txtCaddress2'])?$this->request->data['txtCaddress2']:'';
			$userCustomeData['DriverCustom']['country_id'] 	= isset($this->request->data['txtCcountry'])?$this->request->data['txtCcountry']:'';
			$userCustomeData['DriverCustom']['city_id'] 	= isset($this->request->data['txtCcity'])?$this->request->data['txtCcity']:'';
			$userCustomeData['DriverCustom']['region'] 	= isset($this->request->data['txtCregion'])?$this->request->data['txtCregion']:'';
			$userCustomeData['DriverCustom']['postal_code'] = isset($this->request->data['txtCpcode'])?$this->request->data['txtCpcode']:'';
			$userCustomeData['DriverCustom']['mobile'] 	= isset($this->request->data['txtCmobile'])?$this->request->data['txtCmobile']:'';
			$userCustomeData['DriverCustom']['arg_bus_card'] = isset($this->request->data['txtCABN'])?$this->request->data['txtCABN']:'';	
			
			//user date validation section
			$requiredValidate=true;
			$isduplicateemail = $this->duplicateemail($userdata['User']['email']);
			if($isduplicateemail){
				
				$this->redirect(array('action' => 'index',5));
			}
			foreach($userdata['User'] as $key=>$val){
				if($key=="username"){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=="f_name"){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=="email"){
					if(!filter_var($val,FILTER_VALIDATE_EMAIL)){
						$requiredValidate=false;
					}
				}
				elseif($key=="mobile"){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=="address"){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=="pass"){
					if($val==''){
						$requiredValidate=false;
					}
				}
				else{
					//do nothing
				}	
			}
			
			//validate user custome data
			foreach($userCustomeData['DriverCustom'] as $key=>$val){
				if($key=='drive_city'){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=='company_name'){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=='address1'){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=='country_id'){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=='city_id'){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=='region'){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=='postal_code'){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=='mobile'){
					if($val==''){
						$requiredValidate=false;
					}
				}
				elseif($key=='arg_bus_card'){
					if($val==''){
						$requiredValidate=false;
					}
				}
				else{
					//do nothing
				}
			}
			
			//redirect dection
			if(!$requiredValidate){
				$this->redirect(array('action' => 'index',4));
			}
			if($uPass!='' && $uPass==$cPass){
				//get site config values
				$this->siteconfiguration($company_id);
				
				$randCode = $this->generaterefferalcode();
				//add refferal code to the user
				$userdata['User']['my_refferal_code']=$randCode;
				//create date 
				$userdata['User']['reg_date']=date("Y-m-d G:i:s");
				//add driver default creadit balance first time creation
				$userdata['User']['currentcredit']=$this->usercurrentcreditminlimit;
				$this->User->create();
				$userdata['User']['pass'] = md5($userdata['User']['pass']);
				if ($this->User->save($userdata)) {
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
					$reccomment="commision credited by the admin recharge with points ".$this->usercurrentcreditminlimit;
					$this->User->query("INSERT INTO tc_user_ride_commitions(`user_id`,`ride_id`,`amount`,`is_withdrawl`,`crt_date`,`credit_debit`,`reccomment`) VALUES('".$id."','0','".$this->usercurrentcreditminlimit."','0','".date('Y-m-d')."','1','".$reccomment."')");
				
					// UserCustom table data
					$userCustomeData['DriverCustom']['user_id'] 	= $id;
					
					$this->DriverCustom->create();
					
					if ($this->DriverCustom->save($userCustomeData)) {
						$this->redirect(array('action' => 'index',1));
					}else{
						//$this->Session->setFlash(__('The driver could not be saved. Please, try again.'));
						$this->redirect(array('action' => 'index',2));
					}	
				} else {
					//$this->Session->setFlash(__('The driver could not be saved. Please, try again.'));
					$this->redirect(array('action' => 'index',2));
				}
			}else{
				//$this->Session->setFlash(__('Password doesnt match, please try again.'));
				$this->redirect(array('action' => 'index',3));
			}
			
		}
		$this->blogFooter();
		$this->set('status',$status);
		
		$this->set('citi',$citi);
		$this->set('country',$country);
	}
}