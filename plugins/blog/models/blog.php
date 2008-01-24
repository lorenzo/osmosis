<?php
class Blog extends BlogAppModel {

	var $name = 'Blog';
	var $useTable = 'blog_blogs';
	var $validate = array(
		'title'=> array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'description' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'member_id' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Post' => array('className' => 'Blog.Post',
								'foreignKey' => 'blog_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'created DESC',
								'limit' => '',
								'offset' => '',
								'dependent' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);
	
	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member'
		)
	);
}
?>
