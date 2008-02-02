<?php
class Document extends AppModel {

	var $name = 'Document';
	var $useTable = 'locker_documents';
	var $validate = array(
		'locker_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Locker' => array('className' => 'Locker.Locker',
								'foreignKey' => 'locker_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>
