<?php
class PlaceholderComponent extends Object {
	
	private $attachTypes = array();
	private $holders = array();
	
	function startup(&$controller) {
		
		$this->controller =& $controller;
	}
	
	function attach($types) {
		
		if (is_string($types)) {
			$types = array($types);
		}
		
		$holders = array();
		foreach($types as $type) {
			$holders = am($holders,$this->getPlaceholderObjects($type));
		}
		
		foreach($holders as $name) {
			$this->controller->components[] = $name;
			$this->controller->{$name} = $holderClass =& ClassRegistry::getObject($name);
			$this->holders[] = $name;
			$this->{$name} =& $this->controller->{$name};
			$this->{$name}->startup($this->controller);
		}
	}
	
	function beforeRender() {
		
		foreach($holders as $holder) {
			if(!$this->{$holder}->auto && !$this->{$holder}->_continue()) {
				$this->{$holder}->process();
			}
		}
	}
	
	private function getPlaceholderObjects($type){
		
		$holders = array();
		$plugins = Configure::listObjects('plugin');
		
		foreach ($plugins as $key => $plug) {
			
			$className = $plug . Inflector::camelize($type) . 'Holder';
			if (ClassRegistry::isKeySet($className.'Component') || App::import('Component',$plug . '.' . $className)) {
				$class = $className. 'Component';
				if (ClassRegistry::isKeySet($class)) {
					$holderClass =& ClassRegistry::getObject($class);
				} else {
					$holderObject =& new $class;
					ClassRegistry::addObject($className,&$holderObject);
				}
					$holders[] = $className;
			}
		}
		return $holders;
	}
	
}
?>