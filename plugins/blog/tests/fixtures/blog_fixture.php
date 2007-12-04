<?php 
class BlogFixture extends CakeTestFixture{
	var $name = 'Blogs';

	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary', 'extra'=> 'auto_increment'),		
		'title' => array('type' => 'string', 'null' => false),
		'description' => 'text',
		'owner' => array('type' => 'string', 'null' => false)
	);

	var $records = array(
		array ('id' => 1, 'title' => 'First Blog', 'description' => 'First Blog Description', 'owner' => 'AnaGaby'),
		array ('id' => 2, 'title' => 'Second Blog', 'description' => 'Second Blog Description', 'owner' => 'Bla'),
		array ('id' => 3, 'title' => 'Third Blog', 'description' => 'Third Blog Body', 'owner' => 'Yo')
	);
}

?>
