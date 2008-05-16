<?php

class AppModel extends Model{
	var $actsAs = array('Bindable', 'Hookable');
	
	protected function setErrorMessage($path, $message) {
		Set::insert(&$this->validate, $path . '.message', $message);
	}
}
?>