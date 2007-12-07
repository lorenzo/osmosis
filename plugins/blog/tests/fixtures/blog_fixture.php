<?php 
class BlogFixture extends CakeTestFixture{
	var $name = 'Blogs';
	var $import = array('model'=> 'Blog');
	var $records = array(
		array ('id' => 1, 'title' => 'First Blog', 'description' => 'First Blog Description', 'owner' => 'AnaGaby'),
		array ('id' => 2, 'title' => 'Second Blog', 'description' => 'Second Blog Description', 'owner' => 'Joaquín'),
		array ('id' => 3, 'title' => 'Third Blog', 'description' => 'Third Blog Description', 'owner' => 'JoséL')
	);
}

?>
