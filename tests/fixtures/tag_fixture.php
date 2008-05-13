<?php 
class TagFixture extends CakeTestFixture {
	var $name = 'Tag';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'length' => 30, 'key' => 'unique'),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
			);
	var $records = array(
		array(
			'id'  => 1,
			'name'  => 'Lorem'
			),
		array(
			'id'  => 2,
			'name'  => 'Impsum'
			),
		array(
			'id'  => 3,
			'name'  => 'Dolor'
			),
		array(
			'id'  => 4,
			'name'  => 'Sit'
			),
		array(
			'id'  => 5,
			'name'  => 'Amet'
			)
		);
}
?>