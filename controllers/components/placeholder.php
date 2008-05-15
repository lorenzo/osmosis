<?php
/**
 * A Facade to attach various placeholders to a view
 *
 */
App::import('Model','Plugin');
class PlaceholderComponent extends Object {
	
	/**
	 * contains the list of objects that are responsible to sent placeholder data to the view
	 *
	 * @var array
	 */
	
	private $holders = array();
	
	/**
	 * Contains the name of the already attached placeholders
	 *
	 * @var string
	 */
	
	private $attached = array();
	
	/**
	 * Startup function. Sets the controller in the ClassRegistry for further use (Probably breaking some MVC rules)
	 *
	 * @param Controller $controller reference to the including controller
	 * @return void
	 */
	
	function startup(&$controller) {
		$this->controller =& $controller;
		$this->Plugin =& new Plugin;
		$this->started = true;
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
				$holders[$type] = $this->getPlaceholderObjects($type);
		}
		$this->startupHolders($holders);
	}
	
	/**
	 * Adds a new toolbar placeholder to the view
	 *
	 * @param string $course_id the course id the toolbar belongs to
	 * @param string $type the name of the toolbar placeholder
	 * @return void
	 */
	
	function attachToolbar($course_id,$type = 'course_toolbar') {
		if ($type === 'course_toolbar') {
			$plugins = $this->getCourseToolbarObjects($course_id);
			$holders[$type] = array();
			foreach ($plugins as $plug) {
				if (!empty($plug['Holder'])) {
					$plug['Holder']->setConfig($type,array('title' => $plug['Plugin']['title']));
					$holders[$type][] = $plug['Holder'];
				}
			}
				$this->startupHolders($holders);
		} else
			$this->attach($type);
	}
	
	/**
	 * Initializes a list of PlaceholderData objects depending
	 *
	 * @param array $holders a list of references to objects indexed by type of placeholder
	 * @return void
	 */
	
	private function startupHolders($holders) {
		foreach ($holders as $type => $objects) {
			foreach ($objects as $object) {
				$name = $object->name;
				if (isset($this->controller->{$name})) {
					$this->{$name}->startup($this->controller, $type);
					continue;
				}	
				$this->controller->components[] = $name;
				$this->controller->{$name} = $object;
				$this->holders[$type][] = $name;
				$this->{$name} =& $this->controller->{$name};
				$this->{$name}->startup($this->controller, $type);
			}
			$this->attached[] = $type;
		}
	}
	
	/**
	 * Sends the data to th view just before rendering it, and if not sent automatically
	 *
	 * @return void
	 */
	
	function beforeRender() {
		foreach ($this->holders as $type => $objects) {
			foreach ($objects as $holder) {
				if (!$this->{$holder}->auto && !$this->{$holder}->_continue($type)) {
					$this->{$holder}->process($type);
				}
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
		return $this->Plugin->getHolders($type);
	}
	
	private function getCourseToolbarObjects($course_id) {
		return $this->Plugin->getCourseTools($course_id,true);
	}
	
	/**
	 * Used by the view to pull data from the controller (Again breaking some rules)
	 *
	 * @param string $type type of placeholder data to return
	 * @return array
	 */
	
	public function pullData($type) {
		if (in_array($type,$this->attached)) {
			return array();
		}
		$this->attach($type);
		if (isset($this->controller->viewVars['placeholders'][$type]))
			return $this->controller->viewVars['placeholders'][$type];
		return array();
	}
	
}
?>