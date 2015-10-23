<?php
App::uses('AppModel', 'Model');
/**
 * Rollmaster Model
 *
 */
class Rollmaster extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'rollmaster';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'roll_model';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'roll_model' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
