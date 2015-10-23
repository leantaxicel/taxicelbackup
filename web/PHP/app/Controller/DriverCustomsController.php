<?php
App::uses('AppController', 'Controller');
/**
 * DriverCustoms Controller
 *
 * @property DriverCustoms $DriverCustoms
 */
class DriverCustomsController extends AppController {

public $helpers = array ('Session','App','Html','Paginator');

public $components = array('Thumb');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->DriverCustoms->recursive = 0;
		$this->set('DriverCustomss', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DriverCustoms->exists($id)) {
			throw new NotFoundException(__('Invalid user customer'));
		}
		$options = array('conditions' => array('DriverCustoms.' . $this->DriverCustoms->primaryKey => $id));
		$this->set('DriverCustoms', $this->DriverCustoms->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DriverCustoms->create();
			if ($this->DriverCustoms->save($this->request->data)) {
				$this->Session->setFlash(__('The user customer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user customer could not be saved. Please, try again.'));
			}
		}
		$users = $this->DriverCustoms->User->find('list');
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
		if (!$this->DriverCustoms->exists($id)) {
			throw new NotFoundException(__('Invalid user customer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DriverCustoms->save($this->request->data)) {
				$this->Session->setFlash(__('The user customer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user customer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DriverCustoms.' . $this->DriverCustoms->primaryKey => $id));
			$this->request->data = $this->DriverCustoms->find('first', $options);
		}
		$users = $this->DriverCustoms->User->find('list');
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
		$this->DriverCustoms->id = $id;
		if (!$this->DriverCustoms->exists()) {
			throw new NotFoundException(__('Invalid user customer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DriverCustoms->delete()) {
			$this->Session->setFlash(__('User customer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User customer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->DriverCustoms->recursive = 0;
		$this->set('DriverCustomss', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->DriverCustoms->exists($id)) {
			throw new NotFoundException(__('Invalid user customer'));
		}
		$options = array('conditions' => array('DriverCustoms.' . $this->DriverCustoms->primaryKey => $id));
		$this->set('DriverCustoms', $this->DriverCustoms->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->DriverCustoms->create();
			if ($this->DriverCustoms->save($this->request->data)) {
				$this->Session->setFlash(__('The user customer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user customer could not be saved. Please, try again.'));
			}
		}
		$users = $this->DriverCustoms->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->DriverCustoms->exists($id)) {
			throw new NotFoundException(__('Invalid user customer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DriverCustoms->save($this->request->data)) {
				$this->Session->setFlash(__('The user customer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user customer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DriverCustoms.' . $this->DriverCustoms->primaryKey => $id));
			$this->request->data = $this->DriverCustoms->find('first', $options);
		}
		$users = $this->DriverCustoms->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->DriverCustoms->id = $id;
		if (!$this->DriverCustoms->exists()) {
			throw new NotFoundException(__('Invalid user customer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DriverCustoms->delete()) {
			$this->Session->setFlash(__('User customer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User customer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	
	
	//Sub Driver Index Panel DRIVER PANEL
	
	public function driver_subindex() {
		$this->layout="driverLayout";
		$this->loadModel('User');
		
		$userinfo = $this->User->find('first',array(
				'recursive'=>2,
				'conditions'=>array('User.id'=>$this->Session->read('driver_id'))
				));
		
		$this->paginate = array(
			'order' => array('User.id' => 'DESC'),
			'conditions'=>array('User.reffered_by'=>$this->Session->read('driver_id'))
		);
		
		$users = $this->paginate('User');
		$this->set(compact('users'));
		$this->set('userinfo',$userinfo);
	}
	
	// add driver 
	
	public function driver_subadd($stat=0) {
	$this->layout="driverLayout";
	$this->loadModel('City');
	$this->loadModel('Country');
	$this->City->unbindModel(array('belongsTo'=>array('Country')));
	$refferBy = $this->Session->read('driver_id');
	
		$result= $this->City->find('all');
		$country= $this->Country->find('all');
	
		if ($this->request->is('post')) {
			$this->loadModel('User');
			$this->loadModel('DriverCustom');
			
			// User table Data
			$this->request->data['User']['user_type'] 	= '1';
			$this->request->data['User']['username'] 	= $this->request->data['txtUname'];
			$this->request->data['User']['f_name'] 		= $this->request->data['txtUfname'];
			$this->request->data['User']['l_name'] 		= $this->request->data['txtUlname'];
			$this->request->data['User']['email'] 		= $this->request->data['txtUemail'];
			$this->request->data['User']['mobile'] 		= $this->request->data['txtUmobile'];
			$this->request->data['User']['address'] 	= $this->request->data['txtUaddress'];
			$this->request->data['User']['pass'] 		= $this->request->data['txtUpass'];
			$this->request->data['User']['reffered_by'] = $refferBy;
			
			
			// Checking password match
			$uPass = $this->request->data['txtUpass'];
			$cPass = $this->request->data['txtUcpass'];
			
			if($uPass==$cPass){
				$this->User->create();
				
				// SAVING driver images
				if(isset($this->request->data['user_pic']['name']) && $this->request->data['user_pic']['name']!=''){
					$images2 = trim(time().str_replace(' ','_',$this->request->data['user_pic']['name']));
					if(move_uploaded_file($this->request->data['user_pic']['tmp_name'],WWW_ROOT."userPic/".$images2)){
						$source = WWW_ROOT."userPic/".$images2;
						$destination = WWW_ROOT."userPic/thumb_".$images2;
						$this->Thumb->createthumbs($source,$destination,100,80);
					}
					else{
						$images2='';
					}
				}else{
					$images2='';
				}
				// End of image upload
				
				
				if ($this->User->save($this->request->data)) {
					$id = $this->User->id;
				
				// UserCustom table data
				$this->request->data['DriverCustom']['user_id'] 		= $id;
				$this->request->data['DriverCustom']['drive_city'] 		= $this->request->data['txtDCity'];
				$this->request->data['DriverCustom']['user_pic'] 		= $images2;
				$this->request->data['DriverCustom']['company_name'] 	= $this->request->data['txtCcname'];
				$this->request->data['DriverCustom']['address1'] 		= $this->request->data['txtCaddress1'];
				$this->request->data['DriverCustom']['address2'] 		= $this->request->data['txtCaddress2'];
				$this->request->data['DriverCustom']['country_id'] 		= $this->request->data['txtCcountry'];
				$this->request->data['DriverCustom']['city_id'] 		= $this->request->data['txtCcity'];
				$this->request->data['DriverCustom']['region'] 			= $this->request->data['txtCregion'];
				$this->request->data['DriverCustom']['postal_code'] 	= $this->request->data['txtCpcode'];
				$this->request->data['DriverCustom']['mobile'] 			= $this->request->data['txtCmobile'];
				$this->request->data['DriverCustom']['arg_bus_card'] 	= $this->request->data['txtCABN'];
				
				$this->DriverCustom->create();
					
					if ($this->DriverCustom->save($this->request->data)) {
						$this->redirect(array('action' => 'subindex',1));
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
		
		//$users = $this->DriverCustoms->User->find('list');
		//$this->set(compact('users'));
		
		$this->blogFooter();
		$this->set('stat',$stat);
		
		$this->set('result',$result);
		$this->set('country',$country);
	}
	
	// edit
	public function driver_subedit($id = null) {
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
			/* image upload */
			if(isset($this->request->data['User']['user_pic']['name']) && $this->request->data['User']['user_pic']['name']!=''){
				$filename2 = trim(time().str_replace(' ','_',$this->request->data['User']['user_pic']['name']));
				if(move_uploaded_file($this->request->data['User']['user_pic']['tmp_name'],WWW_ROOT."userPic/".$filename2)){
					$source = WWW_ROOT."userPic/".$filename2;
					$destination = WWW_ROOT."userPic/thumb_".$filename2;
					$this->Thumb->createthumbs($source,$destination,100,80);
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
			$saveData['User']['pass'] 		= $this->request->data['txtPass'];
			$saveData['User']['email'] 		= $this->request->data['txtEmail'];
			$saveData['User']['id'] 		= $id;
			
			$this->User->save($saveData);
			
			$this->request->data['DriverCustom']['user_pic'] = $filename2;
			
			$saveData2['DriverCustom']['city_id']    	 = $this->request->data['txtCcountry'];
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
			
			$this->Session->setFlash(__('The user has been updated successfully'));
			$this->redirect(array('action' => 'subindex'));
			
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->set('user', $this->User->find('first', $options));
		}
		
		$this->set('city',$city);
		$this->set('country',$country);	
	}
	
	
	// View Driver Details
	public function driver_subview($id = null) {
		$this->layout="driverLayout";
		$this->loadModel('User');
		$result= $this->User->find('first',array(
			'conditions'=>array('User.id'=>$id)
		));
		$this->set('options',$result);
	}
	
	// delete Driver and driver details
	public function driver_subdelete($id = null) {
		$this->loadModel('DriverCustom');
		$this->loadModel('User');
		$this->User->id = $id;
		
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			
			$result= $this->DriverCustom->find('first',array(
				'conditions'=>array('DriverCustom.user_id'=>$id)
			));
			$d_id = $result['DriverCustom']['id'];
			$this->DriverCustom->id = $d_id;
			$this->DriverCustom->delete();
			
			$this->Session->setFlash(__('Driver deleted successfully'));
			$this->redirect(array('action' => 'subindex'));
		}
		$this->Session->setFlash(__('User customer was not deleted'));
		$this->redirect(array('action' => 'subindex'));
	}
	
}
