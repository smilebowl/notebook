<?php

// header

$this->Csv->setRow(array(
	__('Todocategory'),
	__('Id'),
	__('Title'),
	__('Completed'),
	__('Created'),
));


// todos

foreach ($todos as $todo) {
	$this->Csv->setRow(array(
		$todo['Todocategory']['name'],
		$todo['Todo']['id'],
		$todo['Todo']['title'],
		$todo['Todo']['completed'],
		$todo['Todo']['created'],
	));
}
$this->Csv->setFilename('Todo ' . date("Y-m-d"));
$this->Csv->export();