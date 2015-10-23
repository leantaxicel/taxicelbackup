<?php
App::uses('AppController', 'Controller');
/**
 * HeatZones Controller
 *
 * @property HeatZone $HeatZone
 */
class HeatZonesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->HeatZone->recursive = 0;
		$this->set('heatZones', $this->paginate());*/
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
		/*if (!$this->HeatZone->exists($id)) {
			throw new NotFoundException(__('Invalid heat zone'));
		}
		$options = array('conditions' => array('HeatZone.' . $this->HeatZone->primaryKey => $id));
		$this->set('heatZone', $this->HeatZone->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			
			$this->HeatZone->create();
			if ($this->HeatZone->save($this->request->data)) {
				$this->Session->setFlash(__('The heat zone has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The heat zone could not be saved. Please, try again.'));
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
		/*if (!$this->HeatZone->exists($id)) {
			throw new NotFoundException(__('Invalid heat zone'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->HeatZone->save($this->request->data)) {
				$this->Session->setFlash(__('The heat zone has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The heat zone could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HeatZone.' . $this->HeatZone->primaryKey => $id));
			$this->request->data = $this->HeatZone->find('first', $options);
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
		/*$this->HeatZone->id = $id;
		if (!$this->HeatZone->exists()) {
			throw new NotFoundException(__('Invalid heat zone'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HeatZone->delete()) {
			$this->Session->setFlash(__('Heat zone deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Heat zone was not deleted'));
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
		$this->HeatZone->recursive = 2;
		//company wise
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		$heatcond = array('HeatZone.company_id'=>$company_id);
		if($company_id>0){
			$this->set('heatZones', $this->paginate($heatcond));
		}
		else{
			$this->set('heatZones', $this->paginate());
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
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->HeatZone->exists($id)) {
			//throw new NotFoundException(__('Invalid heat zone'));
			$this->redirect(array('controller'=>'Dashboards','admin'=>true));
		}
		$heatcond =  array('HeatZone.' . $this->HeatZone->primaryKey => $id);
		
		//company wise
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if($company_id>0){
			$heatcond['HeatZone.company_id']=$company_id;
		}
		$options = array('conditions' =>$heatcond);
		$this->set('heatZone', $this->HeatZone->find('first', $options));
		$this->set('id',$id);
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		//pr($this->request->data);
		//company wise
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if($this->request->is('post')){
			//pr($this->request->data);
			//heat_zone array
			$name = $this->request->data['name'];
			$cityid= $this->request->data['city_id'];
			//validation 
			$heatzonearray = array(
				'HeatZone'=>array(
					'city_id'=>$cityid,
					'name'=>$name,
					'create_time'=>time(),
					'company_id'=>$company_id
				)
			);
			if($this->HeatZone->save($heatzonearray)){
				$heatzoneid = $this->HeatZone->id;
				$zonecords = $this->request->data['heatZoneCords'];
				if(is_array($zonecords) && count($zonecords)>0){
					$this->loadModel('HeatZoneCordinet');
					foreach($zonecords as $zonecord){
						$this->HeatZoneCordinet->create();
						$lat = $zonecord['lat'];
						$lon = $zonecord['lon'];
						$name = $zonecord['location'];
						$zonecordsarray = array(
							'HeatZoneCordinet'=>array(
								'heat_zone_id'=>$heatzoneid,
								'lat'=>$lat,
								'long'=>$lon,
								'name'=>$name
							)
						);
						$this->HeatZoneCordinet->save($zonecordsarray);
					}
				}
			}
		}
		//city of that company
		$citycond=array();
		if($company_id>0){
			$citycond=array('City.company_id'=>$company_id);
		}
		$cities = $this->HeatZone->City->find('list',array('conditions'=>$citycond));
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
		if (!$this->HeatZone->exists($id)) {
			//throw new NotFoundException(__('Invalid heat zone'));
			$this->redirect(array('controller'=>'Dashboards','admin'=>true));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->HeatZone->save($this->request->data)) {
				$this->Session->setFlash(__('The heat zone has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The heat zone could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HeatZone.' . $this->HeatZone->primaryKey => $id));
			$this->request->data = $this->HeatZone->find('first', $options);
		}
	}
	/**
	 * admin_getallzones method
	 */
	 public function admin_getallzones(){
		$heatZones = array();
		$heatcords = array();
		//company wise
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		
		if($this->request->is('post')){
			$coditions = array();
			if($company_id>0){
				$coditions = array('HeatZone.company_id'=>$company_id);
			}
			$heatZones = $this->HeatZone->find('all',array('conditions'=>$coditions));
			//pr($heatZones);
			foreach( $heatZones as $key=>$azone ) {
			   $cords = array();
			   foreach( $azone['HeatZoneCordinet'] as $cordkey=>$acord ) {
				$cords[] = array( "lat"=> $acord['lat'],
					 "lon"=> $acord['long'],
					 "location"=> $acord['name'] );
			   }
			   
			   $heatcords[] = array( "zone" => $azone['HeatZone']['name'],
					 "cords" => $cords );
			  }
		}
		die(json_encode(array('status'=>'1','heatzones'=>$heatcords)));
	 }
	 
	 /**
	 * admin_getselectedzones method
	 */
	 public function admin_getselectedzones($id = null){
		$heatZones = array();
		$heatcords = array();
		if($this->request->is('post')){
			//company wise
			$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
			$heatcond = array('HeatZone.id'=>$id);
			if($company_id>0){
				$heatcond['HeatZone.company_id']=$company_id;
			}
			$heatZones = $this->HeatZone->find('first',array('recursive'=>2,
				'conditions'=>$heatcond
			));
			//pr($heatZones);
			
		   $cords = array();
		   foreach( $heatZones['HeatZoneCordinet'] as $cordkey=>$acord ) {
			$cords[] = array( "lat"=> $acord['lat'],
				 "lon"=> $acord['long'],
				 "location"=> $acord['name'] );
		   }
		   
		   $heatcords[] = array( "zone" => $heatZones['HeatZone']['name'],"cords" => $cords );
		}
		die(json_encode(array('status'=>'1','heatzones'=>$heatcords)));
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
		$this->HeatZone->id = $id;
		if (!$this->HeatZone->exists()) {
			//throw new NotFoundException(__('Invalid heat zone'));
			$this->redirect(array('controller'=>'Dashboards','admin'=>true));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HeatZone->delete()) {
			$this->Session->setFlash(__('Heat zone deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Heat zone was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
