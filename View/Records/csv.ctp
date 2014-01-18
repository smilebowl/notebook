<?php

$fn = 'data';

// header

$this->Csv->setRow(array(
	__('Id'),
	__('Eventdate'),
	__('Title'),
	__('Created'),
));

// records

foreach ($records as $record) {
	if ($fn === 'data') {
		$fn = $record['Recordcategory']['name'];
	}
	$this->Csv->setRow(array(
		$record['Record']['id'],
		$record['Record']['eventdate'],
		strip_tags($record['Record']['title']),
		$record['Record']['created'],
	));
}
$this->Csv->setFilename($fn . date("Y-m-d"));
$this->Csv->export();