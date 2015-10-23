<?php
App::uses('AppController', 'Controller');
/**
 * Cars Controller
 *
 * @property Car $Car
 */
class CarsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->Car->recursive = 0;
		$this->set('cars', $this->paginate());*/
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
		/*if (!$this->Car->exists($id)) {
			throw new NotFoundException(__('Invalid car'));
		}
		$options = array('conditions' => array('Car.' . $this->Car->primaryKey => $id));
		$this->set('car', $this->Car->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->Car->create();
			if ($this->Car->save($this->request->data)) {
				$this->Session->setFlash(__('The car has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'));
			}
		}
		$models = $this->Car->CarModel->find('list');
		$this->set(compact('models'));*/
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
		/*if (!$this->Car->exists($id)) {
			throw new NotFoundException(__('Invalid car'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Car->save($this->request->data)) {
				$this->Session->setFlash(__('The car has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Car.' . $this->Car->primaryKey => $id));
			$this->request->data = $this->Car->find('first', $options);
		}
		$models = $this->Car->CarModel->find('list');
		$this->set(compact('models'));*/
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
		/*$this->Car->id = $id;
		if (!$this->Car->exists()) {
			throw new NotFoundException(__('Invalid car'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Car->delete()) {
			$this->Session->setFlash(__('Car deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Car was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->Car->recursive = 0;
		$carcond=array();
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):1;
		if($company_id>0){
			$carcond = array('Car.company_id'=>$company_id);
		}
		$this->paginate = array(
			'conditions'=>$carcond,
			'offset'=>'0',
			'limit'=>30
		);
		$this->set('cars', $this->paginate());
	}
	
	public function admin_caractivechange(){
		header('Content-Type:application/json');
		if($this->request->is('post')){
			$id = $this->request->data['id'];
			$isactive = ($this->request->data['isactive']==1)?'0':'1';
			$rowstatustxt=($isactive==1)?'Yes':'No';
			$this->Car->id = $id;
			$this->Car->saveField('is_active',$isactive);
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
		//pr($this->params);
		/*$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->Car->exists($id)) {
			throw new NotFoundException(__('Invalid car'));
		}
		$options = array('conditions' => array('Car.' . $this->Car->primaryKey => $id));
		$this->set('car', $this->Car->find('first', $options));*/
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
		if ($this->request->is('post')) {
			$this->Car->create();
			$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
			$this->request->data['Car']['company_id']=$company_id;
			if ($this->Car->save($this->request->data)) {
				$this->Session->setFlash(__('The car has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'));
			}
		}
		/*$models = $this->Car->CarModel->find('list');
		$this->set(compact('models'));*/
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
		if (!$this->Car->exists($id)) {
			//throw new NotFoundException(__('Invalid car'));
			//$this->redirect(array('controller'=>'Dashboards','admin'=>true));
			$this->admininvalidpath();
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Car->save($this->request->data)) {
				$this->Session->setFlash(__('The car has been updated'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'));
			}
		} else {
			$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
			$options = array('conditions' => array('Car.' . $this->Car->primaryKey => $id,'Car.company_id'=>$company_id));
			$this->request->data = $this->Car->find('first', $options);
		}
		/*$models = $this->Car->CarModel->find('list');
		$this->set(compact('models'));*/
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
		$this->Car->id = $id;
		if (!$this->Car->exists()) {
			//throw new NotFoundException(__('Invalid car'));
			$this->admininvalidpath();
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Car->delete()) {
			$this->Session->setFlash(__('Car deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Car was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
