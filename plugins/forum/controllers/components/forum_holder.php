<?php
App::import('Component', 'PlaceholderData');

class ForumHolderComponent extends PlaceholderDataComponent {
	var $name = 'ForumHolder';
	var $auto = true;
	var $cache = false;
	var $types = array('head','course_toolbar');
	
	function head() {
		return $this->controller->plugin == 'forum' || ($this->controller->name == 'Courses' && $this->controller->action =='index');
	}
	
	function courseToolbar() {
		return array('url' => array('plugin' => 'Forum', 'controller' => 'forums', 'action' => 'index'));
	}
	
	/**
	 * Returns this plugin updates so that the plugin_updates element can show them.
	 *
	 * @return mixed log of changes related to this plugin.
	 * @author Joaquín Windmüller
	 **/
	function pluginUpdates() {
		$modelLog = ClassRegistry::getObject('ModelLog');
		$last_seen = $modelLog->Member->field('last_seen', array('id' => $this->controller->Auth->user('id')));
		$useful_fields = array(
			'Topic' => array(
				'fields' => array(),
				'restrict' => null
			),
			'Discussion' => array(
				'fields' =>  array('Discussion.id', 'Discussion.title', 'Discussion.status'),
				'restrict' => null
			),
			'Response' => array(
				'fields' => array(),
				 'restrict' => array('Response', 'Discussion'),
				'order_by' => '/Discussion/id'
			)
		);
		$logs = $modelLog->find('all', array('time' => '> ' . $last_seen, 'model' => array_keys($useful_fields)));
		$Topic = $Discussion = $Response = null;
		$results = array();
		foreach ($logs as $i => $log) {
			$modelName = $log['ModelLog']['model'];
			$entity_id = $log['ModelLog']['entity_id'];
			$log['ModelLog']['data'] = $this->__getModelData(
				$modelName,
				${$modelName},
				'Forum',
				$entity_id,
				$useful_fields[$modelName]['restrict'],
				$useful_fields[$modelName]['fields']
			);
			if (isset($useful_fields[$modelName]['order_by'])){
				$entity_id = Set::extract($useful_fields[$modelName]['order_by'] . '[:first]', $log['ModelLog']['data'] );
				$entity_id = $entity_id[0];
			}
			$results[$modelName][$entity_id][] = $log;
		}
		return $results;
	}
	
	function __getModelData($modelName, &$Model, $plugin, $id, $restrict, $fields) {
		if (!$Model) {
			App::import('Model', $plugin . '.' . $modelName);
			$Model = new $modelName;
		}
		if (!$restrict) {
			$restrict = array($modelName);
		}
		$Model->restrict($restrict);
		$result = $Model->find('first', array('conditions' => array($modelName . '.id' => $id), 'fields' => $fields));
		return $result;
	}
}
?>