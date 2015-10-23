<?php
App::uses('AppController', 'Controller');
/**
 * Cupons Controller
 *
 * @property Cupon $Cupon
 */
class CuponsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Cupon->recursive = 0;
		$this->set('cupons', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cupon->exists($id)) {
			throw new NotFoundException(__('Invalid cupon'));
		}
		$options = array('conditions' => array('Cupon.' . $this->Cupon->primaryKey => $id));
		$this->set('cupon', $this->Cupon->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cupon->create();
			if ($this->Cupon->save($this->request->data)) {
				$this->Session->setFlash(__('The cupon has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cupon could not be saved. Please, try again.'));
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
		if (!$this->Cupon->exists($id)) {
			throw new NotFoundException(__('Invalid cupon'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cupon->save($this->request->data)) {
				$this->Session->setFlash(__('The cupon has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cupon could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cupon.' . $this->Cupon->primaryKey => $id));
			$this->request->data = $this->Cupon->find('first', $options);
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
		$this->Cupon->id = $id;
		if (!$this->Cupon->exists()) {
			throw new NotFoundException(__('Invalid cupon'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cupon->delete()) {
			$this->Session->setFlash(__('Cupon deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Cupon was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Cupon->recursive = 0;
		$this->set('cupons', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Cupon->exists($id)) {
			throw new NotFoundException(__('Invalid cupon'));
		}
		$options = array('conditions' => array('Cupon.' . $this->Cupon->primaryKey => $id));
		$this->set('cupon', $this->Cupon->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Cupon->create();
			if ($this->Cupon->save($this->request->data)) {
				$this->Session->setFlash(__('The cupon has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cupon could not be saved. Please, try again.'));
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
		if (!$this->Cupon->exists($id)) {
			throw new NotFoundException(__('Invalid cupon'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cupon->save($this->request->data)) {
				$this->Session->setFlash(__('The cupon has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cupon could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cupon.' . $this->Cupon->primaryKey => $id));
			$this->request->data = $this->Cupon->find('first', $options);
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
		$this->Cupon->id = $id;
		if (!$this->Cupon->exists()) {
			throw new NotFoundException(__('Invalid cupon'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cupon->delete()) {
			$this->Session->setFlash(__('Cupon deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Cupon was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
