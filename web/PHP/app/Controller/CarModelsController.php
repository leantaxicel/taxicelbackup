<?php
App::uses('AppController', 'Controller');
/**
 * CarModels Controller
 *
 * @property CarModel $CarModel
 */
class CarModelsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->CarModel->recursive = 0;
		$this->set('carModels', $this->paginate());*/
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
		/*if (!$this->CarModel->exists($id)) {
			throw new NotFoundException(__('Invalid car model'));
		}
		$options = array('conditions' => array('CarModel.' . $this->CarModel->primaryKey => $id));
		$this->set('carModel', $this->CarModel->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->CarModel->create();
			if ($this->CarModel->save($this->request->data)) {
				$this->Session->setFlash(__('The car model has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The car model could not be saved. Please, try again.'));
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
		/*if (!$this->CarModel->exists($id)) {
			throw new NotFoundException(__('Invalid car model'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CarModel->save($this->request->data)) {
				$this->Session->setFlash(__('The car model has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The car model could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CarModel.' . $this->CarModel->primaryKey => $id));
			$this->request->data = $this->CarModel->find('first', $options);
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
		/*$this->CarModel->id = $id;
		if (!$this->CarModel->exists()) {
			throw new NotFoundException(__('Invalid car model'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CarModel->delete()) {
			$this->Session->setFlash(__('Car model deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Car model was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($carid=0) {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->CarModel->recursive = 0;
		if($carid>0){
			$condition = array('CarModel.car_id'=>$carid);
		}
		else{
			$condition = array('CarModel.car_id >='=>$carid);
		}
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		$carcond = array('Car.company_id'=>$company_id);
		if($company_id>0){
			$condition['CarModel.company_id']=$company_id;
		}
		
		$this->paginate = array('conditions'=>$condition,'offset'=>'0','limit'=>30);
		$this->set('carModels', $this->paginate());
		$cars = $this->CarModel->Car->find('list',array('conditions'=>$carcond));
		$this->set(compact('cars'));
		$this->set('carid',$carid);
	}
	
	public function admin_modelactivechange(){
		header('Content-Type:application/json');
		if($this->request->is('post')){
			$modelid = $this->request->data['id'];
			$isactive = ($this->request->data['isactive']==1)?'0':'1';
			$rowstatustxt=($isactive==1)?'Yes':'No';
			//pr($this->request->data);
			$this->CarModel->id = $modelid;
			$this->CarModel->saveField('is_active',$isactive);
			die(json_encode(array('status'=>'1','message'=>'done','rowstatus'=>$isactive,'rowstatustxt'=>$rowstatustxt)));
		}
		die(json_encode(array('status'=>'0','message'=>'not done')));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		/*
		if (!$this->CarModel->exists($id)) {
			throw new NotFoundException(__('Invalid car model'));
		}
		$options = array('conditions' => array('CarModel.' . $this->CarModel->primaryKey => $id));
		$this->set('carModel', $this->CarModel->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		$carcond = array('Car.company_id'=>$company_id);
		if ($this->request->is('post')) {
			$this->CarModel->create();
			$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
			$this->request->data['CarModel']['company_id']=$company_id;
			if ($this->CarModel->save($this->request->data)) {
				$this->Session->setFlash(__('The car model has been saved'));
				$this->redirect(array('action' => 'index','admin'=>true));
			} else {
				$this->Session->setFlash(__('The car model could not be saved. Please, try again.'));
			}
		}
		
		$cars = $this->CarModel->Car->find('list',array('conditions'=>$carcond));
		$this->set(compact('cars'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->CarModel->exists($id)) {
			//throw new NotFoundException(__('Invalid car model'));
			$this->Session->setFlash(__('The car model Is Invaid'));
			$this->redirect(array('action' => 'index','admin'=>true));
		}
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		$carcond = array('Car.company_id'=>$company_id);
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CarModel->save($this->request->data)) {
				$this->Session->setFlash(__('The car model has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The car model could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CarModel.' . $this->CarModel->primaryKey => $id,'CarModel.company_id'=>$company_id));
			$this->request->data = $this->CarModel->find('first', $options);
		}
		$cars = $this->CarModel->Car->find('list',array('conditions'=>$carcond));
		$this->set(compact('cars'));
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
		$this->CarModel->id = $id;
		if (!$this->CarModel->exists()) {
			//throw new NotFoundException(__('Invalid car model'));
			$this->admininvalidpath();
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CarModel->delete()) {
			$this->Session->setFlash(__('Car model deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Car model was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
