<?php
App::uses('AppController', 'Controller');
/**
 * CityConfigurations Controller
 *
 * @property CityConfiguration $CityConfiguration
 */
class CityConfigurationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CityConfiguration->recursive = 0;
		$this->set('cityConfigurations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CityConfiguration->exists($id)) {
			throw new NotFoundException(__('Invalid city configuration'));
		}
		$options = array('conditions' => array('CityConfiguration.' . $this->CityConfiguration->primaryKey => $id));
		$this->set('cityConfiguration', $this->CityConfiguration->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CityConfiguration->create();
			if ($this->CityConfiguration->save($this->request->data)) {
				$this->Session->setFlash(__('The city configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city configuration could not be saved. Please, try again.'));
			}
		}
		$cities = $this->CityConfiguration->City->find('list');
		$this->set(compact('cities'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CityConfiguration->exists($id)) {
			throw new NotFoundException(__('Invalid city configuration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CityConfiguration->save($this->request->data)) {
				$this->Session->setFlash(__('The city configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city configuration could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CityConfiguration.' . $this->CityConfiguration->primaryKey => $id));
			$this->request->data = $this->CityConfiguration->find('first', $options);
		}
		$cities = $this->CityConfiguration->City->find('list');
		$this->set(compact('cities'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CityConfiguration->id = $id;
		if (!$this->CityConfiguration->exists()) {
			throw new NotFoundException(__('Invalid city configuration'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CityConfiguration->delete()) {
			$this->Session->setFlash(__('City configuration deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('City configuration was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
	$this->layout="adminLayout";
		$this->CityConfiguration->recursive = 0;
		$this->set('cityConfigurations', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
	$this->layout="adminLayout";
		if (!$this->CityConfiguration->exists($id)) {
			throw new NotFoundException(__('Invalid city configuration'));
		}
		$options = array('conditions' => array('CityConfiguration.' . $this->CityConfiguration->primaryKey => $id));
		$this->set('cityConfiguration', $this->CityConfiguration->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
	$this->layout="adminLayout";
		if ($this->request->is('post')) {
			$this->CityConfiguration->create();
			if ($this->CityConfiguration->save($this->request->data)) {
				$this->Session->setFlash(__('The city configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city configuration could not be saved. Please, try again.'));
			}
		}
		$cities = $this->CityConfiguration->City->find('list');
		$this->set(compact('cities'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
	$this->layout="adminLayout";
		if (!$this->CityConfiguration->exists($id)) {
			throw new NotFoundException(__('Invalid city configuration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CityConfiguration->save($this->request->data)) {
				$this->Session->setFlash(__('The city configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city configuration could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CityConfiguration.' . $this->CityConfiguration->primaryKey => $id));
			$this->request->data = $this->CityConfiguration->find('first', $options);
		}
		$cities = $this->CityConfiguration->City->find('list');
		$this->set(compact('cities'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
	$this->layout="adminLayout";
		$this->CityConfiguration->id = $id;
		if (!$this->CityConfiguration->exists()) {
			throw new NotFoundException(__('Invalid city configuration'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CityConfiguration->delete()) {
			$this->Session->setFlash(__('City configuration deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('City configuration was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * admin_setAsDefault method
 *
 * @return void
 */
	public function admin_setAsDefault(){
		$defaultCityId = $_POST['defaultCityId'];
		//Set all isDefault to '0'
		$option = array(
			'CityConfiguration.isdefault'=>'1'
		);
		$updateData = array(
			'CityConfiguration.isdefault'=>'0'
		);
		$this->CityConfiguration->updateAll($updateData,$option);
		//Set selected city as default
		$this->CityConfiguration->id = $defaultCityId;
		$this->CityConfiguration->saveField('isdefault','1');
		die(json_encode(array('status'=>'1','msg'=>"Ok")));
	}
	
}
