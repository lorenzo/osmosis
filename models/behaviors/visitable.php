<?php
class VisitableBehavior extends ModelBehavior {
	var $field;
	var $__settings;
	
	function setup(&$Model, $settings = array()) {
		$this->__settings[$Model->alias]['field'] = Inflector::underscore($Model->alias) . '_visit_count';
		if (isset($settings['field'])) {
			$this->__settings[$Model->alias]['field'] = $settings['field'];
		}
	}
	
	function beforeFind(&$Model, $query) {
		if (!isset($query['count_view'])) return true;
		$id = $query['conditions'][$Model->alias . '.' . $Model->primaryKey];
		$this->__settings[$Model->alias][$id] = true;
		return true;
	}
	
	function afterFind(&$Model, $data) {
		if (count($data)!=1) return true;
		$data = $data[0];
		if (!isset($data[$Model->alias][$Model->primaryKey])) return true;
		$id = $data[$Model->alias][$Model->primaryKey];
		if (!isset($this->__settings[$Model->alias][$id])) return true;
		$theModel = new $Model->name;
		$theModel->restrict($Model->alias);
		$theModel->updateAll(
			array($this->__settings[$Model->alias]['field'] => $this->__settings[$Model->alias]['field'] . ' + 1'),
			array($Model->alias . '.' . $Model->primaryKey => $id)
		);
		unset($this->__settings[$Model->alias][$id]);
		return true;
	}
}
?>