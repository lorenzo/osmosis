<?php
class Rollup extends ScormAppModel {

	var $name = 'Rollup';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Rule' => array('className' => 'Rule',
				'foreignKey' => 'rollup_id',
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
