<?php
App::uses('AppController', 'Controller');
/**
 * VehicleDetails Controller
 *
 * @property VehicleDetail $VehicleDetail
 */
class VehicleDetailsController extends AppController {

	 public $layout = "driverLayout";
	 public $helpers = array ('Session','Html');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->VehicleDetail->recursive = 0;
		$this->set('vehicleDetails', $this->paginate());*/
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
		/*if (!$this->VehicleDetail->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle detail'));
		}
		$options = array('conditions' => array('VehicleDetail.' . $this->VehicleDetail->primaryKey => $id));
		$this->set('vehicleDetail', $this->VehicleDetail->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->VehicleDetail->create();
			if ($this->VehicleDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The vehicle detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vehicle detail could not be saved. Please, try again.'));
			}
		}
		$drivers = $this->VehicleDetail->Driver->find('list');
		$cars = $this->VehicleDetail->Car->find('list');
		$this->set(compact('drivers', 'cars'));*/
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
		/*if (!$this->VehicleDetail->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->VehicleDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The vehicle detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vehicle detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VehicleDetail.' . $this->VehicleDetail->primaryKey => $id));
			$this->request->data = $this->VehicleDetail->find('first', $options);
		}
		$drivers = $this->VehicleDetail->Driver->find('list');
		$cars = $this->VehicleDetail->Car->find('list');
		$this->set(compact('drivers', 'cars'));*/
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
		/*$this->VehicleDetail->id = $id;
		if (!$this->VehicleDetail->exists()) {
			throw new NotFoundException(__('Invalid vehicle detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->VehicleDetail->delete()) {
			$this->Session->setFlash(__('Vehicle detail deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Vehicle detail was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}
	/**
	 * DRIVER SECTION START
	 */
	
	public function driver_index() {
		$this->driversessionchecked();
		$driver_id = $this->Session->read('driver_id');
		$this->VehicleDetail->recursive = 0;
		$this->set('vehicleDetails', $this->paginate(array('VehicleDetail.user_id'=>$driver_id)));
		$this->set('userid',$driver_id);
	}
	
	public function driver_view($id = null) {
		/*if (!$this->VehicleDetail->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle detail'));
		}
		$options = array('conditions' => array('VehicleDetail.' . $this->VehicleDetail->primaryKey => $id));
		$this->set('vehicleDetail', $this->VehicleDetail->find('first', $options));*/
		$this->homepageredirect();
	}

	
	public function driver_add() {
		$this->driversessionchecked();
		if ($this->request->is('post')) {
			$this->VehicleDetail->create();
			if ($this->VehicleDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The vehicle detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vehicle detail could not be saved. Please, try again.'));
			}
		}
		$company_id = ($this->Session->check('dcompany_id') && $this->Session->read('dcompany_id')>0)?$this->Session->read('dcompany_id'):'1';
		
		$cond = array('Car.is_active'=>'1','Car.company_id'=>$company_id);
		$cars = $this->VehicleDetail->Car->find('list',array('conditions'=>$cond));
		$this->set(compact('cars'));
		$carModels = array();
		if(is_array($cars) && count($cars)>0){
		  list($first_car_id ) = array_keys($cars);
		  $carModels = $this->VehicleDetail->Car->CarModel->find('list',array('conditions'=>array('CarModel.car_id'=>$first_car_id)));
		}
		$this->set(compact('carModels'));
	}
	public function driver_carmodels(){
		  header('Content-Type:application/json');
		  if($this->request->is('post')){
			$car_id = $this->request->data['id'];
			$this->VehicleDetail->CarModel->unbindModel(array('belongsTo'=>array('Car')));
			$conditions = array('CarModel.is_active'=>'1','CarModel.car_id'=>$car_id);
			$carmodels = $this->VehicleDetail->CarModel->find('all',array('conditions'=>$conditions));
			die(json_encode(array('status'=>'1','message'=>'valid','models'=>$carmodels)));
		  }
		  die(json_encode(array('status'=>'0','message'=>'invalid')));
	}
	
	public function driver_edit($id = null) {
		$this->driversessionchecked();
		if (!$this->VehicleDetail->exists($id)) {
			//throw new NotFoundException(__('Invalid vehicle detail'));
			   $this->Session->setFlash(__('Invalid vehicle detail'));
			   $this->redirect(array('action' => 'index','driver'=>true));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->VehicleDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The vehicle detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vehicle detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VehicleDetail.' . $this->VehicleDetail->primaryKey => $id));
			$this->request->data = $this->VehicleDetail->find('first', $options);
			
		}
		$first_car_id = isset($this->request->data['VehicleDetail']['car_id'])?$this->request->data['VehicleDetail']['car_id']:0;
		$cars = $this->VehicleDetail->Car->find('list');
		$this->set(compact('cars'));
		$options = array('conditions' => array('VehicleDetail.' . $this->VehicleDetail->primaryKey => $id));
		$this->set('vehicleDetail', $this->VehicleDetail->find('first', $options));
		$carModels = array();
		if(is_array($cars) && count($cars)>0){
			   $carModels = $this->VehicleDetail->Car->CarModel->find('list',array('conditions'=>array('CarModel.car_id'=>$first_car_id)));
		}
		$this->set(compact('carModels'));
	}
	
	public function driver_delete($id = null) {
		$this->driversessionchecked();
		$this->VehicleDetail->id = $id;
		if (!$this->VehicleDetail->exists()) {
			throw new NotFoundException(__('Invalid vehicle detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->VehicleDetail->delete()) {
			$this->Session->setFlash(__('Vehicle detail deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Vehicle detail was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	//DRIVER END
	
/**
 * ADMIN SECTION START
 */
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($user_id=0) {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->VehicleDetail->recursive = 0;
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		
		if($user_id>0){
		  $condition = array('VehicleDetail.user_id'=>$user_id,'VehicleDetail.company_id'=>$company_id);
		}
		else{
		  $condition = array('VehicleDetail.user_id >='=>$user_id,'VehicleDetail.company_id'=>$company_id);
		}
		$this->paginate=array(
			   'conditions'=>$condition,
			   'offset'=>'0',
			   'limit'=>30
		  );
		$this->set('vehicleDetails', $this->paginate());
		//get all user
		$this->VehicleDetail->User->displayField="email";
		$users = $this->VehicleDetail->User->find('list',array('conditions'=>array('User.user_type'=>'1','User.company_id'=>$company_id)));
		$this->set(compact('users'));
		$this->set('selecteduser',$user_id);
	}
	
	public function admin_vehicleapproved(){
		 header('Content-Type:application/json');
		  if($this->request->is('post')){
			 // pr($this->request->data);
			   $id = $this->request->data['id'];
			   $isapproved = ($this->request->data['isapproved']==0)?1:0;
			   $text = ($isapproved==1)?"Yes":"No";
			   $this->VehicleDetail->id=$id;
			   $this->VehicleDetail->saveField('isapproved',$isapproved);
			  die(json_encode(array('status'=>'1','message'=>'Valid','rowstatus'=>$isapproved,'rowstatustxt'=>$text))); 
		  }
		  die(json_encode(array('status'=>'0','message'=>'Invalid')));
	}
	
	public function admin_vehicleisdefault(){
		 header('Content-Type:application/json');
		  if($this->request->is('post')){
			 // pr($this->request->data);
			   $id = $this->request->data['id'];
			   $isdefault = ($this->request->data['isdefault']==0)?1:0;
			   $text = ($isdefault==1)?"Yes":"No";
			   $this->VehicleDetail->id=$id;
			   $this->VehicleDetail->saveField('isdefault',$isdefault);
			  die(json_encode(array('status'=>'1','message'=>'Valid','rowstatus'=>$isdefault,'rowstatustxt2'=>$text))); 
		  }
		  die(json_encode(array('status'=>'0','message'=>'Invalid')));
	}
	

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		/*$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if ($this->request->is('post')) {
			$this->VehicleDetail->create();
			if ($this->VehicleDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The vehicle detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vehicle detail could not be saved. Please, try again.'));
			}
		}
		$drivers = $this->VehicleDetail->Driver->find('list');
		$cars = $this->VehicleDetail->Car->find('list');
		$this->set(compact('drivers', 'cars'));*/
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
		/*$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->VehicleDetail->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->VehicleDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The vehicle detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vehicle detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VehicleDetail.' . $this->VehicleDetail->primaryKey => $id));
			$this->request->data = $this->VehicleDetail->find('first', $options);
		}
		$drivers = $this->VehicleDetail->Driver->find('list');
		$cars = $this->VehicleDetail->Car->find('list');
		$this->set(compact('drivers', 'cars'));*/
		$this->homepageredirect();
	}
	
/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		/*$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->VehicleDetail->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle detail'));
		}
		$options = array('conditions' => array('VehicleDetail.' . $this->VehicleDetail->primaryKey => $id));
		$this->set('vehicleDetail', $this->VehicleDetail->find('first', $options));*/
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
		/*$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->VehicleDetail->id = $id;
		if (!$this->VehicleDetail->exists()) {
			throw new NotFoundException(__('Invalid vehicle detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->VehicleDetail->delete()) {
			$this->Session->setFlash(__('Vehicle detail deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Vehicle detail was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}
	
	/**
 * admin_addvehicle method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_addvehicle($user_id=null,$company_id=null) {
		//$this->driversessionchecked();
		$this->layout="adminLayout";
		$this->loadModel('User');
		
		$user_data = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
		//pr($user_data);
		//die();
		
		$company_id=$user_data['User']['company_id'];
		
		if ($this->request->is('post')) {
			//$this->request->data['company_id'] = $company_id;
			$this->VehicleDetail->create();
			if ($this->VehicleDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The vehicle detail has been saved'));
				$this->redirect(array('controller'=>'Users','action' => 'driver'));
			} else {
				$this->Session->setFlash(__('The vehicle detail could not be saved. Please, try again.'));
			}
		}
		
		//$company_id = ($this->Session->check('dcompany_id') && $this->Session->read('dcompany_id')>0)?$this->Session->read('dcompany_id'):'1';
		
		$cond = array('Car.is_active'=>'1','Car.company_id'=>$company_id);
		$cars = $this->VehicleDetail->Car->find('list',array('conditions'=>$cond));
		$this->set(compact('cars'));
		$carModels = array();
		if(is_array($cars) && count($cars)>0){
		  list($first_car_id ) = array_keys($cars);
		  $carModels = $this->VehicleDetail->Car->CarModel->find('list',array('conditions'=>array('CarModel.car_id'=>$first_car_id)));
		}
		$this->set(compact('carModels'));
		$this->set('user_id',$user_id);
		$this->set('company_id',$company_id);
	}
	
}
