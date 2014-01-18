<?php
App::uses('AppModel', 'Model');
/**
 * Timelog Model
 *
 * @property Timelogcategory $Timelogcategory
 * @property Timelogtask $Timelogtask
 */
class Timelog extends AppModel {

	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'timelogcategory_id' => array('type' => 'value'),
		'timelogtask_id' => array('type' => 'value'),
		'start' => array('type' => 'value', 'field' => 'workdate >='),
		'end' => array('type' => 'value', 'field' => 'workdate <='),
		'title' => array('type' => 'like'),
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'timelogcategory_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
//		'timelogtask_id' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
		'workdate' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'worktime' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Timelogcategory' => array(
			'className' => 'Timelogcategory',
			'foreignKey' => 'timelogcategory_id',
			'conditions' => '',
			'fields' => 'id, name',
			'order' => ''
		),
		'Timelogtask' => array(
			'className' => 'Timelogtask',
			'foreignKey' => 'timelogtask_id',
			'conditions' => '',
			'fields' => 'id, name',
			'order' => ''
		)
	);
}
