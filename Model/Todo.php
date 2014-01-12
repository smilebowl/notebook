<?php
App::uses('AppModel', 'Model');
/**
 * Todo Model
 *
 * @property Todocategory $Todocategory
 */
class Todo extends AppModel {

	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'todocategory_id' => array('type' => 'value'),
		'title' => array('type' => 'like'),
		'start' => array('type' => 'value', 'field' => 'completed >='),
		'end' => array('type' => 'value', 'field' => 'completed <='),
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
//		'title' => array(
//			'notEmpty' => array(
//				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Todocategory' => array(
			'className' => 'Todocategory',
			'foreignKey' => 'todocategory_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => true,
		)
	);
}
