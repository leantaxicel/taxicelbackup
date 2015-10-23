<?php
App::uses('AppModel', 'Model');
/**
 * CustomerCustom Model
 *
 * @property User $User
 */
class CustomerCustom extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'user_image';


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
		)
	);
}
