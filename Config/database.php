<?php
class DATABASE_CONFIG {

//	public $default = array(
//		'datasource' => 'Database/Sqlite',
//		'persistent' => false,
//		'database' => 'cake2_notebook.db',
//	);

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '127.0.0.1',
		'login' => 'root',
		'password' => 'root',
		'database' => 'cake2_notebook',
		'encoding' => 'utf8'
	);
}
