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
class TreeHelper extends Helper
{
	var $tab = "	";
	var $helpers = array('Html');
	var $count = 1;
	
	function show($name, $data, $options=null, $htmlOptions=null) {
		list($modelName, $fieldName) = explode('/', $name);
		$output = $this->listElement($data, $modelName, $fieldName, $options, $htmlOptions);
		
		return $this->output($output);
	}
	
	function listElement($data, $modelName, $fieldName, $options = null, $htmlOptions=null) {
		$htmlOp = $htmlOptions;
		$url = array();
		if (isset($options['link']['url']['controller'])) {
			$url['controller'] = $options['link']['url']['controller'];
		}
		if (isset($options['link']['url']['action'])) {
			$url['action'] = $options['link']['url']['action'];
		}
		$tabs = "\n" . str_repeat($this->tab, $this->count * 2);
		$li_tabs = $tabs . $this->tab;
		
		$output = $tabs. "<ul>";
		foreach ($data as $key=>$val) {
			$value = $val[$modelName][$fieldName];
			if ($options && isset($options['link'])) {
				$condition = isset($options['link']['ifPresent']) ?
					isset($val[$modelName][$options['link']['ifPresent']]) : true;
				if ($condition) {
					$params = $options['link']['url'];
					foreach ($params as $index => $field) {
						if ($field[0]==':') {
							$field = substr($field, 1);
							$params[$index] = $val[$modelName][$field];
						}
					}
					$htmlOp['id'] = (isset($htmlOptions['id'])) ?
					        $htmlOptions['id'] :
					        'tree_element_';
					$htmlOp['id'] .= $this->count++;
					if (isset($htmlOptions['class'])) {
						$className = '';
						
						foreach ($htmlOptions['class'] as $className_item) {
							if ($className_item[0]==':') {
								$className_item = substr($className_item, 1);
								$className .= $val[$modelName][$className_item];
							} else $className .= $className_item;
						}
						$htmlOp['class'] = $className;
					}
					$params = Set::merge($url, $params);
					$value = $this->Html->link(
					    $value,
					    $params,
					    $htmlOp
					);
				}
			}
			$output .= $li_tabs . "<li>".$value;
			if(isset($val['children'][0]))
			{
				$output .= $this->listElement($val['children'], $modelName, $fieldName, $options, $htmlOptions);
				$output .= $li_tabs . "</li>";
			} else {
				$output .= "</li>";
			}
		}
		$output .= $tabs . "</ul>";
		
		return $this->output($output);
	}
}
?>
