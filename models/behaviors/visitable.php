<?php
class VisitableBehavior extends ModelBehavior {
	var $field;
	var $settings;
	
	function setup(&$Model, $settings = array()) {
		$this->field = Inflector::underscore($Model->name) . '_visit_count';
		if (isset($settings['field'])) {
			$this->field = $settings['field'];
		}
	}
	
	function beforeFind(&$Model, $query) {
		if (!isset($query['count_view'])) return true;
		$id = $query['conditions'][$Model->alias . '.' . $Model->primaryKey];
		$this->settings[$Model->name][$id] = true;
		return true;
	}
	
	function afterFind(&$Model, $data) {
		if (count($data)!=1) return true;
		$data = $data[0];
		if (!isset($data[$Model->alias][$Model->primaryKey])) return true;
		$id = $data[$Model->alias][$Model->primaryKey];
		if (!isset($this->settings[$Model->name][$id])) return true;
		$m = new $Model->name;
		$m->id = $id;
		$visit_count = $m->field($this->field);
		debug($m->field($this->field));
		debug($visit_count);
		$m->save(array($this->field => $visit_count + 1));
		unset($this->settings[$Model->name][$id]);
		return true;
	}
}
?>