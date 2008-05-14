<?php
class ImagesTagFixture extends CakeTestFixture {
	var $name = 'ImagesTag';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'key' => 'primary'),
		'image_id' => array('type' => 'integer', 'null' => false),
		'tag_id' => array('type' => 'integer', 'null' => false),
		'member_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1),'UNIQUE_TAG' => array('column'=> array('image_id', 'tag_id'), 'unique'=>1))
	);
	var $records = array(
		array('image_id' => 1, 'tag_id' => 1,'member_id' => 1),
		array('image_id' => 1, 'tag_id' => 2,'member_id' => 1),
		array('image_id' => 2, 'tag_id' => 1,'member_id' => 1),
		array('image_id' => 2, 'tag_id' => 3,'member_id' => 1)
	);
}
?>