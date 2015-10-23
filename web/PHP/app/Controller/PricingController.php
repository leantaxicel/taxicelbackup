<?php
App::uses('AppController', 'Controller');
/**
 * Pricing Controller
 *
 * @property User $User
 */
class PricingController extends AppController {

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