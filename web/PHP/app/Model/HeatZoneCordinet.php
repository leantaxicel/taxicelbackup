<?php
App::uses('AppModel', 'Model');
/**
 * HeatZoneCordinet Model
 *
 * @property HeatZone $HeatZone
 */
class HeatZoneCordinet extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'HeatZone' => array(
			'className' => 'HeatZone',
			'foreignKey' => 'heat_zone_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
