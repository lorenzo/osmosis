<?php 
class PostFixture extends CakeTestFixture{
	var $name = 'Posts';
	var $import = array('model'=> 'Post');
	var $records = array(
		array ('id' => 1, 'title' => 'First Article', 'body' => 'First Article Body', 'created' => '2007-03-18 10:39:23', 'modified' => '2007-03-18 10:41:31', 'blog_id'=>'1', 'slug' => 'first-article'),
		array ('id' => 2, 'title' => 'Second Article', 'body' => 'Second Article Body', 'created' => '2007-03-18 10:41:23', 'modified' => '2007-03-18 10:43:31', 'blog_id'=>'2','slug' => 'second-article'),
		array ('id' => 3, 'title' => 'Third Article', 'body' => 'Third Article Body', 'created' => '2007-03-18 10:43:23', 'modified' => '2007-03-18 10:45:31','blog_id'=>'2','slug' => 'third-article')
	);
}

?>
