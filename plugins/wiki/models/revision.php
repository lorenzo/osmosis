<?php
class Revision extends AppModel {

	var $name = 'Revision';
	var $useTable = 'wiki_revisions';
	var $validate = false;

	var $belongsTo = array(
			'Entry' => array('className' => 'wiki.Entry',
								'foreignKey' => 'entry_id',
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

}
?>