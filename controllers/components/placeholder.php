<?php
/**
 * A Facade to attach various placeholders to a view
 *
 */

class PlaceholderComponent extends Object {
	
	/**
	 * contains the list of objects that are responsible to sent placeholder data to the view
	 *
	 * @var array
	 */
	
	private $holders = array();
	
	/**
	 * Startup function. Sets the controller in the ClassRegistry for further use (Probably breaking some MVC rules)
	 *
	 * @param Controller $controller reference to the including controller
	 * @return void
	 */
	
	function startup(&$controller) {
		
		$this->controller =& $controller;
		
		// Sets the controller in the class registry to be able to pull data from the view if needed
		ClassRegistry::addObject('controller',&$controller);
	}
	
	/**
	 * Adds a new placeholder type to the view
	 *
	 * @param mixed $types
	 * @return void
	 */
	
	function attach($types) {
		
		if (is_string($types)) {
			$types = array($types);
		}
		
		$holders = array();
		foreach ($types as $type) {
			$holders = am($holders,$this->getPlaceholderObjects($type));
		}
		
		foreach ($holders as $name) {
			$this->controller->components[] = $name;
			$this->controller->{$name} = $holderClass =& ClassRegistry::getObject($name);
			$this->holders[] = $name;
			$this->{$name} =& $this->controller->{$name};
			$this->{$name}->startup($this->controller);
		}
	}
	
	/**
	 * Sends the data to th view just before rendering it, and if not sent automatically
	 *
	 * @return void
	 */
	
	function beforeRender() {
		
		foreach ($holders as $holder) {
			if (!$this->{$holder}->auto && !$this->{$holder}->_continue()) {
				$this->{$holder}->process();
			}
		}
	}
	
	/**
	 * Finds and stores objects form plugins responsible for setting placeholder data to a view
	 *
	 * @param string $type the type of placeholder data objects to find
	 * @return array with references to objects
	 */
	
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
	
	/**
	 * Used by the view to pull data from the controller (Again breaking some rules)
	 *
	 * @param string $type type of placeholder data to return
	 * @return array
	 */
	
	public function pullData($type) {
		if (isset($this->controller->viewVars['placeholders'][$type]))
			return $this->controller->viewVars['placeholders'][$type];
		return array();
	}
	
}
?>