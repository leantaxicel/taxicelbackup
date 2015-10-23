<?php
App::uses('AppController', 'Controller');
/**
 * PaymentSettings Controller
 *
 * @property PaymentSetting $PaymentSetting
 */
class PaymentSettingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->PaymentSetting->recursive = 0;
		$this->set('paymentSettings', $this->paginate());*/
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
		/*if (!$this->PaymentSetting->exists($id)) {
			throw new NotFoundException(__('Invalid payment setting'));
		}
		$options = array('conditions' => array('PaymentSetting.' . $this->PaymentSetting->primaryKey => $id));
		$this->set('paymentSetting', $this->PaymentSetting->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->PaymentSetting->create();
			if ($this->PaymentSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The payment setting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment setting could not be saved. Please, try again.'));
			}
		}*/
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
		/*if (!$this->PaymentSetting->exists($id)) {
			throw new NotFoundException(__('Invalid payment setting'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PaymentSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The payment setting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment setting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PaymentSetting.' . $this->PaymentSetting->primaryKey => $id));
			$this->request->data = $this->PaymentSetting->find('first', $options);
		}*/
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
		/*$this->PaymentSetting->id = $id;
		if (!$this->PaymentSetting->exists()) {
			throw new NotFoundException(__('Invalid payment setting'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentSetting->delete()) {
			$this->Session->setFlash(__('Payment setting deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Payment setting was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		/*$this->PaymentSetting->recursive = 0;
		$this->set('paymentSettings', $this->paginate());*/
		$this->homepageredirect();
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		/*if (!$this->PaymentSetting->exists($id)) {
			throw new NotFoundException(__('Invalid payment setting'));
		}
		$options = array('conditions' => array('PaymentSetting.' . $this->PaymentSetting->primaryKey => $id));
		$this->set('paymentSetting', $this->PaymentSetting->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->adminsessionvalidation();
		$this->layout = "adminLayout";
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if ($this->request->is('post')) {
			$this->PaymentSetting->create();
			$this->request->data['PaymentSetting']['company_id']=$company_id;
			if ($this->PaymentSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The payment setting has been updated'));
				$this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The payment setting could not be saved. Please, try again.'));
			}
		}
		
		$this->set('paymentSetting', $this->PaymentSetting->find('first',array('conditions'=>array('PaymentSetting.company_id'=>$company_id))));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		/*if (!$this->PaymentSetting->exists($id)) {
			throw new NotFoundException(__('Invalid payment setting'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PaymentSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The payment setting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment setting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PaymentSetting.' . $this->PaymentSetting->primaryKey => $id));
			$this->request->data = $this->PaymentSetting->find('first', $options);
		}*/
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		/*$this->PaymentSetting->id = $id;
		if (!$this->PaymentSetting->exists()) {
			throw new NotFoundException(__('Invalid payment setting'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentSetting->delete()) {
			$this->Session->setFlash(__('Payment setting deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Payment setting was not deleted'));
		$this->redirect(array('action' => 'index'));*/
	}
}
