<?php
App::uses('AppController', 'Controller');
/**
 * UserRideRatings Controller
 *
 * @property UserRideRating $UserRideRating
 */
class UserRideRatingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->UserRideRating->recursive = 0;
		$this->set('userRideRatings', $this->paginate());*/
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
		/*if (!$this->UserRideRating->exists($id)) {
			throw new NotFoundException(__('Invalid user ride rating'));
		}
		$options = array('conditions' => array('UserRideRating.' . $this->UserRideRating->primaryKey => $id));
		$this->set('userRideRating', $this->UserRideRating->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->UserRideRating->create();
			if ($this->UserRideRating->save($this->request->data)) {
				$this->Session->setFlash(__('The user ride rating has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user ride rating could not be saved. Please, try again.'));
			}
		}
		$rides = $this->UserRideRating->Ride->find('list');
		$customers = $this->UserRideRating->Customer->find('list');
		$drivers = $this->UserRideRating->Driver->find('list');
		$this->set(compact('rides', 'customers', 'drivers'));*/
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
		/*if (!$this->UserRideRating->exists($id)) {
			throw new NotFoundException(__('Invalid user ride rating'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserRideRating->save($this->request->data)) {
				$this->Session->setFlash(__('The user ride rating has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user ride rating could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserRideRating.' . $this->UserRideRating->primaryKey => $id));
			$this->request->data = $this->UserRideRating->find('first', $options);
		}
		$rides = $this->UserRideRating->Ride->find('list');
		$customers = $this->UserRideRating->Customer->find('list');
		$drivers = $this->UserRideRating->Driver->find('list');
		$this->set(compact('rides', 'customers', 'drivers'));*/
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
		/*$this->UserRideRating->id = $id;
		if (!$this->UserRideRating->exists()) {
			throw new NotFoundException(__('Invalid user ride rating'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserRideRating->delete()) {
			$this->Session->setFlash(__('User ride rating deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User ride rating was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->UserRideRating->recursive = 0;
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		$rattingcond = array('UserRideRating.company_id'=>$company_id);
		$this->paginate= array(
			'conditions'=>$rattingcond,
			'offset'=>'0',
			'limit'=>10
		);
		$this->set('userRideRatings', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		/*if (!$this->UserRideRating->exists($id)) {
			throw new NotFoundException(__('Invalid user ride rating'));
		}
		$options = array('conditions' => array('UserRideRating.' . $this->UserRideRating->primaryKey => $id));
		$this->set('userRideRating', $this->UserRideRating->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		/*if ($this->request->is('post')) {
			$this->UserRideRating->create();
			if ($this->UserRideRating->save($this->request->data)) {
				$this->Session->setFlash(__('The user ride rating has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user ride rating could not be saved. Please, try again.'));
			}
		}
		$rides = $this->UserRideRating->Ride->find('list');
		$customers = $this->UserRideRating->Customer->find('list');
		$drivers = $this->UserRideRating->Driver->find('list');
		$this->set(compact('rides', 'customers', 'drivers'));*/
		$this->homepageredirect();
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		/*if (!$this->UserRideRating->exists($id)) {
			throw new NotFoundException(__('Invalid user ride rating'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserRideRating->save($this->request->data)) {
				$this->Session->setFlash(__('The user ride rating has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user ride rating could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserRideRating.' . $this->UserRideRating->primaryKey => $id));
			$this->request->data = $this->UserRideRating->find('first', $options);
		}
		$rides = $this->UserRideRating->Ride->find('list');
		$customers = $this->UserRideRating->Customer->find('list');
		$drivers = $this->UserRideRating->Driver->find('list');
		$this->set(compact('rides', 'customers', 'drivers'));*/
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
		$this->UserRideRating->id = $id;
		if (!$this->UserRideRating->exists()) {
			//throw new NotFoundException(__('Invalid user ride rating'));
			$this->admininvalidpath();
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserRideRating->delete()) {
			$this->Session->setFlash(__('User ride rating deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User ride rating was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
