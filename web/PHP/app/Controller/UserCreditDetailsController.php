<?php
App::uses('AppController', 'Controller');
/**
 * UserCreditDetails Controller
 *
 * @property UserCreditDetail $UserCreditDetail
 */
class UserCreditDetailsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserCreditDetail->recursive = 0;
		$this->set('userCreditDetails', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserCreditDetail->exists($id)) {
			throw new NotFoundException(__('Invalid user credit detail'));
		}
		$options = array('conditions' => array('UserCreditDetail.' . $this->UserCreditDetail->primaryKey => $id));
		$this->set('userCreditDetail', $this->UserCreditDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserCreditDetail->create();
			if ($this->UserCreditDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The user credit detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user credit detail could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserCreditDetail->User->find('list');
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
		if (!$this->UserCreditDetail->exists($id)) {
			throw new NotFoundException(__('Invalid user credit detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserCreditDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The user credit detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user credit detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserCreditDetail.' . $this->UserCreditDetail->primaryKey => $id));
			$this->request->data = $this->UserCreditDetail->find('first', $options);
		}
		$users = $this->UserCreditDetail->User->find('list');
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
		$this->UserCreditDetail->id = $id;
		if (!$this->UserCreditDetail->exists()) {
			throw new NotFoundException(__('Invalid user credit detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserCreditDetail->delete()) {
			$this->Session->setFlash(__('User credit detail deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User credit detail was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
