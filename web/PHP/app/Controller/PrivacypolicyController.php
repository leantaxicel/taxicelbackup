<?php
App::uses('AppController', 'Controller');
/**
 * Privacypolicy Controller
 *
 * @property User $User
 */
class PrivacypolicyController extends AppController {

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