<?php
App::uses('Cupon', 'Model');

/**
 * Cupon Test Case
 *
 */
class CuponTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cupon'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cupon = ClassRegistry::init('Cupon');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cupon);

		parent::tearDown();
	}

}
