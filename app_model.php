<?php
class AppModel extends Model{
	var $actsAs = array('Bindable', 'Hookable');
	
	function validateUnique($data, $name) {
		if (!empty($this->id)) {
			$conditions = array($this->primaryKey => '!= ' . $this->id, $name => $data[$name]);
		} else {
			$conditions = array($name => $data[$name]);
		}
		return !$this->field($this->primaryKey, $conditions);
	}
	
	protected function setErrorMessage($path, $message) {
		Set::insert(&$this->validate, $path . '.message', $message);
	}
}
?>