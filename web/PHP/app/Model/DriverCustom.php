<?php
App::uses('AppModel', 'Model');
/**
 * DriverCustom Model
 *
 * @property User $User
 */
class DriverCustom extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'user_pic';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'City' => array(
			'className' => 'City',
			'foreignKey' => 'drive_city',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
