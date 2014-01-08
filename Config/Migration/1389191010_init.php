<?php
class Init extends CakeMigration {

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
				'calendarcategories' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'position' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'comment' => 'position'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'calendars' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'calendarcategory_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'calendars'),
					'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'start' => array('type' => 'date', 'null' => false, 'default' => NULL, 'comment' => 'dayofevent'),
					'end' => array('type' => 'date', 'null' => true, 'default' => NULL, 'comment' => 'end'),
					'detail' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'detail', 'charset' => 'utf8'),
					'color' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => 'color', 'charset' => 'utf8'),
					'textcolor' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => 'textcolor', 'charset' => 'utf8'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'memocategories' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'position' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'comment' => 'position'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'memos' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'memocategory_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => '分類'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'text' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'テキスト', 'charset' => 'utf8'),
					'xyz' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => 'xyz', 'charset' => 'utf8'),
					'wh' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => 'wh', 'charset' => 'utf8'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'recordcategories' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'position' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'position'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'records' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'recordcategory_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'カテゴリ'),
					'eventdate' => array('type' => 'date', 'null' => false, 'default' => NULL, 'comment' => '日付'),
					'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 512, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'priority' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'priority'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'todocategories' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'position' => array('type' => 'integer', 'null' => false, 'default' => '0'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'todohistories' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'todocategory_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'カテゴリ'),
					'position' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'position'),
					'priority' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'priority'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'completed' => array('type' => 'date', 'null' => true, 'default' => NULL, 'comment' => '完了日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'todos' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
					'todocategory_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'カテゴリ'),
					'position' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'position'),
					'priority' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => '登録日'),
					'completed' => array('type' => 'date', 'null' => true, 'default' => NULL, 'comment' => '完了日'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'calendarcategories', 'calendars', 'memocategories', 'memos', 'recordcategories', 'records', 'todocategories', 'todohistories', 'todos'
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
