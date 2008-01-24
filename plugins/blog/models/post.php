<?php
class Post extends BlogAppModel {

	var $name = 'Post';
	var $actsAs = array(
		'Sluggable' => array('label' => 'title', 'slug' => 'slug', 'overwrite' => false)
	);
	var $useTable = 'blog_posts';
	var $validate = array(
		'title'=> array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
			'Error.maxlength' => array('rule' => array('maxLength',50),  
										'message' => 'Error.maxLength')
		),
		'body' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'blog_id' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
	);

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
