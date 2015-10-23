<?php
App::uses('AppModel', 'Model');
/**
 * HeatZone Model
 *
 */
class HeatZone extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public $hasMany = array(
		'HeatZoneCordinet' => array(
			'className' => 'HeatZoneCordinet',
			'foreignKey' => 'heat_zone_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
