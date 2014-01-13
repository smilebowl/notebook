<?php
class Timelog extends CakeMigration {

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
			'create_table' => array(
				'timelogcategories' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'position' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'position'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'deleted' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'comment' => '削除フラグ'),
					'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '削除日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'timelogs' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'timelogcategory_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'カテゴリ'),
					'timelogtask_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'タスク'),
					'workdate' => array('type' => 'date', 'null' => false, 'default' => NULL, 'comment' => '日付'),
					'worktime' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '5,2'),
					'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 256, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '変更日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'timelogtasks' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'position' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'position'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'deleted' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'comment' => '削除フラグ'),
					'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '削除日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'timelogcategories', 'timelogs', 'timelogtasks'
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
