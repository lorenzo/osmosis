<?php
class Post extends BlogAppModel {

	var $name = 'Post';
	var $actsAs = array(
		'Sluggable' => array('label' => 'title', 'slug' => 'slug', 'overwrite' => false)
	);
	var $useTable = 'blog_posts';
	var $validate = array(
		'title' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
		),
		'body' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
		),
		'blog_id' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
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
	
	function __construct($id = false, $table = null, $ds = null) {
			$this->validate['title']['Error.empty']['message'] = __('The title can not be empty',true);
			$this->validate['body']['Error.empty']['message'] = __('The body can not be empty',true);
			$this->validate['blog_id']['Error.empty']['message'] = __('The post must belong to a blog',true);
			parent::__construct($id,$table,$ds);
	}

}
?>
