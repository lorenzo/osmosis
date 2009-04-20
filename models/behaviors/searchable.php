<?php
class SearchableBehavior extends ModelBehavior {

	function setup(&$Model, $settings = array()) {
		if (!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = array();
		}
		if (!is_array($settings)) {
			$settings = array();
		}
		$this->settings[$Model->alias] = array_merge($this->settings[$Model->alias], $settings);
	}

	function beforeFind(&$Model,$query) {
		if (empty($query['search']))
			return $query;
		
		$conditions = $this->searchConditions($Model,$query['search']);
		if (!empty($query['conditions']))
			$query['conditions'] = am($conditions,$query['conditions']);
		else
			$query['conditions'] = $conditions;
		return $query;
	}

	function searchConditions(&$Model,$searchables) {
		$schema = $Model->schema();

		foreach ($searchables as $modelName => $fields) {
			foreach ($fields as $field => $comparison) {
				$object =& $Model;
				if (($modelName == $Model->name || $modelName == $Model->alias)) {
					$schema = $Model->schema();
				} elseif (isset($Model->{$modelName}) && is_object($Model->{$modelName})) {
					$schema = $Model->{$modelName}->schema();
					$object =& $Model->{$modelName};
				} else {
					$schema = false;
				}

				if (!empty($schema[$field])) {
					switch ($schema[$field]['type']) {
						case 'integer':
						case 'float':
							$conditions[$Model->alias . '.' . $field] = $comparison;
						break;
						case 'boolean':
							$conditions[$Model->alias . '.' . $field] = is_bool($comparison) ? $comparison : !empty($comparison);
						break;
						case 'date':
						case 'datetime':
							$this->_dateSearchCondition($object,$conditions,$field,$comparison);
						break;
						case 'string':
						case 'text':
						default:
							$this->_fullTextCondition($object,$conditions,$field,$comparison);
						break;
					}
				} else {
					if ((substr($field, -6) == '_start' && in_array($schema[substr($field,0,-6)]['type'],array('date','datetime')))
					|| (substr($field, -4) == '_end'  && in_array($schema[substr($field,0,-4)]['type'],array('date','datetime')))
					) {
						$this->_dateSearchCondition($object,$conditions,$field,$comparison);
						continue;
					}
					$this->_expansionSearchCondition($conditions,$field,$comparison);
				}
			}
		}
		return $conditions;
	}

	function _dateSearchCondition(&$model,&$conditions,$field,$date) {
		$comparison = '=';
		if(substr($field, -6) == '_start') {
			$comparison = '>=';
			$pos = strpos($field,'_start');
			$field = substr($field,0,$pos);
		} elseif (substr($field, -4) == '_end') {
			$comparison = '<=';
			$pos = strpos($field,'_end');
			$field = substr($field,0,$pos);
		}
		$conditions["{$model->alias}.{$field} {$comparison}"] = $date;
	}


	function _fullTextCondition(&$model,&$conditions,$field,$comparison) {
		$db =& ConnectionManager::getDataSource($model->useDbConfig);
		$indices = $db->index($model);
		if(isset($indices['search'])) {

			if (is_array($indices['search']['column'])) {

				foreach ($indices['search']['column'] as $n => $col) {

					$indices['search']['column'][$n] = $model->alias.'.'.$col;
				}

				$cols = implode(',',$indices['search']['column']);
			} else {

				$cols = $indices['search']['column'];
			}

			$conditions[] = "MATCH ($cols) AGAINST ('$comparison')";
		}else {
			$this->_expansionSearchCondition($conditions,$model->alias.'.'.$field,$comparison);
		}
	}

	function _expansionSearchCondition(&$conditions,$field, $text) {
		$conditions["{$field} LIKE"] = "%{$text}%";
	}
}
?>