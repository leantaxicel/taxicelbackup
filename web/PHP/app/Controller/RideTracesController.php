<?php
App::uses('AppController', 'Controller');
/**
 * RideTraces Controller
 *
 * @property RideTrace $RideTrace
 */
class RideTracesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RideTrace->recursive = 0;
		$this->set('rideTraces', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RideTrace->exists($id)) {
			throw new NotFoundException(__('Invalid ride trace'));
		}
		$options = array('conditions' => array('RideTrace.' . $this->RideTrace->primaryKey => $id));
		$this->set('rideTrace', $this->RideTrace->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RideTrace->create();
			if ($this->RideTrace->save($this->request->data)) {
				$this->Session->setFlash(__('The ride trace has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ride trace could not be saved. Please, try again.'));
			}
		}
		$rides = $this->RideTrace->Ride->find('list');
		$this->set(compact('rides'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RideTrace->exists($id)) {
			throw new NotFoundException(__('Invalid ride trace'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RideTrace->save($this->request->data)) {
				$this->Session->setFlash(__('The ride trace has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ride trace could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RideTrace.' . $this->RideTrace->primaryKey => $id));
			$this->request->data = $this->RideTrace->find('first', $options);
		}
		$rides = $this->RideTrace->Ride->find('list');
		$this->set(compact('rides'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RideTrace->id = $id;
		if (!$this->RideTrace->exists()) {
			throw new NotFoundException(__('Invalid ride trace'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RideTrace->delete()) {
			$this->Session->setFlash(__('Ride trace deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ride trace was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->RideTrace->recursive = 0;
		$this->set('rideTraces', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->RideTrace->exists($id)) {
			throw new NotFoundException(__('Invalid ride trace'));
		}
		$options = array('conditions' => array('RideTrace.' . $this->RideTrace->primaryKey => $id));
		$this->set('rideTrace', $this->RideTrace->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->RideTrace->create();
			if ($this->RideTrace->save($this->request->data)) {
				$this->Session->setFlash(__('The ride trace has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ride trace could not be saved. Please, try again.'));
			}
		}
		$rides = $this->RideTrace->Ride->find('list');
		$this->set(compact('rides'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->RideTrace->exists($id)) {
			throw new NotFoundException(__('Invalid ride trace'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RideTrace->save($this->request->data)) {
				$this->Session->setFlash(__('The ride trace has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ride trace could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RideTrace.' . $this->RideTrace->primaryKey => $id));
			$this->request->data = $this->RideTrace->find('first', $options);
		}
		$rides = $this->RideTrace->Ride->find('list');
		$this->set(compact('rides'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->RideTrace->id = $id;
		if (!$this->RideTrace->exists()) {
			throw new NotFoundException(__('Invalid ride trace'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RideTrace->delete()) {
			$this->Session->setFlash(__('Ride trace deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ride trace was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
