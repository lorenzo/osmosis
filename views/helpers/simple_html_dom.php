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

App::import('vendor', 'simplehtmldom', array('file' => 'simplehtmldom' . DS . 'simple_html_dom.php'));
class SimpleHtmlDomHelper extends Helper {
	
	/**
	 * This function takes a html string and searches for style tags
	 * and replaces those style rules in the html.
	 * It removes the style tags
	 *
	 * @param string $html HTML string to convert
	 * @param string $removeClass wether to remove the class attribute from affected elements
	 * @param string $removeID wether to remove the id attribute from affected elements
	 * @return string trimmed html without style tags and rules applied as style attributes 
	 */
	function globalStylesToAttibutes($html, $removeClass = true, $removeID = false) {
		list($dom, $css) = $this->__styleRules($html);

		foreach ($css as $selector => $rules) {
			$elements = $dom->find($selector);
			foreach ($elements as $element) {
				$element->setAttribute('style', $rules);
				if ($removeClass) {
					$element->removeAttribute('class');
				}
				if ($removeID) {
					$element->removeAttribute('id');
				}
			}
		}
		
		return trim($dom->innertext);
	}
	
	/**
	 * Strips style tags from an html string and returns a dom object and its style rules
	 *
	 * @param string $html HTML string to convert
	 * @return array dom object and array of style rules
	 */
	function __styleRules($html) {
		$dom =& str_get_html($html);
		$styles = $dom->find('style');
		$css = $keys = $values = array();
		foreach ($styles as $element) {
			$rules = trim($element->innertext);
			$rules = str_replace("\n", '', $rules);
			$rules = preg_replace('/\s*;\s*/', ';', $rules);
			$rules = preg_replace('/\s*(\{|\})\s*/', '$1', $rules);
			$rules = explode('}', $rules);
			unset($rules[sizeof($rules)-1]);
			foreach ($rules as $rule) {
				$rule = trim($rule);
				list($keys[], $values[]) = explode('{', $rule);
			}
			$css = array_combine($keys, $values);
			$element->outertext = '';
		}
		return array($dom, $css);
	}
}
?>