<?php
class PlaceholderHelper extends AppHelper {
	
	var $helpers = array('Html');
	
	function render($type) {
		$view = ClassRegistry::getObject('view');
		$buffer = '';
		$subscribers = $view->data['placeholders'][$type];
		
		if (!$subscribers)
			return '';
			
		ob_start();
		foreach ($subscribers as $subscriber => $data) {
			$parts = explode('_',Inflector::underscore($subscriber));
			$plugin = $parts[0];
			echo $view->renderElement('placeholders/'.$type, array('plugin'=>$plugin,'cache'=>$data['cache'],'data' =>$data['data']));
		}
		return ob_get_clean();
	}
}
?>