<?php
App::uses('AppModel', 'Model');
/**
 * Calendar Model
 *
 * @property Calendarcategory $Calendarcategory
 */
class Calendar extends AppModel {

	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'calendarcategory_id' => array('type' => 'value'),
		'start' => array('type' => 'value', 'field' => 'start >='),
		'keyword' => array('type' => 'query', 'method' => 'findword'),
	);
	public function findword($data = array()) {
		$filter = $data['keyword'];
		$cond = array(
			'OR' => array(
				$this->alias . '.title LIKE' => '%' . $filter . '%',
				$this->alias . '.detail LIKE' => '%' . $filter . '%',
			));
		return $cond;
	}


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'start' => array(
			'date' => array(
				'rule' => array('date'),
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
		'Calendarcategory' => array(
			'className' => 'Calendarcategory',
			'foreignKey' => 'calendarcategory_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
