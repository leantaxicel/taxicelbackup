<?php
App::uses('AppController', 'Controller');
/**
 * UserRollDetails Controller
 *
 * @property UserRollDetail $UserRollDetail
 */
class UserRollDetailsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserRollDetail->recursive = 0;
		$this->set('userRollDetails', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserRollDetail->exists($id)) {
			throw new NotFoundException(__('Invalid user roll detail'));
		}
		$options = array('conditions' => array('UserRollDetail.' . $this->UserRollDetail->primaryKey => $id));
		$this->set('userRollDetail', $this->UserRollDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserRollDetail->create();
			if ($this->UserRollDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The user roll detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user roll detail could not be saved. Please, try again.'));
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
		if (!$this->UserRollDetail->exists($id)) {
			throw new NotFoundException(__('Invalid user roll detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserRollDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The user roll detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user roll detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserRollDetail.' . $this->UserRollDetail->primaryKey => $id));
			$this->request->data = $this->UserRollDetail->find('first', $options);
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
		$this->UserRollDetail->id = $id;
		if (!$this->UserRollDetail->exists()) {
			throw new NotFoundException(__('Invalid user roll detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserRollDetail->delete()) {
			$this->Session->setFlash(__('User roll detail deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User roll detail was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
	$this->layout="adminLayout";
		$this->UserRollDetail->recursive = 0;
		$this->set('userRollDetails', $this->paginate());
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
		if (!$this->UserRollDetail->exists($id)) {
			throw new NotFoundException(__('Invalid user roll detail'));
		}
		$options = array('conditions' => array('UserRollDetail.' . $this->UserRollDetail->primaryKey => $id));
		$this->set('userRollDetail', $this->UserRollDetail->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
	$this->layout="adminLayout";
		if ($this->request->is('post')) {
			$this->UserRollDetail->create();
			if ($this->UserRollDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The user roll detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user roll detail could not be saved. Please, try again.'));
			}
		}
		$rolls = $this->UserRollDetail->Rollmaster->find('list');
		$this->set(compact('rolls'));
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
		if (!$this->UserRollDetail->exists($id)) {
			throw new NotFoundException(__('Invalid user roll detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserRollDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The user roll detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user roll detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserRollDetail.' . $this->UserRollDetail->primaryKey => $id));
			$this->request->data = $this->UserRollDetail->find('first', $options);
		}
		$rolls = $this->UserRollDetail->Rollmaster->find('list');
		$this->set(compact('rolls'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->UserRollDetail->id = $id;
		if (!$this->UserRollDetail->exists()) {
			throw new NotFoundException(__('Invalid user roll detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserRollDetail->delete()) {
			$this->Session->setFlash(__('User roll detail deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User roll detail was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
