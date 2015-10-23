<?php
App::uses('AppController', 'Controller');
/**
 * HeatZoneCordinets Controller
 *
 * @property HeatZoneCordinet $HeatZoneCordinet
 */
class HeatZoneCordinetsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->HeatZoneCordinet->recursive = 0;
		$this->set('heatZoneCordinets', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->HeatZoneCordinet->exists($id)) {
			throw new NotFoundException(__('Invalid heat zone cordinet'));
		}
		$options = array('conditions' => array('HeatZoneCordinet.' . $this->HeatZoneCordinet->primaryKey => $id));
		$this->set('heatZoneCordinet', $this->HeatZoneCordinet->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->HeatZoneCordinet->create();
			if ($this->HeatZoneCordinet->save($this->request->data)) {
				$this->Session->setFlash(__('The heat zone cordinet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The heat zone cordinet could not be saved. Please, try again.'));
			}
		}
		$heatZones = $this->HeatZoneCordinet->HeatZone->find('list');
		$this->set(compact('heatZones'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->HeatZoneCordinet->exists($id)) {
			throw new NotFoundException(__('Invalid heat zone cordinet'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->HeatZoneCordinet->save($this->request->data)) {
				$this->Session->setFlash(__('The heat zone cordinet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The heat zone cordinet could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HeatZoneCordinet.' . $this->HeatZoneCordinet->primaryKey => $id));
			$this->request->data = $this->HeatZoneCordinet->find('first', $options);
		}
		$heatZones = $this->HeatZoneCordinet->HeatZone->find('list');
		$this->set(compact('heatZones'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->HeatZoneCordinet->id = $id;
		if (!$this->HeatZoneCordinet->exists()) {
			throw new NotFoundException(__('Invalid heat zone cordinet'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HeatZoneCordinet->delete()) {
			$this->Session->setFlash(__('Heat zone cordinet deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Heat zone cordinet was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->HeatZoneCordinet->recursive = 0;
		$this->set('heatZoneCordinets', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->HeatZoneCordinet->exists($id)) {
			throw new NotFoundException(__('Invalid heat zone cordinet'));
		}
		$options = array('conditions' => array('HeatZoneCordinet.' . $this->HeatZoneCordinet->primaryKey => $id));
		$this->set('heatZoneCordinet', $this->HeatZoneCordinet->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->HeatZoneCordinet->create();
			if ($this->HeatZoneCordinet->save($this->request->data)) {
				$this->Session->setFlash(__('The heat zone cordinet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The heat zone cordinet could not be saved. Please, try again.'));
			}
		}
		$heatZones = $this->HeatZoneCordinet->HeatZone->find('list');
		$this->set(compact('heatZones'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->HeatZoneCordinet->exists($id)) {
			throw new NotFoundException(__('Invalid heat zone cordinet'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->HeatZoneCordinet->save($this->request->data)) {
				$this->Session->setFlash(__('The heat zone cordinet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The heat zone cordinet could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HeatZoneCordinet.' . $this->HeatZoneCordinet->primaryKey => $id));
			$this->request->data = $this->HeatZoneCordinet->find('first', $options);
		}
		$heatZones = $this->HeatZoneCordinet->HeatZone->find('list');
		$this->set(compact('heatZones'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->HeatZoneCordinet->id = $id;
		if (!$this->HeatZoneCordinet->exists()) {
			throw new NotFoundException(__('Invalid heat zone cordinet'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HeatZoneCordinet->delete()) {
			$this->Session->setFlash(__('Heat zone cordinet deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Heat zone cordinet was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
