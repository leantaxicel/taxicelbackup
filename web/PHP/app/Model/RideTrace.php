<?php
App::uses('AppModel', 'Model');
/**
 * RideTrace Model
 *
 * @property Ride $Ride
 */
class RideTrace extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'ride_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Ride' => array(
			'className' => 'Ride',
			'foreignKey' => 'ride_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
