<?php
class Blog extends BlogAppModel {

	var $name = 'Blog';
	var $useTable = 'blogs';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Post' => array('className' => 'Blog.Post',
								'foreignKey' => 'blog_id',
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
