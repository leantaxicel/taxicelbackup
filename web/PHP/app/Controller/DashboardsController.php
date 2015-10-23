<?php
App::uses('AppController', 'Controller');
/**
 * Dashboards Controller
 *
 * @property User $User
 */
class DashboardsController extends AppController {

public $layout = "admindashboardLayout";
public $helpers = array ('Session','App');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {	
		if( !$this->Session->check('admin_id') ) {
			$this->redirect( array('controller' => 'Pages', 'action' => 'login', 'admin' => true) );
		}
	}
	
	public function logout(){
		//$this->Session->destroy();
		$this->Session->delete('admin_id');
		$this->Session->delete('username');
		$this->Session->delete('superadmin');
		$this->Session->delete('sitelogo');
		$this->Session->delete('siteurl');
		$this->Session->delete('siteid');
		$this->admin_index();
		//$this->redirect( array('controller'=>'Pages','action' => 'login', 'admin' => true) );
	}
	
	public function driver_index() {
		$this->layout="driverdashboardLayout";
		if( !$this->Session->check('driver_id') ) {
			$this->redirect( array('controller' => 'Pages', 'action' => 'login', 'driver' => true) );
		}
	}
	
	public function logout2(){
		//$this->layout="driverdashboardLayout";
		//$this->Session->destroy()
		$this->Session->delete('driver_id');
		$this->Session->delete('dusername');
		if($this->Session->check('dcomlogo')){
			$this->Session->delete('dcomlogo');
		}
		$this->driver_index();
		//$this->redirect( array('controller'=>'Pages','action' => 'login', 'driver' => true) );
	}
	
}