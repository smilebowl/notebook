<?php

$fn = 'data';

// header

$this->Csv->setRow(array(
	__('Recordcategory'),
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
		$record['Recordcategory']['name'],
		$record['Record']['id'],
		$record['Record']['eventdate'],
		strip_tags(preg_replace('/\<br(\s*)?\/?\>/i', "\n", $record['Record']['title'])),
		$record['Record']['created'],
	));
}
$this->Csv->setFilename($fn . date("Y-m-d"));
$this->Csv->export();