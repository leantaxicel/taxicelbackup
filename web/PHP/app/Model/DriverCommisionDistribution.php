<?php
App::uses('AppModel', 'Model');
/**
 * DriverCommisionDistribution Model
 *
 * @property DriverCommisionDistribution $DriverCommisionDistribution
 */
class DriverCommisionDistribution extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
        
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
            'min_range' => array(
                'notempty' => array(
                    'rule' => array('notempty'),
                    //'message' => 'Your custom message here',
                    //'allowEmpty' => false,
                    //'required' => false,
                    //'last' => false, // Stop validation after this rule
                    //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'max_range'=>array(
                'notempty' => array(
                    'rule' => array('notempty'),
                    //'message' => 'Your custom message here',
                    //'allowEmpty' => false,
                    //'required' => false,
                    //'last' => false, // Stop validation after this rule
                    //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'commision_per'=>array(
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
