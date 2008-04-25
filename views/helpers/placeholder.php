<?php
/**
 * Helper class responsible for rendering placeholders
 *
 */

class PlaceholderHelper extends AppHelper {
	
	var $helpers = array('Html');
	
	/**
	 * Renders a type of placeholder
	 *
	 * @param string $type 
	 * @return string the rendered placeholder
	 */
	
	function render($type) {
		
		$view = ClassRegistry::getObject('view');
		$subscribers = $this->getSubscribers($type);

		if (empty($subscribers))
			return '';

		ob_start();
		foreach ($subscribers as $subscriber => $data) {
			$parts = explode('_',Inflector::underscore($subscriber));
			$plugin = $parts[0];
			echo $view->renderElement('placeholders/'.$type, array('plugin'=>$plugin,'cache'=>$data['cache'],'data' =>$data['data']));
		}
		return ob_get_clean();
	}
	
	/**
	 * Pulls data from the controller if not available in the view
	 *
	 * @param string $type 
	 * @return void
	 */
	
	private function _pullData($type) {
		
		$controller =& ClassRegistry::getObject('controller');
		if (!isset($controller->Placeholder))
			return;

		$data = $controller->Placeholder->pullData($type); 
		$view =& ClassRegistry::getObject('view');
		if (!isset($view->viewVars['placeholders']) || !is_array($view->viewVars['placeholders'])) {
			$view->viewVars['placeholders'] = array();
		}
		
		if (!isset($view->viewVars['placeholders'][$type]) || !is_array($view->viewVars['placeholders'][$type])) {
			$view->viewVars['placeholders'][$type] = array();
		}

		$view->viewVars['placeholders'][$type] = Set::merge($view->viewVars['placeholders'][$type],$data);
	}
	
	function renderToolBar($type = 'course_toolbar') {
		$subscribers = $this->getSubscribers($type);
		ob_start();
		echo '<ul>';
		foreach ($subscribers as $subscriber => $data) {
			$title = $data['data']['title'];
			$url = $data['data']['url'];
			echo '<li>'.$this->Html->link($title,$url).'</li>';
		}
		echo '</ul>';
		return ob_get_clean();
	}
	
	private function getSubscribers($type) {
		$view = ClassRegistry::getObject('view');
		if(!isset( $view->viewVars['placeholders'][$type])) {
			$this->_pullData($type);
		}
		$subscribers = $view->viewVars['placeholders'][$type];
		return $subscribers;
	}
}
?>