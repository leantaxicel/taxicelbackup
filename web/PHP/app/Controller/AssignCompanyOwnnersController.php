<?php
App::uses('AppController', 'Controller');
/**
 * AssignCompanyOwnners Controller
 *
 * @property AssignCompanyOwnner $AssignCompanyOwnner
 */
class AssignCompanyOwnnersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AssignCompanyOwnner->recursive = 0;
		$this->set('assignCompanyOwnners', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AssignCompanyOwnner->exists($id)) {
			throw new NotFoundException(__('Invalid assign company ownner'));
		}
		$options = array('conditions' => array('AssignCompanyOwnner.' . $this->AssignCompanyOwnner->primaryKey => $id));
		$this->set('assignCompanyOwnner', $this->AssignCompanyOwnner->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AssignCompanyOwnner->create();
			if ($this->AssignCompanyOwnner->save($this->request->data)) {
				$this->Session->setFlash(__('The assign company ownner has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assign company ownner could not be saved. Please, try again.'));
			}
		}
		$companies = $this->AssignCompanyOwnner->Company->find('list');
		$users = $this->AssignCompanyOwnner->User->find('list');
		$this->set(compact('companies', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AssignCompanyOwnner->exists($id)) {
			throw new NotFoundException(__('Invalid assign company ownner'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AssignCompanyOwnner->save($this->request->data)) {
				$this->Session->setFlash(__('The assign company ownner has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assign company ownner could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AssignCompanyOwnner.' . $this->AssignCompanyOwnner->primaryKey => $id));
			$this->request->data = $this->AssignCompanyOwnner->find('first', $options);
		}
		$companies = $this->AssignCompanyOwnner->Company->find('list');
		$users = $this->AssignCompanyOwnner->User->find('list');
		$this->set(compact('companies', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AssignCompanyOwnner->id = $id;
		if (!$this->AssignCompanyOwnner->exists()) {
			throw new NotFoundException(__('Invalid assign company ownner'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AssignCompanyOwnner->delete()) {
			$this->Session->setFlash(__('Assign company ownner deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Assign company ownner was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
	$this->layout="adminLayout";
		$this->AssignCompanyOwnner->recursive = 0;
		$this->set('assignCompanyOwnners', $this->paginate());
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
		if (!$this->AssignCompanyOwnner->exists($id)) {
			throw new NotFoundException(__('Invalid assign company ownner'));
		}
		$options = array('conditions' => array('AssignCompanyOwnner.' . $this->AssignCompanyOwnner->primaryKey => $id));
		$this->set('assignCompanyOwnner', $this->AssignCompanyOwnner->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
	$this->layout="adminLayout";
	$this->loadModel('DriverCustom');
		if ($this->request->is('post')) {
			$this->AssignCompanyOwnner->create();
			if ($this->AssignCompanyOwnner->save($this->request->data)) {
			
			// requested data
			$user_id= $this->request->data['AssignCompanyOwnner']['user_id'];
			$company_id= $this->request->data['AssignCompanyOwnner']['company_id'];
				
			// updating driver custom table with company name and ownner status.
			$this->DriverCustom->updateAll(array('DriverCustom.company_id'=>"'".$company_id."'",'DriverCustom.is_owner'=>'1'), array( 'DriverCustom.user_id' =>$user_id ));
		
			$this->Session->setFlash(__('The assign company owner has been saved'));
			$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assign company owner could not be saved. Please, try again.'));
			}
		}
		$companies = $this->AssignCompanyOwnner->Company->find('list');
		$users = $this->AssignCompanyOwnner->User->find('list',array(
			'conditions'=>array('User.user_type'=>'1')
		));
		$this->set(compact('companies', 'users'));
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
		if (!$this->AssignCompanyOwnner->exists($id)) {
			throw new NotFoundException(__('Invalid assign company ownner'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AssignCompanyOwnner->save($this->request->data)) {
				$this->Session->setFlash(__('The assign company ownner has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assign company ownner could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AssignCompanyOwnner.' . $this->AssignCompanyOwnner->primaryKey => $id));
			$this->request->data = $this->AssignCompanyOwnner->find('first', $options);
		}
		$companies = $this->AssignCompanyOwnner->Company->find('list');
		$users = $this->AssignCompanyOwnner->User->find('list',array(
			'conditions'=>array('User.user_type'=>'1')
		));
		$this->set(compact('companies', 'users'));
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
		$this->AssignCompanyOwnner->id = $id;
		if (!$this->AssignCompanyOwnner->exists()) {
			throw new NotFoundException(__('Invalid assign company ownner'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AssignCompanyOwnner->delete()) {
			$this->Session->setFlash(__('Assign company ownner deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Assign company ownner was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
