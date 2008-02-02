<?php
class Locker extends LockerAppModel {

	var $name = 'Locker';
	var $useTable = 'locker_lockers';
	var $validate = array(
		'member_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Member' => array('className' => 'Member',
								'foreignKey' => 'member_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Document' => array('className' => 'Locker.Document',
								'foreignKey' => 'locker_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);

}
?>
