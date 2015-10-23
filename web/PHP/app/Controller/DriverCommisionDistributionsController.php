<?php
App::uses('AppController', 'Controller');
/**
 * DriverCommisionDistributions Controller
 *
 * @property DriverCommisionDistribution $DriverCommisionDistribution
 */
class DriverCommisionDistributionsController extends AppController {
    /**
     *ADMIN SECTION WORK DONE START FROM HERE
     */

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
                $this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->DriverCommisionDistribution->recursive = 0;
                $company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
                $this->paginate = array(
                    'conditions'=>array('DriverCommisionDistribution.is_deleted'=>'0','DriverCommisionDistribution.company_id'=>$company_id),
                    'offset'=>'0',
                    'limit'=>30
                );
		$this->set('driverCommisionDistributions', $this->paginate());
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
                $this->DriverCommisionDistribution->create();
                $this->request->data['DriverCommisionDistribution']['company_id']=$company_id;
                //validate
                $min_range = $this->request->data['DriverCommisionDistribution']['min_range'];
                $max_range = $this->request->data['DriverCommisionDistribution']['max_range'];
                $commision_per = $this->request->data['DriverCommisionDistribution']['commision_per'];
                if($min_range>=$max_range){
                    $this->Session->setFlash(__('Range Properly not set'));
                    //$options = array('conditions' => array('DriverCommisionDistribution.' . $this->DriverCommisionDistribution->primaryKey => $id));
                    //$this->request->data = $this->DriverCommisionDistribution->find('first', $options);
                }
                elseif($commision_per=='' || $commision_per==0){
                    $this->Session->setFlash(__('Commision Properly not set'));
                }
                else{
                    if ($this->DriverCommisionDistribution->save($this->request->data)) {
                        $this->Session->setFlash(__('The Driver Commision has been saved'));
                        $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The city could not be saved. Please, try again.'));
                    }
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
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->DriverCommisionDistribution->exists($id)) {
			//throw new NotFoundException(__('Invalid Driver Commisions'));
                        $this->Session->setFlash(__('Invalid Driver Commisions'));
                        $this->redirect(array('action' => 'index'));
		}
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['DriverCommisionDistribution']['company_id']=$company_id;
                        //do validation
                        $min_range = $this->request->data['DriverCommisionDistribution']['min_range'];
                        $max_range = $this->request->data['DriverCommisionDistribution']['max_range'];
                        $commision_per = $this->request->data['DriverCommisionDistribution']['commision_per'];
                        if($min_range>=$max_range){
                            $this->Session->setFlash(__('Range Properly not set'));
                            //$options = array('conditions' => array('DriverCommisionDistribution.' . $this->DriverCommisionDistribution->primaryKey => $id));
                            //$this->request->data = $this->DriverCommisionDistribution->find('first', $options);
                        }
                        elseif($commision_per=='' || $commision_per==0){
                            $this->Session->setFlash(__('Commision Properly not set'));
                        }
                        else{
                            if ($this->DriverCommisionDistribution->save($this->request->data)) {
				$this->Session->setFlash(__('The Driver commisions has been updated'));
				$this->redirect(array('action' => 'index'));
                            } else {
                                    $this->Session->setFlash(__('The city could not be saved. Please, try again.'));
                            }
                        }
			
		} else {
			$options = array('conditions' => array('DriverCommisionDistribution.' . $this->DriverCommisionDistribution->primaryKey => $id,'DriverCommisionDistribution.company_id'=>$company_id));
			$this->request->data = $this->DriverCommisionDistribution->find('first', $options);
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
		$this->DriverCommisionDistribution->id = $id;
		if (!$this->DriverCommisionDistribution->exists()) {
			//throw new NotFoundException(__('Invalid city'));
				$this->Session->setFlash(__('Invalid Driver Commisions'));
				$this->redirect(array('action' => 'index'));
		}
		$this->request->data['DriverCommisionDistribution']['is_deleted']=1;
		if ($this->DriverCommisionDistribution->save($this->request->data)) {
			$this->Session->setFlash(__('Driver Commision deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Driver Commission was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_changestatus
 *
 * 
 */
    public function admin_changestatus(){
        header('Content-Type:application/json');
        $returnarr = array('status'=>'0','txt'=>'');
        $rowid = (isset($_POST['rowid']) && $_POST['rowid']>0)?$_POST['rowid']:0;
        $rowstatus = (isset($_POST['currstatus']) && $_POST['currstatus']==0)?1:0;
        if($rowid>0){
                $this->DriverCommisionDistribution->id=$rowid;
                if($this->DriverCommisionDistribution->saveField('is_active',$rowstatus)){
                        $rowstatustxt = ($rowstatus==1)?"Active":"Not Active";
                        die(json_encode(array("status"=>'1','message'=>'update successfully','rowstatustxt'=>$rowstatustxt,'rowstatus'=>$rowstatus)));
                }
        }
        die(json_encode(array('status'=>'0','message'=>'Invalid selection')));
    }
/**
 * ADMIN RELETED WORK DONE END HERE
 */
	
}