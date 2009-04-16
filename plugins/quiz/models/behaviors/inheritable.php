<?php 
/** 
 * The SubclassBehavior allows a model to act as a subclass of another model and
 * allows the implementation of 'ISA' relationships in Entity-Relationship database models.   
 * Parameters are passed to this behavior class to define the parent model of the subclass
 * This class was based on and inspired by Matthew Harris's ExtendableBehavior class
 * which can be found at http://bakery.cakephp.org/articles/view/extendablebehavior 
 * 
 * @author      Eldon Bite <eldonbite@gmail.com> 
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License 
 */ 
class InheritableBehavior extends ModelBehavior { 
    /** 
     * Set up the behavior. 
     * Finds parent model and determines type field settings. 
     */ 
    function setup(&$model, $config = array()) {
        $this->settings[$model->alias]  = am(array(
            'inheritanceField' => 'type', 
            'method' => 'STI', 
            'fieldAlias' => $model->alias,
			'pluginScope' => ''
		), 
        $config);
		
		if (!empty($this->settings[$model->alias]['pluginScope']))
			$this->settings[$model->alias]['pluginScope'] .= '.';
			
		if ($this->settings[$model->alias]['method'] != 'CTIPARENT') {
			$model->parent = ClassRegistry::init($this->settings[$model->alias]['pluginScope']. get_parent_class($model->name));
		}
        	
        $model->inheritanceField = $this->settings[$model->alias]['inheritanceField'];
        $model->fieldAlias = $this->settings[$model->alias]['fieldAlias'];
    }

    /** 
     * Filter query conditions with the correct `type' field condition. 
     */ 
    function beforeFind(&$model, $query) 
    {
        extract($this->settings[$model->alias]);
        if ($method == 'STI')
            return $this->singleTableBeforeFind($model, $query);

        if ($method == 'CTI')
            return $this->classTableBeforeFind($model, $query);

		if ($method == 'CTIPARENT')
			return $this->classTableParentBeforeFind($model, $query); 
        
    }

    /*function afterFind(&$model, $results = array(), $primary = false) {
        extract($this->settings[$model->alias]);
        if ($method == 'STI')
            return $results;
        
		if ($method == 'CTI') {
        	foreach ($results as $i => $res) {
	            if (isset($res[$model->parent->alias]) && isset($res[$model->alias])) {
	                $results[$i][$model->alias] = am($res[$model->parent->alias], $res[$model->alias]);
	                unset($results[$i][$model->parent->alias]);
	            }
	        }
		}
		return $results;
    }*/
    
    /** 
     * Set the `type' field before saving the record. 
     */ 
    function beforeSave(&$model) { 
        extract($this->settings[$model->alias]);
        if ($method == 'STI') {
            return $this->singleTableBeforeSave($model);
        } else if ($method == 'CTI') {
			if (!$this->saveParentModel($model))
				return false;		
				
			$model->data[$model->alias][$model->primaryKey] = $model->parent->getLastInsertId();
		}
        return true;
    }
    
    function afterSave(&$model, $created = false) {
        extract($this->settings[$model->alias]);
        if ($created && $method == 'CTI') {
            return $this->saveParentModel($model);
        }
    }
    
    function afterDelete(&$model) {
        extract($this->settings[$model->alias]);
        if ($method == 'CTI') {
            $model->parent->delete($model->id);
        }
        return true;
    }

    /**
    *   BeforeFind for Single table inhertance
    */
    private function singleTableBeforeFind($model, $query) {
        extract($this->settings[$model->alias]);
        
        if (isset($model->_schema[$inheritanceField]) && $model->alias != $model->parent->alias) {
            $field = $model->alias.'.'.$inheritanceField;
            
            if (!isset($query['conditions'])) {
                $query['conditions'] = array();
            }
            
            if (is_string($query['conditions'])) {
                $query['conditions'] = array($query['conditions']);
            }
            
            if (is_array($query['conditions'])) { 
                if (!isset($query['conditions'][$field])) {
                    $query['conditions'][$field] = array(); 
                }
                $query['conditions'][$field] = $fieldAlias;
            }
        }
        return $query;
    } 

    /**
    *   BeforeSave for Single table inhertance
    */
    private function singleTableBeforeSave($model) {
        if (isset($model->_schema[$model->inheritanceField]) && $model->alias != $model->parent->alias) {
            # May be there is a edge case for this
            if (!isset($model->data[$model->alias])) { 
                $model->data[$model->alias] = array(); 
            } 
            $model->data[$model->alias][$model->inheritanceField] = $model->alias; 
        }
        return true;
    }
    
    private function classTableBeforeFind($model, $query) {
        extract($this->settings[$model->alias]);
        $bind = array('belongsTo' => array(
            "{$model->parent->alias}" => array(
                'className' => $model->parent->alias, 'foreignKey' => "{$model->primaryKey}"
            )
        ));
        $model->bindModel($bind,true);
        return $query;
    }

	private function classTableParentBeforeFind($model, $query) {
        return $query;
    }
    
    private function saveParentModel(&$model) {
        extract($this->settings[$model->alias]);

        $fields = array_keys($model->parent->schema()); 
        $parentData = array(
			$model->inheritanceField	=> $model->name
		);
        
        foreach ($model->data[$model->alias] as $key => $value) {
			if (in_array($key, $fields)) {
				$parentData[$key] = $value;
			}
        }
        $model->parent->save($parentData);
        return true;
    }

	function insertChildData(&$model,$results) {
		if ($this->settings[$model->alias]['method'] != 'CTIPARENT')
			return $results;

			$types = array_unique(Set::extract("/{$model->alias}/{$model->inheritanceField}",$results));
			foreach ($types as $type) {
				$keys = Set::extract("/{$model->alias}[$model->inheritanceField={$type}]/{$model->primaryKey}",$results);
				$concreteObjects[$type] = ClassRegistry::init($this->settings[$model->alias]['pluginScope'] . $type);
				$concreteResults[$type] = $concreteObjects[$type]->find('all',array(
						'conditions' => array($type.'.'.$concreteObjects[$type]->primaryKey => $keys)
					)
				);
			}

			if (!Set::numeric(array_keys($results[0][$model->alias]))) {
				foreach ($results as $i => &$result) {
					$key = $result[$model->alias][$model->primaryKey];
					$type = $result[$model->alias][$model->inheritanceField];
					foreach ($concreteResults[$type] as $j => $concreteResult) {
						if ($concreteResult[$type][$concreteObjects[$type]->primaryKey] == $key) {
							$result = am($result,$concreteResult);
							unset($concreteResults[$type][$j]);
							break;
						}
					}
				}
				return $results;
			}

			foreach ($results as $i => &$dataSets) {
				foreach ($dataSets[$model->alias] as &$result) {

					$key = $result[$model->primaryKey];
					$type = $result[$model->inheritanceField];

					foreach ($concreteResults[$type] as $j => $concreteResult) {
						if ($concreteResult[$type][$concreteObjects[$type]->primaryKey] == $key) {
							$result = am($result,$concreteResult);
							unset($concreteResults[$type][$j]);
							break;
						}
					}
					
				}
			}
			return $results;
	}
} 
?>