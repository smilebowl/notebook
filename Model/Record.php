<?php
App::uses('AppModel', 'Model');
/**
 * Record Model
 *
 * @property Recordcategory $Recordcategory
 */
class Record extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'eventdate' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Recordcategory' => array(
			'className' => 'Recordcategory',
			'foreignKey' => 'recordcategory_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
