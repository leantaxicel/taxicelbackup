<?php
App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');
/**
 * Contactuses Controller
 *
 * @property Contactus $Contactus
 */
class ContactusesController extends AppController {

public $layout = "indexLayout";
public $helpers = array ('Session','App','Html');
/**
 * index method
 *
 * @return void
 */
	public function index($status = 0) {
		$this->Contactus->recursive = 0;
		$this->set('contactuses', $this->paginate());
		$this->blogFooter();
		$this->set('status',$status);
	}
	
	public function contact(){
		$company_id=1;
		if ($this->request->is('post')) {
			$this->Contactus->create();
			$this->request->data['Contactus']['company_id']=$company_id;
			$email= $this->request->data['Contactus']['email'];
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				//$this->Session->setFlash(__('Invalid Email address.'));
				$this->redirect(array('action' =>'index',2));
			}
			else {
				if ($this->Contactus->save($this->request->data)) {
					$name 	   = $this->request->data['Contactus']['name'];
					$contactno = $this->request->data['Contactus']['contact_no'];
					$descript  = $this->request->data['Contactus']['message'];
					if(!$this->serverDetect()){
						$this->siteconfiguration($company_id);
						// admin email
						$Email = new CakeEmail();
						$Email->from(array($email => $name));
						$Email->to(array($this->adminToEmail));// admin email address
						$Email->subject('You Have a contact request');
						$body='Hello Admin,
							Following user have trying to contact with you.
							Name : '.$name.'
							Email : '.$email.'
							Contact No : '.$contactno.'
							Message Details :'. $descript.'
						
							Thanks,
							'.$name.'
							';	
							
						$Email->send($body);
							
						// user email
						$Email = new CakeEmail();
						$Email->template('contact_us','complaint_email');
						$Email->viewVars(array(
								'mail' 		=> $email,
								'username'	=> $name,
								'mobile'	=> $contactno,
								'descri' 	=> $descript
							));
						$Email->emailFormat('html');
						
						$Email->from(array($this->adminFromEmail));// admin email
						$Email->to($email);
						$Email->subject('You have successfully submit your request');
						
						$Email->send();	
					}	
					
					
					//$this->Session->setFlash(__('The contact has been send.'));
					$this->redirect(array('action' => 'index',1));
				
				} else {
					$this->Session->setFlash(__('The contact could not be saved. Please, try again.'));
				}
			}
		}
		$this->redirect(array('action' =>'index'));
	}

/**
 * replay mail Method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */	
	/* public function replaymail(){
		pr($this->request->data);

	} */	
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		/*if (!$this->Contactus->exists($id)) {
			throw new NotFoundException(__('Invalid contactus'));
		}
		$options = array('conditions' => array('Contactus.' . $this->Contactus->primaryKey => $id));
		$this->set('contactus', $this->Contactus->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->Contactus->create();
			if ($this->Contactus->save($this->request->data)) {
				$this->Session->setFlash(__('The contactus has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contactus could not be saved. Please, try again.'));
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
		/*if (!$this->Contactus->exists($id)) {
			throw new NotFoundException(__('Invalid contactus'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contactus->save($this->request->data)) {
				$this->Session->setFlash(__('The contactus has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contactus could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contactus.' . $this->Contactus->primaryKey => $id));
			$this->request->data = $this->Contactus->find('first', $options);
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
		/*$this->Contactus->id = $id;
		if (!$this->Contactus->exists()) {
			throw new NotFoundException(__('Invalid contactus'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contactus->delete()) {
			$this->Session->setFlash(__('Contactus deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Contactus was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		if( !$this->Session->read('admin_id') ) {
			$this->redirect( array('controller' => 'pages', 'action' => 'login', 'admin' => true) );
		}
		$this->layout="adminLayout";
		$this->Contactus->recursive = 0;
		$this->set('contactuses', $this->paginate());
	}
	
	/**
 * Replay Method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */	
	public function admin_replay($id=null){
		$this->adminsessionvalidation();
		
		if($this->request->is('post') || $this->request->is('put')){
			//pr($this->request->data);
			//get site config
			$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
			//site configurations
			$this->siteconfiguration($company_id);
			
			$id 		=$this->request->data['id'];
			$contactno 	=$this->request->data['txtContact'];
			$email	   	=$this->request->data['txtEmail'];
			$descript  	=$this->request->data['message'];
			$name  		=$this->request->data['name'];
			// user email
			$Email = new CakeEmail();
			$Email->template('replay_mail','complaint_email');
			$Email->viewVars(array(
					'mail' 		=> $email,
					'username'	=> $name,
					'mobile'	=> $contactno,
					'descri' 	=> $descript
				));
			$Email->emailFormat('html');
			$Email->from(array($this->adminFromEmail));// admin email
			//$Email->from(array("taxiceladmin@taxicel.com"));// admin email
			$Email->to($email);
			$Email->subject('Mail from TaxiCel');
			
			if($Email->send()){
				$this->redirect(array('action' => 'index'));
			}else{
				$this->redirect(array('action' => 'index'));
			}
		}else{
			$this->layout="adminLayout";
			$option=array(
				'conditions'=>array(
					'Contactus.id'=>$id
				),
			);
			$Contactus= $this->Contactus->find('first',$option);
			$this->set('Contactus',$Contactus);
		}	
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		/*if (!$this->Contactus->exists($id)) {
			throw new NotFoundException(__('Invalid contactus'));
		}
		$options = array('conditions' => array('Contactus.' . $this->Contactus->primaryKey => $id));
		$this->set('contactus', $this->Contactus->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		/*if ($this->request->is('post')) {
			$this->Contactus->create();
			if ($this->Contactus->save($this->request->data)) {
				$this->Session->setFlash(__('The contactus has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contactus could not be saved. Please, try again.'));
			}
		}*/
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
		/*if (!$this->Contactus->exists($id)) {
			throw new NotFoundException(__('Invalid contactus'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contactus->save($this->request->data)) {
				$this->Session->setFlash(__('The contactus has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contactus could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contactus.' . $this->Contactus->primaryKey => $id));
			$this->request->data = $this->Contactus->find('first', $options);
		}*/
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
		$this->adminsessionvalidation();
		$this->Contactus->id = $id;
		if (!$this->Contactus->exists()) {
			throw new NotFoundException(__('Invalid contactus'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contactus->delete()) {
			$this->Session->setFlash(__('One contact deleted successfully'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Contactus was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
