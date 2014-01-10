<?php
class Softdelete extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'calendarcategories' => array(
					'deleted' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'after' => 'created'),
					'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'after' => 'deleted'),
				),
				'memocategories' => array(
					'deleted' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'after' => 'created'),
					'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'after' => 'deleted'),
				),
				'recordcategories' => array(
					'deleted' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'after' => 'created'),
					'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'after' => 'deleted'),
				),
				'todocategories' => array(
					'deleted' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'after' => 'created'),
					'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'after' => 'deleted'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'calendarcategories' => array('deleted', 'deleted_date',),
				'memocategories' => array('deleted', 'deleted_date',),
				'recordcategories' => array('deleted', 'deleted_date',),
				'todocategories' => array('deleted', 'deleted_date',),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
