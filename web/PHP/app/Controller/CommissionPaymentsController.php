<?php
App::uses('AppController', 'Controller');
/**
 * CommissionPaymentsController Controller
 *
 * @property CommissionPaymentsController $CommissionPayment
 */
class CommissionPaymentsController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($user_id=0) {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->CommissionPayment->recursive = 0;
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		//bind the model with user and scheme
		$this->CommissionPayment->bindModel(array(
			'belongsTo'=>array(
				'User' => array(
					'className' => 'User',
					'foreignKey' => 'user_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
				),
				'RechargeScheme' => array(
					'className' => 'RechargeScheme',
					'foreignKey' => 'scheme_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
				)
			)
		));
		$conditions = array('CommissionPayment.payment_type'=>'1','CommissionPayment.company_id'=>$company_id);
		if($user_id>0){
			$conditions['CommissionPayment.user_id']=$user_id;
		}
		//pr($conditions);
		$this->paginate=array(
			'conditions'=>$conditions,
			'order'=>array('CommissionPayment.id'=>'DESC'),
			'offset'=>'0',
			'limit'=>30
		);
		$this->set('commissionPayments', $this->paginate());
		
		$this->CommissionPayment->User->displayField="email";
		$users = $this->CommissionPayment->User->find('list',array('conditions'=>array('User.user_type'=>'1','User.company_id'=>$company_id)));
		//$users = array_merge(array('0'=>'-----'),$users,false);
		$this->set('users',$users);
		$this->set('selectusers',$user_id);
	}
	
	
	public function admin_payment($user_id=null) {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->CommissionPayment->recursive = 0;
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		//bind the model with user and scheme
		$this->CommissionPayment->bindModel(array(
			'belongsTo'=>array(
				'User' => array(
					'className' => 'User',
					'foreignKey' => 'user_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
				)
			)
		));
		$conditions = array('CommissionPayment.payment_type'=>'2','CommissionPayment.company_id'=>$company_id);
		if($user_id>0){
			$conditions['CommissionPayment.user_id']=$user_id;
			
		}
		//pr($conditions);
		$this->paginate=array(
			'conditions'=>$conditions,
			'order'=>array('CommissionPayment.id'=>'DESC'),
			'offset'=>'0',
			'limit'=>30
		);
		$this->set('commissionpayments', $this->paginate());
		
		$this->CommissionPayment->User->displayField="email";
		$users = $this->CommissionPayment->User->find('list',array('conditions'=>array('User.user_type'=>'1','User.company_id'=>$company_id)));
		$this->set('users',$users);
		$this->set('selectusers',$user_id);
	}
/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id=null){
		/*$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->RechargeScheme->exists($id)) {
			//throw new NotFoundException(__('Invalid driver commission'));
			$this->Session->setFlash(__("Invalid Recharge Scheme"));
			$this->redirect(array('action'=>'index','admin'=>true));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//validate the is active value
			$this->request->data['RechargeScheme']['isactive']=($this->request->data['RechargeScheme']['isactive']>0)?1:0;
			if ($this->RechargeScheme->save($this->request->data)) {
				$this->Session->setFlash(__('The Recharge Scheme Change has been saved'));
				$this->redirect(array('action' => 'index','admin'=>true));
			} else {
				$this->Session->setFlash(__('The Recharge Scheme could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RechargeScheme.id' => $id));
			$this->request->data = $this->RechargeScheme->find('first', $options);
		}*/
	}
	
/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		/*$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if ($this->request->is('post')) {
			$this->RechargeScheme->create();
			//validate the is active value
			$this->request->data['RechargeScheme']['isactive']=($this->request->data['RechargeScheme']['isactive']>0)?1:0;
			if ($this->RechargeScheme->save($this->request->data)) {
				$this->Session->setFlash(__('The Recharge Scheme has been saved'));
				$this->redirect(array('action' => 'index','admin'=>true));
			} else {
				$this->Session->setFlash(__('The Recharge Scheme  could not be saved. Please, try again.'));
			}
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
		/*$this->adminsessionvalidation();
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
		$this->redirect(array('action' => 'index'));*/
	}
}
