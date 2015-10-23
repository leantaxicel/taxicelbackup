<?php
App::uses('AppController', 'Controller');
/**
 * Configurations Controller
 *
 * @property Configuration $Configuration
 */
class ConfigurationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->Configuration->recursive = 0;
		$this->set('configurations', $this->paginate());*/
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
		/*if (!$this->Configuration->exists($id)) {
			throw new NotFoundException(__('Invalid configuration'));
		}
		$options = array('conditions' => array('Configuration.' . $this->Configuration->primaryKey => $id));
		$this->set('configuration', $this->Configuration->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->Configuration->create();
			if ($this->Configuration->save($this->request->data)) {
				$this->Session->setFlash(__('The configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The configuration could not be saved. Please, try again.'));
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
		/*if (!$this->Configuration->exists($id)) {
			throw new NotFoundException(__('Invalid configuration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Configuration->save($this->request->data)) {
				$this->Session->setFlash(__('The configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The configuration could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Configuration.' . $this->Configuration->primaryKey => $id));
			$this->request->data = $this->Configuration->find('first', $options);
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
		/*$this->Configuration->id = $id;
		if (!$this->Configuration->exists()) {
			throw new NotFoundException(__('Invalid configuration'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Configuration->delete()) {
			$this->Session->setFlash(__('Configuration deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Configuration was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		/*
		$this->Configuration->recursive = 0;
		$this->set('configurations', $this->paginate());*/
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
		/*if (!$this->Configuration->exists($id)) {
			throw new NotFoundException(__('Invalid configuration'));
		}
		$options = array('conditions' => array('Configuration.' . $this->Configuration->primaryKey => $id));
		$this->set('configuration', $this->Configuration->find('first', $options));*/
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
		if ($this->request->is('post')) {
			//$this->Configuration->create();
			$this->request->data['Configuration']['company_id']=$company_id;
			if ($this->Configuration->save($this->request->data)) {
				$this->Session->setFlash(__('The configuration has been updated successfully'));
				
			} else {
				$this->Session->setFlash(__('The configuration could not be updated. Please, try again.'));
			}
			$this->redirect(array('action' => 'add'));
		}
		else{
			$this->set('configuration', $this->Configuration->find('first',array('conditions'=>array('Configuration.company_id'=>$company_id))));
		}
		/*$config = $this->Configuration->find('first');
		$len = count($config);
		if($len>0){
			$options = array('conditions' => array('Configuration.' . $this->Configuration->primaryKey => $config['Configuration']['id']));
			$this->set('configuration', $this->Configuration->find('first', $options));
		}else{
			$this->set('configuration',array());
		}*/
		
		
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		/*if (!$this->Configuration->exists($id)) {
			throw new NotFoundException(__('Invalid configuration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Configuration->save($this->request->data)) {
				$this->Session->setFlash(__('The configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The configuration could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Configuration.' . $this->Configuration->primaryKey => $id));
			$this->request->data = $this->Configuration->find('first', $options);
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
		/*$this->Configuration->id = $id;
		if (!$this->Configuration->exists()) {
			throw new NotFoundException(__('Invalid configuration'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Configuration->delete()) {
			$this->Session->setFlash(__('Configuration deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Configuration was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}
}
