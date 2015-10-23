<?php
App::uses('AppController', 'Controller');
/**
 * Cancellation Controller
 *
 * @property User $User
 */
class CancellationpolicyController extends AppController {

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