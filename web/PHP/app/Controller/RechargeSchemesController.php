<?php
App::uses('AppController', 'Controller');
/**
 * RechargeSchemesController Controller
 *
 * @property RechargeSchemesController $RechargeScheme
 */
class RechargeSchemesController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->RechargeScheme->recursive = 0;
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		$rechargecond = array('RechargeScheme.company_id'=>$company_id);
		$this->paginate=array(
			'conditions'=>$rechargecond,
			'offset'=>'0',
			'limit'=>30
		);
		$this->set('rechargeschemes', $this->paginate());
	}
	
	function admin_schemestatuschange(){
		header('Content-Type:application/json');
		$status=0;
		$curstatus = 0;
		$statustxt = "Desable";
		//if($this->request->is('post')){
			$id = $_POST['id'];
			$curstatus = ($_POST['curstatus']==1)?0:1;
			$statustxt = ($curstatus==1)?"Active":"Desable";
			//now update the model data
			$this->RechargeScheme->id=$id;
			$this->RechargeScheme->saveField('isactive',$curstatus);
			$status=1;
		//}
		die(json_encode(array('status'=>$status,'rowstatus'=>$curstatus,'rowstatustxt'=>$statustxt)));
	}
	
/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id=null){
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		
		if (!$this->RechargeScheme->exists($id)) {
			//throw new NotFoundException(__('Invalid driver commission'));
			$this->Session->setFlash(__("Invalid Recharge Scheme"));
			$this->redirect(array('action'=>'index','admin'=>true));
		}
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		
		if ($this->request->is('post') || $this->request->is('put')) {
			//validate the is active value
			$this->request->data['RechargeScheme']['isactive']=($this->request->data['RechargeScheme']['isactive']>0)?1:0;
			$this->request->data['RechargeScheme']['company_id']=$company_id;
			if ($this->RechargeScheme->save($this->request->data)) {
				$this->Session->setFlash(__('The Recharge Scheme Change has been saved'));
				$this->redirect(array('action' => 'index','admin'=>true));
			} else {
				$this->Session->setFlash(__('The Recharge Scheme could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RechargeScheme.id' => $id,'RechargeScheme.company_id'=>$company_id));
			$this->request->data = $this->RechargeScheme->find('first', $options);
		}
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
			$this->RechargeScheme->create();
			//validate the is active value
			$this->request->data['RechargeScheme']['isactive']=(isset($this->request->data['RechargeScheme']['isactive']) && $this->request->data['RechargeScheme']['isactive']>0)?1:0;
			$this->request->data['RechargeScheme']['company_id']=$company_id;
			if ($this->RechargeScheme->save($this->request->data)) {
				$this->Session->setFlash(__('The Recharge Scheme has been saved'));
				$this->redirect(array('action' => 'index','admin'=>true));
			} else {
				$this->Session->setFlash(__('The Recharge Scheme  could not be saved. Please, try again.'));
			}
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
		$this->layout="adminLayout";
		$this->RechargeScheme->id = $id;
		if (!$this->RechargeScheme->exists()) {
			//throw new NotFoundException(__('Invalid driver commission'));
			$this->Session->setFlash(__("Invalid Recharge Scheme"));
			$this->redirect(array('action'=>'index','admin'=>true));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RechargeScheme->delete()) {
			$this->Session->setFlash(__('Recharge Scheme deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Recharge Scheme was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
