<?php
class AppModel extends Model{
	var $actsAs = array('Containable', 'Hookable');
	
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
	
	/**
	 * Alias for ContainableBehavior::contain
	 *
	 * @param mixed $args 
	 * @return void
	 * @author José Lorenzo
	 */
	
	function restrict($args) {
		$this->contain($args);
		trigger_error(__('Please use "contain" instead of "restrict"', true), E_USER_WARNING);
	}
	
	function beforeFind($queryData) {
		if (isset($queryData['restrict'])) {
			$queryData['contain'] = $queryData['restrict'];
			unset($queryData['restrict']);
			trigger_error(__('Please use "contain" instead of "restrict"', true), E_USER_WARNING);
		}
	}
}
?>