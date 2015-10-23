<?php
App::uses('AppController', 'Controller');
/**
 * PriceSettings Controller
 *
 * @property PriceSetting $PriceSetting
 */
class PriceSettingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->PriceSetting->recursive = 0;
		$this->set('priceSettings', $this->paginate());*/
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
		/*if (!$this->PriceSetting->exists($id)) {
			throw new NotFoundException(__('Invalid price setting'));
		}
		$options = array('conditions' => array('PriceSetting.' . $this->PriceSetting->primaryKey => $id));
		$this->set('priceSetting', $this->PriceSetting->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->PriceSetting->create();
			if ($this->PriceSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The price setting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The price setting could not be saved. Please, try again.'));
			}
		}
		$cities = $this->PriceSetting->City->find('list');
		$this->set(compact('cities'));*/
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
		/*if (!$this->PriceSetting->exists($id)) {
			throw new NotFoundException(__('Invalid price setting'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PriceSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The price setting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The price setting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PriceSetting.' . $this->PriceSetting->primaryKey => $id));
			$this->request->data = $this->PriceSetting->find('first', $options);
		}
		$cities = $this->PriceSetting->City->find('list');
		$this->set(compact('cities'));*/
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
		/*$this->PriceSetting->id = $id;
		if (!$this->PriceSetting->exists()) {
			throw new NotFoundException(__('Invalid price setting'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PriceSetting->delete()) {
			$this->Session->setFlash(__('Price setting deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Price setting was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}
	
	/**
	* ADMIN SECTION START HERE
	*/

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		$this->PriceSetting->recursive = 0;
		$pricesetcond = array('PriceSetting.company_id'=>$company_id);
		$this->paginate = array(
			'conditions'=>$pricesetcond,
			'offset'=>'0',
			'limit'=>30
		);
		$this->set('priceSettings', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		/*$this->adminsessionvalidation();
		if (!$this->PriceSetting->exists($id)) {
			throw new NotFoundException(__('Invalid price setting'));
		}
		$options = array('conditions' => array('PriceSetting.' . $this->PriceSetting->primaryKey => $id));
		$this->set('priceSetting', $this->PriceSetting->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if ($this->request->is('post')) {
			$this->PriceSetting->create();
			$this->request->data['PriceSetting']['company_id']=$company_id;
			if ($this->PriceSetting->save($this->request->data)) {
				//now update the city as set price setting
				$this->PriceSetting->City->id = $this->request->data['PriceSetting']['city_id'];
				$this->PriceSetting->City->saveField('ispricesetting','1');
				$this->Session->setFlash(__('The price setting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The price setting could not be saved. Please, try again.'));
			}
		}
		$cities = $this->PriceSetting->City->find('list',array('conditions'=>array('City.ispricesetting'=>'0','City.is_active'=>'1','City.company_id'=>$company_id)));
		$this->set(compact('cities'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->PriceSetting->exists($id)) {
			//throw new NotFoundException(__('Invalid price setting'));
			$this->admininvalidpath();
		}
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if ($this->request->is('post') || $this->request->is('put')) {
			//
			if ($this->PriceSetting->save($this->request->data)) {
				//if city id change then
				if($this->request->data['old_city_id']!=$this->request->data['PriceSetting']['city_id']){
					//now update the city add set
					$this->PriceSetting->City->id = $this->request->data['PriceSetting']['city_id'];
					$this->PriceSetting->City->saveField('ispricesetting','1');
					// now remove old city is as configure
					$this->PriceSetting->City->id = $this->request->data['old_city_id'];
					$this->PriceSetting->City->saveField('ispricesetting','0');
					
					//$this->PriceSetting->City->updateAll(array('City.ispricesetting'=>'0'),array('City.id'=>$this->request->data['old_city_id']));
				}
				$this->Session->setFlash(__('The price setting has been updated'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The price setting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PriceSetting.' . $this->PriceSetting->primaryKey => $id));
			$this->request->data = $this->PriceSetting->find('first', $options);
			$cities = $this->PriceSetting->City->find('list',array('conditions'=>array('City.id'=>$this->request->data['PriceSetting']['city_id'],'City.ispricesetting'=>array('0','1'),'City.is_active'=>'1','City.company_id'=>$company_id)));
			$this->set(compact('cities'));
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
		$this->adminsessionvalidation();
		$this->PriceSetting->id = $id;
		if (!$this->PriceSetting->exists()) {
			//throw new NotFoundException(__('Invalid price setting'));
			$this->admininvalidpath();
		}
		$this->request->onlyAllow('post', 'delete');
		$this->PriceSetting->unbindModel(array('belongsTo'=>array('City')));
		$pricesetting = $this->PriceSetting->find('first',array('conditions'=>array('PriceSetting.id'=>$id)));
		if ($this->PriceSetting->delete()) {
			//now update the city add set
			$this->PriceSetting->City->id = $pricesetting['PriceSetting']['city_id'];
			$this->PriceSetting->City->saveField('ispricesetting','0');
			$this->Session->setFlash(__('Price setting deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Price setting was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
