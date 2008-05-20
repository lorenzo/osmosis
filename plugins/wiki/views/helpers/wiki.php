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

class WikiHelper extends AppHelper {
	var $helpers = array('Html');
	
	function fixHeadings($string) {
		$replace = array_reverse(array('h1'=>'h2','h2'=>'h3','h3'=>'h4','h4'=>'h5','h5'=>'h6'));
		foreach($replace as $k => $v) {
			$string = r($k,$v,$string);
		}
		return $string;
	}
	
	function format($string) {
		$string = $this->convertLinks($this->fixHeadings($string));
		return $string;
	}
	
	function convertLinks($string) {
		preg_match_all('/<a([\s^>].*)*href="([^"]+)"([\s^>].*)*>([^<]+)<\/a[.^<]*>/U', $string, &$matches);
		$entry = ClassRegistry::getObject('Entry');
		$view = ClassRegistry::getObject('View');
		
		foreach($matches[2] as $key => $match) {
			if (strpos($match, 'http://')===0) continue;
			
			$locators = array();
			
			if (isset($view->params['named']['wiki_id'])) {
				$locators['wiki_id'] = $view->params['named']['wiki_id'];
			}
			
			if (isset($view->params['named']['course_id'])) {
				$locators['course_id'] = $view->params['named']['course_id'];
			}
			
			$slug = $entry->generateSlug($matches[2][$key]);
			$url = array('controller' => 'entries');
			$attributes = array('title' => $matches[2][$key]);
			if (!$entry->created($slug,$locators)) {
				$url['action'] = 'add';
				$locators['title'] = $matches[2][$key];
				$attributes['class'] = 'unexistent';
			}else {
				$url['action'] = 'view';
				$url[] = $slug;
			}
			
			$url = Set::merge($url,$locators);
			
			
			
			$link = $this->Html->link($matches[4][$key],$url,$attributes);
			$string = str_replace($matches[0][$key],$link,$string);
		}
		return $string;
	}
}
?>
