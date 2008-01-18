<?php 
class BlogFixture extends CakeTestFixture{
	var $name = 'BlogBlogs';
	var $import = array('model'=> 'Blog');
	var $records = array(
		array ('id' => 1, 'title' => 'First Blog', 'description' => 'First Blog Description', 'member_id' => 'AnaGaby'),
		array ('id' => 2, 'title' => 'Second Blog', 'description' => 'Second Blog Description', 'member_id' => 'Joaquín'),
		array ('id' => 3, 'title' => 'Third Blog', 'description' => 'Third Blog Description', 'member_id' => 'JoséL')
	);
}

?>
