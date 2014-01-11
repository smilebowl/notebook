<?php 
class NotebookSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $calendarcategories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
		'position' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'position'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '登録日'),
		'deleted' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $calendars = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'calendarcategory_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'calendars'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
		'start' => array('type' => 'date', 'null' => false, 'default' => null, 'comment' => 'dayofevent'),
		'end' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => 'end'),
		'detail' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'detail', 'charset' => 'utf8'),
		'color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => 'color', 'charset' => 'utf8'),
		'textcolor' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => 'textcolor', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '登録日'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $memocategories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
		'position' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'position'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '登録日'),
		'deleted' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $memos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'memocategory_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => '分類'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
		'text' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'テキスト', 'charset' => 'utf8'),
		'xyz' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => 'xyz', 'charset' => 'utf8'),
		'wh' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => 'wh', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '登録日'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $recordcategories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
		'position' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'position'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '登録日'),
		'deleted' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $records = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'recordcategory_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'カテゴリ'),
		'eventdate' => array('type' => 'date', 'null' => false, 'default' => null, 'comment' => '日付'),
		'title' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
		'priority' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'priority'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '登録日'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $schema_migrations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'class' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $todocategories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
		'position' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'position'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '登録日'),
		'deleted' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $todohistories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 256, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
		'todocategory_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'カテゴリ'),
		'position' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'position'),
		'priority' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'priority'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '登録日'),
		'completed' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => '完了日'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $todos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 256, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'charset' => 'utf8'),
		'todocategory_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'カテゴリ'),
		'position' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'position'),
		'priority' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'priority'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '登録日'),
		'completed' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => '完了日'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

}
