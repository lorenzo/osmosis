<?php

class AppModel extends Model{
	var $actsAs = array('Bindable');
	
	protected function setErrorMessage($path, $message) {
		Set::insert(&$this->validate, $path . '.message', $message);
	}
}
?>