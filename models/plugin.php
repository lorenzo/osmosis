<?php
class Plugin extends AppModel {

	var $name = 'Plugin';
	var $validate = array(
		'name' => VALID_NOT_EMPTY,
		'active' => VALID_NOT_EMPTY,
	);

	function actives($fields=null) {
		return $this->findAll(array('active'=>1),$fields);
	}
	//The Associations below have been created with all possible keys, those that are not needed can be removed
}
?>