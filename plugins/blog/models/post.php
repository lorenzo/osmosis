<?php
class Post extends BlogAppModel {

	var $name = 'Post';
	var $actsAs = array('Sluggable' => array('overwrite' => true));
	var $useTable = 'posts';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Blog' => array('className' => 'Blog.Blog',
								'foreignKey' => 'blog_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);

	var $hasMany = array(
			'Comment' => array('className' => 'Blog.Comment',
								'foreignKey' => 'post_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'dependent' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);

}
?>
