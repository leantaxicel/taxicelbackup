<?php
App::uses('AppModel', 'Model');
/**
 * UserRideCommition Model
 *
 * @property Ride $Ride
 * @property User $Customer
 * @property User $Driver
 */
class UserRideCommition extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'customer_rating';


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
		),
		/* 'Customer' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => array('Customer.user_type'=>'2'),
			'fields' => '',
			'order' => ''
		), */
		 'Driver' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => array('Driver.user_type'=>'1'),
			'fields' => '',
			'order' => ''
		) 
	);
}
