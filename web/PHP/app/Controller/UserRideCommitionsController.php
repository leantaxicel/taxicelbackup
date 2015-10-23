<?php
App::uses('AppController', 'Controller');
/**
 * UserRideCommitions Controller 
 *
 * @property UserRideCommitions $UserRideCommitions
 */
class UserRideCommitionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	
	/*
		public function index() {
			$this->UserRideCommitions->recursive = 0;
			$this->set('UserRideCommitions', $this->paginate());
		}
	*/
	
	/**
	 * Driver_referalearning method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function driver_referalearning() {
		$this->driversessionchecked();
		$driver_id = $this->Session->read('driver_id');
		$this->layout="driverLayout";
		$option=array(
			'conditions'=>array(
				'UserRideCommition.user_id'=>$driver_id
			),
		);
		$commition=$this->UserRideCommition->find('all',$option);
		
	
		$this->set('commition',$commition);
	}	
	
	

}