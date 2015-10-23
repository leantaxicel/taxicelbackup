<?php
App::uses('AppController', 'Controller');
/**
 * Rollmasters Controller
 *
 * @property Rollmaster $Rollmaster
 */
class RollmastersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rollmaster->recursive = 0;
		$this->set('rollmasters', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rollmaster->exists($id)) {
			throw new NotFoundException(__('Invalid rollmaster'));
		}
		$options = array('conditions' => array('Rollmaster.' . $this->Rollmaster->primaryKey => $id));
		$this->set('rollmaster', $this->Rollmaster->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rollmaster->create();
			if ($this->Rollmaster->save($this->request->data)) {
				$this->Session->setFlash(__('The rollmaster has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rollmaster could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Rollmaster->exists($id)) {
			throw new NotFoundException(__('Invalid rollmaster'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Rollmaster->save($this->request->data)) {
				$this->Session->setFlash(__('The rollmaster has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rollmaster could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rollmaster.' . $this->Rollmaster->primaryKey => $id));
			$this->request->data = $this->Rollmaster->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Rollmaster->id = $id;
		if (!$this->Rollmaster->exists()) {
			throw new NotFoundException(__('Invalid rollmaster'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Rollmaster->delete()) {
			$this->Session->setFlash(__('Rollmaster deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rollmaster was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
	$this->layout="adminLayout";
		$this->Rollmaster->recursive = 0;
		$this->set('rollmasters', $this->paginate());
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
		if (!$this->Rollmaster->exists($id)) {
			throw new NotFoundException(__('Invalid rollmaster'));
		}
		$options = array('conditions' => array('Rollmaster.' . $this->Rollmaster->primaryKey => $id));
		$this->set('rollmaster', $this->Rollmaster->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
	$this->layout="adminLayout";
		if ($this->request->is('post')) {
			$this->Rollmaster->create();
			if ($this->Rollmaster->save($this->request->data)) {
				$this->Session->setFlash(__('The rollmaster has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rollmaster could not be saved. Please, try again.'));
			}
		}
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
		if (!$this->Rollmaster->exists($id)) {
			throw new NotFoundException(__('Invalid rollmaster'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Rollmaster->save($this->request->data)) {
				$this->Session->setFlash(__('The rollmaster has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rollmaster could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rollmaster.' . $this->Rollmaster->primaryKey => $id));
			$this->request->data = $this->Rollmaster->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Rollmaster->id = $id;
		if (!$this->Rollmaster->exists()) {
			throw new NotFoundException(__('Invalid rollmaster'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Rollmaster->delete()) {
			$this->Session->setFlash(__('Rollmaster deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rollmaster was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
