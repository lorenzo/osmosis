<?php
class Comment extends BlogAppModel {

	var $name = 'Comment';
	var $useTable = 'blog_comments';
	var $validate = array(
		'comment' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'post_id' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'member_id' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Post' => array('className' => 'Blog.Post',
								'foreignKey' => 'post_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
								
			'Member' => array('className' => 'Member',
								'foreignKey' => 'member_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);
	
	function __construct($id = false, $table = null, $ds = null) {
			$this->validate['comment']['Error.empty']['message'] = __('The comment can not be empty',true);
			$this->validate['post_id']['Error.empty']['message'] = __('The post_id can not be empty',true);
			$this->validate['member_id']['Error.empty']['message'] = __('The member_id can not be empty',true);
			parent::__construct($id,$table,$ds);
	}
}
?>
