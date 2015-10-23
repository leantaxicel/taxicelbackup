<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 */
class CitiesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->City->recursive = 0;
		$this->set('cities', $this->paginate());*/
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
		/*if (!$this->City->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
		$this->set('city', $this->City->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->City->create();
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'));
			}
		}
		$countries = $this->City->Country->find('list');
		$this->set(compact('countries'));*/
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
		/*if (!$this->City->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
			$this->request->data = $this->City->find('first', $options);
		}
		$countries = $this->City->Country->find('list');
		$this->set(compact('countries'));*/
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
		/*$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->City->delete()) {
			$this->Session->setFlash(__('City deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('City was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}
	
	
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
		$this->City->recursive = 0;
		$citycond = array();
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if($company_id>0){
			$citycond = array('City.company_id'=>$company_id);
		}
		$this->paginate = array(
			'conditions'=>$citycond,
			'offset'=>'0',
			'limit'=>50
		);
		$this->set('cities', $this->paginate());
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
		$this->layout="adminLayout";
		if (!$this->City->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
		$this->set('city', $this->City->find('first', $options));*/
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
		$this->siteconfiguration();
		if ($this->request->is('post')) {
			$address = urlencode($this->request->data['City']['name']);
			$googlegeocodeurl ="https://maps.googleapis.com/maps/api/geocode/json?region=".$this->curentactivecountrycode."&key=".$this->googleServerKey."&address=".$address;
			$result = json_decode(file_get_contents($googlegeocodeurl),true);
			if(strtolower($result['status'])=="ok"){
				//now get the location
				$citylat = $result['results']['0']['geometry']['location']['lat'];
				$citylon = $result['results']['0']['geometry']['location']['lng'];
				$this->request->data['City']['center_lat']=$citylat;
				$this->request->data['City']['center_lon']=$citylon;
			}
			//assign the company
			$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
			$this->request->data['City']['company_id']=$company_id;
			$this->request->data['City']['country_id']='1';
			
			$option = array(
				'conditions'=>array(
					'City.name'=>$this->request->data['City']['name'],
				),
			);
			$cityCount = $this->City->find('count',$option);
			
			if($cityCount>0){
				$this->Session->setFlash(__('This city is already exist. Please, try again.'));
			}
			else{
				$this->City->create();
				if ($this->City->save($this->request->data)) {
					$this->Session->setFlash(__('The city has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The city could not be saved. Please, try again.'));
				}
			}
		}
		//$countries = $this->City->Country->find('list');
		//$this->set(compact('countries'));
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
		if (!$this->City->exists($id)) {
			//throw new NotFoundException(__('Invalid city'));
			$this->redirect(array('controller'=>'Dashboards','admin'=>true));
		}
		$this->siteconfiguration();
		if ($this->request->is('post') || $this->request->is('put')) {
			//get the locaton lat and lon of the city
			$address = urlencode($this->request->data['City']['name']); 
			$googlegeocodeurl ="https://maps.googleapis.com/maps/api/geocode/json?region=".$this->curentactivecountrycode."&key=".$this->googleServerKey."&address=".$address;
			$result = json_decode(file_get_contents($googlegeocodeurl),true);
			if(strtolower($result['status'])=="ok"){
				//now get the location
				$citylat = $result['results']['0']['geometry']['location']['lat'];
				$citylon = $result['results']['0']['geometry']['location']['lng'];
				$this->request->data['City']['center_lat']=$citylat;
				$this->request->data['City']['center_lon']=$citylon;
			}
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been updated'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
			$this->request->data = $this->City->find('first', $options);
		}
		
		//$countries = $this->City->Country->find('list');
		//$this->set(compact('countries'));
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
		$this->City->id = $id;
		if (!$this->City->exists()) {
			//throw new NotFoundException(__('Invalid city'));
			$this->redirect(array('controller'=>'Dashboards','admin'=>true));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->City->delete()) {
			$this->Session->setFlash(__('City deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('City was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_changestatus method
 * @param string $rowid
 * @return void
 */
	public function admin_changestatus(){
		header('Content-Type:application/json');
		$returnarr = array('status'=>'0','txt'=>'');
		$rowid = (isset($_POST['rowid']) && $_POST['rowid']>0)?$_POST['rowid']:0;
		$rowstatus = (isset($_POST['currstatus']) && $_POST['currstatus']==0)?1:0;
		if($rowid>0){
			$this->City->id=$rowid;
			if($this->City->saveField('is_active',$rowstatus)){
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