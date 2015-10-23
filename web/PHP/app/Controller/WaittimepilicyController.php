<?php
App::uses('AppController', 'Controller');
/**
 * Waittimepilicy Controller
 *
 * @property User $User
 */
class WaittimepilicyController extends AppController {

public $layout = "indexLayout";
public $helpers = array ('Session','App');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->blogFooter();
	}
}