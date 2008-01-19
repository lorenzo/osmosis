<?php
class HookableBehavior extends ModelBehavior {
	
	var $modelName = null;
	
	function setup(&$model, $config = array()) {
        if( !is_null( $config ) && is_array( $config ) ) {
            $this->settings = array_merge( $this->settings, $config );
        }
     }

	function __getHookObjects(&$model,$hookName){
		$hooks = array();
		$plugins = Configure::listObjects('plugin');
		foreach ($plugins as $key => $plug) {
			$className = $plug . $model->name . 'Hook';
			if(App::import('Component',$plug . '.' . $className)) {
				$className = $className. 'Component';
				$hookClass = new $className;
				if(method_exists($hookClass,$hookName)) {
					$hooks[] = &$hookClass;
				}
			}
		}
		return $hooks;
	}
	
	function beforeValidate(&$model) {
		$return = true;
		$hooks = $this->__getHookObjects($model,'beforeValidate');
		foreach ($hooks as $hook){
			$return = $hook->beforeValidate($model) && $return;			
		}
		return $return;
	}
	
	function beforeSave(&$model) {
		$return = true;
		$hooks = $this->__getHookObjects($model,'beforeSave');
		foreach ($hooks as $hook){
			$return = $hook->beforeSave($model) && $return;			
		}
		return $return;
	}


	function beforeFind(&$model, $query) {
		$return = true;
		$hooks = $this->__getHookObjects($model,'beforeFind');
		foreach ($hooks as $hook){
			$return = $hook->beforeFind($model, $query) && $return;			
		}
		return $return;
	}


	function beforeDelete(&$model, $cascade) {
		$return = true;
		$hooks = $this->__getHookObjects($model,'beforeDelete');
		foreach ($hooks as $hook){
			$return = $hook->beforeDelete($model, $cascade) && $return;			
		}
		return $return;
	}

	function afterSave(&$model, $created) {
		$return = true;
		$hooks = $this->__getHookObjects($model,'afterSave');
		foreach ($hooks as $hook){
			$return = $hook->afterSave($model, $created) && $return;			
		}
		return $return;
	}

	function afterFind(&$model, $results, $primary) {
		$hooks = $this->__getHookObjects($model,'afterFind');
		foreach ($hooks as $hook){
			$results = $hook->afterFind($model, $results, $primary) && $return;			
		}
		return $results;
	}
	
	function afterDelete(&$model) {
		$return = true;
		$hooks = $this->__getHookObjects($model,'afterDelete');
		foreach ($hooks as $hook){
			$return = $hook->afterDelete($model) && $return;			
		}
		return $return;
	}
}
?>