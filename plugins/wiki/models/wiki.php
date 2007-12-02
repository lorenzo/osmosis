<?php
class Wiki extends AppModel {

	var $name = 'Wiki';
	var $useTable = 'wiki_wikis';
	var $validate = array(
		'course_id' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'name' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'description' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
	);

	var $belongsTo = array(
			'Course' => array('className' => 'Course',
								'foreignKey' => 'course_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);

	var $hasMany = array(
			'Entry' => array('className' => 'wiki.Entry',
								'foreignKey' => 'wiki_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'dependent' => true,
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);

}
?>