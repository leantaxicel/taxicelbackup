<?php
App::uses('AppController', 'Controller');
/**
 * DriverDocuments Controller
 *
 * @property DriverDocument $DriverDocument
 */
class DriverDocumentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->DriverDocument->recursive = 0;
		$this->set('driverDocuments', $this->paginate());*/
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
		/*if (!$this->DriverDocument->exists($id)) {
			throw new NotFoundException(__('Invalid driver document'));
		}
		$options = array('conditions' => array('DriverDocument.' . $this->DriverDocument->primaryKey => $id));
		$this->set('driverDocument', $this->DriverDocument->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->DriverDocument->create();
			if ($this->DriverDocument->save($this->request->data)) {
				$this->Session->setFlash(__('The driver document has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The driver document could not be saved. Please, try again.'));
			}
		}
		$users = $this->DriverDocument->User->find('list');
		$this->set(compact('users'));*/
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
		/*if (!$this->DriverDocument->exists($id)) {
			throw new NotFoundException(__('Invalid driver document'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DriverDocument->save($this->request->data)) {
				$this->Session->setFlash(__('The driver document has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The driver document could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DriverDocument.' . $this->DriverDocument->primaryKey => $id));
			$this->request->data = $this->DriverDocument->find('first', $options);
		}
		$users = $this->DriverDocument->User->find('list');
		$this->set(compact('users'));*/
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
		/*$this->DriverDocument->id = $id;
		if (!$this->DriverDocument->exists()) {
			throw new NotFoundException(__('Invalid driver document'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DriverDocument->delete()) {
			$this->Session->setFlash(__('Driver document deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Driver document was not deleted'));
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
		$this->DriverDocument->recursive = 0;
		$this->set('driverDocuments', $this->paginate());
	}


/* public function admin_index() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->DriverDocument->recursive = 0;
		
		//$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		
		 if($user_id>0){
		  $condition = array('DriverDocument.user_id'=>$user_id,'DriverDocument.company_id'=>$company_id);
		}
		else{
		  $condition = array('DriverDocument.user_id >='=>$user_id,'DriverDocument.company_id'=>$company_id);
		}
		$this->paginate=array(
			   'conditions'=>$condition,
			   'offset'=>'0',
			   'limit'=>30
		  ); 
		
		$this->set('driverDocuments', $this->paginate());
		//$this->set(compact('users'));
		//$this->set('selecteduser',$user_id);
	}	 */
	
	
/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->DriverDocument->exists($id)) {
			throw new NotFoundException(__('Invalid driver document'));
		}
		$options = array('conditions' => array('DriverDocument.' . $this->DriverDocument->primaryKey => $id));
		$this->set('driverDocument', $this->DriverDocument->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->adminsessionvalidation();
		if ($this->request->is('post')) {
			$this->DriverDocument->create();
			if ($this->DriverDocument->save($this->request->data)) {
				$this->Session->setFlash(__('The driver document has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The driver document could not be saved. Please, try again.'));
			}
		}
		$users = $this->DriverDocument->User->find('list');
		$this->set(compact('users'));
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
		if (!$this->DriverDocument->exists($id)) {
			throw new NotFoundException(__('Invalid driver document'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DriverDocument->save($this->request->data)) {
				$this->Session->setFlash(__('The driver document has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The driver document could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DriverDocument.' . $this->DriverDocument->primaryKey => $id));
			$this->request->data = $this->DriverDocument->find('first', $options);
		}
		$users = $this->DriverDocument->User->find('list');
		$this->set(compact('users'));
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
		$this->DriverDocument->id = $id;
		if (!$this->DriverDocument->exists()) {
			throw new NotFoundException(__('Invalid driver document'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DriverDocument->delete()) {
			$this->Session->setFlash(__('Driver document deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Driver document was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * driver_add method
 *
 * @return void
 */
	public function driver_add() {
		$this->driversessionchecked();
		$this->layout="driverLayout";
		$driver_id = $this->Session->read('driver_id');
		$doccond = array('DriverDocument.user_id'=>$driver_id);
		//model unbind
		$this->DriverDocument->unbindModel(array('belongsTo'=>array('User')));
		$docDetail = $this->DriverDocument->find('first',array('conditions'=>$doccond));
		if ($this->request->is('post')) {
			$docid=0;
			$insurancedoc='';
			$authoritydoc='';
			$licencedoc='';
			$vehicleopdoc='';
			$this->request->data['DriverDocument']['user_id']=$driver_id;
			if(is_array($docDetail) && count($docDetail)>0){
				//driver uploaded docs
				$docid = $docDetail['DriverDocument']['id'];
				$doccond['DriverDocument.id']=$docid;
				//doc old name
				$insurancedoc = $docDetail['DriverDocument']['filename'];
				$authoritydoc = $docDetail['DriverDocument']['filename_auth'];
				$licencedoc = $docDetail['DriverDocument']['filename_lic'];
				$vehicleopdoc = $docDetail['DriverDocument']['filename_oper'];
				$this->request->data['DriverDocument']['id']=$docid;
			}
			
			//insurance doc
			if(isset($this->request->data['DriverDocument']['filename']['name']) && $this->request->data['DriverDocument']['filename']['name']!=''){
				$filename = trim(time().str_replace(' ','_',$this->request->data['DriverDocument']['filename']['name']));
				if(move_uploaded_file($this->request->data['DriverDocument']['filename']['tmp_name'],WWW_ROOT."userDoc/".$filename)){
					//upload succes full
					if($insurancedoc!=''){
						//remove the file from doc
						$doconepath = WWW_ROOT."userDoc/".$insurancedoc;
						if(file_exists($doconepath)){
							unlink($doconepath);
						}
					}
					$insurancedoc = $filename;
				}
			}
			$this->request->data['DriverDocument']['filename'] = $insurancedoc;
			
			// authority doc
			
			if(isset($this->request->data['DriverDocument']['filename_auth']['name']) && $this->request->data['DriverDocument']['filename_auth']['name']!=''){
				$filename_auth = trim(time().str_replace(' ','_',$this->request->data['DriverDocument']['filename_auth']['name']));
				if(move_uploaded_file($this->request->data['DriverDocument']['filename_auth']['tmp_name'],WWW_ROOT."userDoc/".$filename_auth)){
					//upload succes full
					if($authoritydoc!=''){
						//remove the file from doc
						$doconepath = WWW_ROOT."userDoc/".$authoritydoc;
						if(file_exists($doconepath)){
							unlink($doconepath);
						}
					}
					$authoritydoc = $filename_auth;
				}
			}
			$this->request->data['DriverDocument']['filename_auth'] = $authoritydoc;
			
			// licence doc
			
			if(isset($this->request->data['DriverDocument']['filename_lic']['name']) && $this->request->data['DriverDocument']['filename_lic']['name']!=''){
				$filename_lic = trim(time().str_replace(' ','_',$this->request->data['DriverDocument']['filename_lic']['name']));
				if(move_uploaded_file($this->request->data['DriverDocument']['filename_lic']['tmp_name'],WWW_ROOT."userDoc/".$filename_lic)){
					if($licencedoc!=''){
						//remove the file from doc
						$doconepath = WWW_ROOT."userDoc/".$licencedoc;
						if(file_exists($doconepath)){
							unlink($doconepath);
						}
					}
					$licencedoc = $filename_lic;
				}
			}
			$this->request->data['DriverDocument']['filename_lic'] = $licencedoc;
			
			//vehicleop doc Me
			
			if(isset($this->request->data['DriverDocument']['filename_oper']['name']) && $this->request->data['DriverDocument']['filename_oper']['name']!=''){
				$filename_oper = trim(time().str_replace(' ','_',$this->request->data['DriverDocument']['filename_oper']['name']));
				if(move_uploaded_file($this->request->data['DriverDocument']['filename_oper']['tmp_name'],WWW_ROOT."userDoc/".$filename_oper)){
					if($vehicleopdoc!=''){
						//remove the file from doc
						$doconepath = WWW_ROOT."userDoc/".$vehicleopdoc;
						if(file_exists($doconepath)){
							unlink($doconepath);
						}
					}
					$vehicleopdoc = $filename_oper;
				}
			}
			$this->request->data['DriverDocument']['filename_oper'] = $vehicleopdoc;
			//
			//die();
			//Saving Details
			$this->DriverDocument->create();
			if ($this->DriverDocument->save($this->request->data)) {
				$this->Session->setFlash(__('The driver document has been updated'));
				$this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The driver document could not be saved. Please, try again.'));
			}
		}
		$this->set('driverdoccument',$docDetail);
	}
}
