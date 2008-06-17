<?php
/* SVN FILE: $Id$ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */
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
	
	function render($type, $path = '') {
		$view = ClassRegistry::getObject('view');
		$subscribers = $this->getSubscribers($type);
		
		if (empty($subscribers))
			return '';

		ob_start();
		foreach ($subscribers as $subscriber => $data) {
			list($plugin, ) = explode('_',Inflector::underscore($subscriber));
			echo $view->element(
				'placeholders/' . $type,
				array('plugin' => $plugin, 'cache' => $data['cache'], 'data' => $data['data'][$path])
			);
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
		
		$component =& ClassRegistry::getObject('Placeholder');
		if (!$component)
			return;

		$data = $component->pullData($type); 
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
