<?php
App::uses('AppController', 'Controller');
/**
 * Companies Controller
 *
 * @property Company $Company
 */
class CompaniesController extends AppController {
public $components = array('Paginator','Session','Thumb');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->Company->recursive = 0;
		$this->set('companies', $this->paginate());*/
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
		/*if (!$this->Company->exists($id)) {
			throw new NotFoundException(__('Invalid company'));
		}
		$options = array('conditions' => array('Company.' . $this->Company->primaryKey => $id));
		$this->set('company', $this->Company->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->Company->create();
			if ($this->Company->save($this->request->data)) {
				$this->Session->setFlash(__('The company has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.'));
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
		/*if (!$this->Company->exists($id)) {
			throw new NotFoundException(__('Invalid company'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Company->save($this->request->data)) {
				$this->Session->setFlash(__('The company has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Company.' . $this->Company->primaryKey => $id));
			$this->request->data = $this->Company->find('first', $options);
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
		/*$this->Company->id = $id;
		if (!$this->Company->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Company->delete()) {
			$this->Session->setFlash(__('Company deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Company was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}
	
/**
*ADMIN SECTION START FROM HERE
*/

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->Company->recursive = 0;
		$condition = array('Company.is_deleted'=>'0');
		$limit=20;
		if(!$this->Session->check('superadmin')){
			$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
			$condition['Company.id']=$company_id;
		}
		$order = array('Company.id'=>'DESC');
		$this->Paginator->settings=array(
			'conditions'=>$condition,
			'order'=>$order,
			'offset'=>'0',
			'limit'=>$limit
		);
		$this->set('companies', $this->Paginator->paginate());
		//$this->set('companies', $this->paginate());
	}

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
		if (!$this->Company->exists($id)) {
			//throw new NotFoundException(__('Invalid company'));
			$this->Session->setFlash(__('TInvalid company'));
			$this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('Company.' . $this->Company->primaryKey => $id));
		$this->set('company', $this->Company->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->adminsessionvalidation();
		$this->userissuperadmin();
		$this->layout="adminLayout";
		if ($this->request->is('post')) {
			$this->Company->create();
			
			// SAVING IOS GALLERY IMAGE
			if(isset($this->request->data['Company']['company_logo']['name']) && $this->request->data['Company']['company_logo']['name']!=''){
				$comLogo = trim(time().str_replace(' ','_',$this->request->data['Company']['company_logo']['name']));
				if(move_uploaded_file($this->request->data['Company']['company_logo']['tmp_name'],WWW_ROOT."companyLogo/".$comLogo)){
					$source = WWW_ROOT."companyLogo/".$comLogo;
					$destination = WWW_ROOT."companyLogo/thumb_".$comLogo;
					$this->Thumb->createthumbs($source,$destination,100,80);
				}
				else{
					$comLogo='';
				}
			}else{
				$comLogo='';
			}
			// End upload Images
			
			// PASSING THE IMAGE NAME TO THE DATABASE
			$this->request->data['Company']['company_logo'] = $comLogo;
			$this->request->data['Company']['create_date'] = date("Y-m-d H:i:s");
			
			if ($this->Company->save($this->request->data)) {
				$this->Session->setFlash(__('The company has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.'));
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
		if (!$this->Company->exists($id)) {
			//throw new NotFoundException(__('Invalid company'));
			$this->Session->setFlash(__('Invalid company'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			//old image 
			$redult =$this->Company->find('first',array(
				'conditions'=>array('Company.id'=>$id)
			));
			$oldimg = $redult['Company']['company_logo'];
			
			// SAVING IOS GALLERY IMAGE
			if(isset($this->request->data['Company']['company_logo']['name']) && $this->request->data['Company']['company_logo']['name']!=''){
				$comLogo = trim(time().str_replace(' ','_',$this->request->data['Company']['company_logo']['name']));
				if(move_uploaded_file($this->request->data['Company']['company_logo']['tmp_name'],WWW_ROOT."companyLogo/".$comLogo)){
					$source = WWW_ROOT."companyLogo/".$comLogo;
					$destination = WWW_ROOT."companyLogo/thumb_".$comLogo;
					$this->Thumb->createthumbs($source,$destination,100,80);
					
					if($oldimg!=''){
						$oldimgpath = WWW_ROOT."companyLogo/".$oldimg;
						if(file_exists($oldimgpath)){
							unlink($oldimgpath);
						}
					}
					
					
				}
				else{
					$comLogo='';
				}
			}else{
				$comLogo=$redult['Company']['company_logo'];
			}
			// End upload Images
			
			// PASSING THE IMAGE NAME TO THE DATABASE
			$this->request->data['Company']['company_logo'] = $comLogo;
		
		
			if ($this->Company->save($this->request->data)) {
				$this->Session->setFlash(__('The company has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Company.' . $this->Company->primaryKey => $id));
			$this->request->data = $this->Company->find('first', $options);
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
		$this->userissuperadmin();
		$this->Company->id = $id;
		if (!$this->Company->exists()) {
			//throw new NotFoundException(__('Invalid company'));
			$this->Session->setFlash(__('TInvalid company'));
			$this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Company->delete()) {
			$this->Session->setFlash(__('Company deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Company was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function admin_administrator($id = null){
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->Company->id = $id;
		if (!$this->Company->exists()) {
			$this->Session->setFlash(__('Invalid company'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post')) {
			$this->loadModel('User');
			$this->User->create();
			$this->request->data['User']['reg_date']=date("Y-m-d G:i:s");
			$this->request->data['User']['pass']=md5($this->request->data['User']['pass']);
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The company Admin user has been saved'));
				$this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash(__('The company Admin User could not be saved. Please, try again.'));
			}
		}
		$this->set('company_id',$id);
	}
	
	function userissuperadmin(){
		if(!$this->Session->check('superadmin') || $this->Session->check('superadmin')!=1){
			$this->redirect(array('controller'=>'Dashboards','admin'=>true));	
		}
	}
	
	function admin_administratorchange($id = null){
		$this->adminsessionvalidation();
		$this->userissuperadmin();
		$this->Company->id = $id;
		if (!$this->Company->exists()) {
			$this->Session->setFlash(__('Invalid company'));
			$this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('Company.' . $this->Company->primaryKey => $id));
		$company = $this->Company->find('first', $options);
		if(isset($company['Company']['id'])){
			$companylogos=$company['Company']['company_logo'];
			$companysiteurl=$company['Company']['website'];
			$companyid = $company['Company']['id'];
			$this->Session->write('sitelogo',$companylogos);
			$this->Session->write('siteurl',$companysiteurl);
			$this->Session->write('siteid',$companyid);
		}
		$this->redirect(array('action' => 'index'));
	}
	function admin_administratorchangenormal($id = null){
		$this->adminsessionvalidation();
		$this->userissuperadmin();
		$this->loadModel('User');
		$this->User->bindModel(array(
			'belongsTo'=>array(
				'Company' => array(
					'className' => 'Company',
					'foreignKey' => 'company_id',
					'dependent' => false,
					'conditions' => array('Company.is_deleted'=>'0'),
				),
			)
		));
		$findUser = $this->User->find('first',array(
			'conditions'=> array('User.id'=>$this->Session->read('admin_id'),'User.user_type'=>'0')
		));
		
		if ( $findUser ){
			$username=$findUser['User']['username'];
			$companylogos="";
			$companysiteurl="";
			$companyid='';
			//if found the company details
			if(isset($findUser['Company']['id'])){
				if($findUser['Company']['company_logo']!=''){
					$companylogos=$findUser['Company']['company_logo'];
					$companysiteurl=$findUser['Company']['website'];
					$companyid = $findUser['Company']['id'];
				}
			}
			if($findUser['User']['is_super_admin']==1){
				$this->Session->write('superadmin',1);
			}
			$id=$findUser['User']['id'];
			$this->Session->write('sitelogo',$companylogos);
			$this->Session->write('siteurl',$companysiteurl);
			$this->Session->write('siteid',$companyid);
			//$this->Session->write('username',$username);
			//$this->Session->write('admin_id', $id);
		}
		$this->redirect(array('action' => 'index'));
	}
	
	public function admin_adminuser(){
		$this->adminsessionvalidation();
		$this->userissuperadmin();
		$this->layout="adminLayout";
		$this->loadModel('User');
		$this->User->unbindModel(array('hasOne'=>array('CustomerCustom','VehicleDetail','DriverCustom'),
					       'hasMany'=>array('UserCreditDetail','CustomerRide','DriverRide')));
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		$users = $this->User->find('all',array('conditions'=>array('User.user_type'=>'0','User.company_id'=>$company_id)));
		$this->set('users',$users);
	}
}
