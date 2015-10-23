<?php
App::uses('AppController', 'Controller');
/**
 * Termcondition Controller
 *
 * @property User $User
 */
class TermconditionController extends AppController {

public $layout = "indexLayout";
public $helpers = array ('Session','App','Html');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->blogFooter();
	}
	public function mobile() {
		$this->layout="mobileLayout";
	}
	
}