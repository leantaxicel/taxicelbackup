<?php
App::uses('AppController', 'Controller');
/**
 * Aboutus Controller
 *
 * @property User $User
 */
class AboutusController extends AppController {

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