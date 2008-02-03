<?php
class Blog extends BlogAppModel {

	var $name = 'Blog';
	var $useTable = 'blog_blogs';
	var $validate = array(
		'title' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
		),
		'description' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
		),
		'member_id' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
		),
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
	
	function __construct($id = false, $table = null, $ds = null) {
			$this->validate['title']['Error.empty']['message'] = __('The title can not be empty',true);
			$this->validate['description']['Error.empty']['message'] = __('The description can not be empty',true);
			$this->validate['member_id']['Error.empty']['message'] = __('The member can not be empty',true);
			parent::__construct($id,$table,$ds);
	}
}
?>
