<?php
App::uses('AppController', 'Controller');
/**
 * DriverCommissions Controller
 *
 * @property DriverCommission $DriverCommission
 */
class DriverCommissionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->DriverCommission->recursive = 0;
		$this->set('driverCommissions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DriverCommission->exists($id)) {
			throw new NotFoundException(__('Invalid driver commission'));
		}
		$options = array('conditions' => array('DriverCommission.' . $this->DriverCommission->primaryKey => $id));
		$this->set('driverCommission', $this->DriverCommission->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DriverCommission->create();
			if ($this->DriverCommission->save($this->request->data)) {
				$this->Session->setFlash(__('The driver commission has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The driver commission could not be saved. Please, try again.'));
			}
		}
		$rides = $this->DriverCommission->Ride->find('list');
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
		if (!$this->DriverCommission->exists($id)) {
			throw new NotFoundException(__('Invalid driver commission'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DriverCommission->save($this->request->data)) {
				$this->Session->setFlash(__('The driver commission has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The driver commission could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DriverCommission.' . $this->DriverCommission->primaryKey => $id));
			$this->request->data = $this->DriverCommission->find('first', $options);
		}
		$rides = $this->DriverCommission->Ride->find('list');
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
		$this->DriverCommission->id = $id;
		if (!$this->DriverCommission->exists()) {
			throw new NotFoundException(__('Invalid driver commission'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DriverCommission->delete()) {
			$this->Session->setFlash(__('Driver commission deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Driver commission was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->layout="adminLayout";
		$this->DriverCommission->recursive = 0;
		$this->set('driverCommissions', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->DriverCommission->exists($id)) {
			throw new NotFoundException(__('Invalid driver commission'));
		}
		$options = array('conditions' => array('DriverCommission.' . $this->DriverCommission->primaryKey => $id));
		$this->set('driverCommission', $this->DriverCommission->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->DriverCommission->create();
			if ($this->DriverCommission->save($this->request->data)) {
				$this->Session->setFlash(__('The driver commission has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The driver commission could not be saved. Please, try again.'));
			}
		}
		$rides = $this->DriverCommission->Ride->find('list');
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
		if (!$this->DriverCommission->exists($id)) {
			throw new NotFoundException(__('Invalid driver commission'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DriverCommission->save($this->request->data)) {
				$this->Session->setFlash(__('The driver commission has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The driver commission could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DriverCommission.' . $this->DriverCommission->primaryKey => $id));
			$this->request->data = $this->DriverCommission->find('first', $options);
		}
		$rides = $this->DriverCommission->Ride->find('list');
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
		$this->DriverCommission->id = $id;
		if (!$this->DriverCommission->exists()) {
			throw new NotFoundException(__('Invalid driver commission'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DriverCommission->delete()) {
			$this->Session->setFlash(__('Driver commission deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Driver commission was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
