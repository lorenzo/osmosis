<?php
class ImagesTagFixture extends CakeTestFixture {
	var $name = 'ImagesTag';
	var $fields = array(
		'image_id' => array('type' => 'integer', 'null' => false),
		'tag_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array('UNIQUE_TAG' => array('column'=> array('image_id', 'tag_id'), 'unique'=>1))
	);
	var $records = array(
		array('image_id' => 1, 'tag_id' => 1),
		array('image_id' => 1, 'tag_id' => 2),
		array('image_id' => 2, 'tag_id' => 1),
		array('image_id' => 2, 'tag_id' => 3)
	);
}
?>