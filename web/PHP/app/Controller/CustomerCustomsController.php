<?php
App::uses('AppController', 'Controller');
/**
 * CustomerCustoms Controller
 *
 * @property CustomerCustom $CustomerCustom
 */
class CustomerCustomsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CustomerCustom->recursive = 0;
		$this->set('customerCustoms', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CustomerCustom->exists($id)) {
			throw new NotFoundException(__('Invalid customer custom'));
		}
		$options = array('conditions' => array('CustomerCustom.' . $this->CustomerCustom->primaryKey => $id));
		$this->set('customerCustom', $this->CustomerCustom->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CustomerCustom->create();
			if ($this->CustomerCustom->save($this->request->data)) {
				$this->Session->setFlash(__('The customer custom has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer custom could not be saved. Please, try again.'));
			}
		}
		$users = $this->CustomerCustom->User->find('list');
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
		if (!$this->CustomerCustom->exists($id)) {
			throw new NotFoundException(__('Invalid customer custom'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CustomerCustom->save($this->request->data)) {
				$this->Session->setFlash(__('The customer custom has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer custom could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CustomerCustom.' . $this->CustomerCustom->primaryKey => $id));
			$this->request->data = $this->CustomerCustom->find('first', $options);
		}
		$users = $this->CustomerCustom->User->find('list');
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
		$this->CustomerCustom->id = $id;
		if (!$this->CustomerCustom->exists()) {
			throw new NotFoundException(__('Invalid customer custom'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CustomerCustom->delete()) {
			$this->Session->setFlash(__('Customer custom deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Customer custom was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
