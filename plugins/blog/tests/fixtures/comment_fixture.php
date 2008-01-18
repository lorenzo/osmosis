<?php 
class CommentFixture extends CakeTestFixture{
	var $name = 'BlogComment';
	var $import = array('model'=> 'Comment');
	var $records = array(
		array ('id' => 1, 'comment' => 'First Comment', 'post_id' => '1', 'member_id' => 'AnaGaby'),
		array ('id' => 2, 'comment' => 'Second Comment', 'post_id' => '1', 'member_id' => 'JoseL'),
		);
}

?>
