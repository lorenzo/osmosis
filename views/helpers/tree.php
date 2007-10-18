<?php 
/**
 * TreeHelper class.
 *
 * Written for bakery to show an example of parsing
 * data from findAllThreaded().
 */

/*

Copyright (c) 2006 James Hall

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 
*/

class TreeHelper extends Helper
{
	var $tab = "	";
	var $helpers = array('Html');
	
	function show($name, $data, $options=null) {
		list($modelName, $fieldName) = explode('/', $name);
		$output = $this->listElement($data, $modelName, $fieldName, 0, $options);
		
		return $this->output($output);
	}
	
	function listElement($data, $modelName, $fieldName, $level, $options = null) {
		$url = array();
		if (isset($options['link']['url']['controller'])) {
			$url['controller'] = $options['link']['url']['controller'];
		}
		if (isset($options['link']['url']['action'])) {
			$url['action'] = $options['link']['url']['action'];
		}
		$tabs = "\n" . str_repeat($this->tab, $level * 2);
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
						if (strpos($field, ':')===0) {
							$field = substr($field, 1);
							$params[$index] = $val[$modelName][$field];
						}
					}
					$params = Set::merge($url, $params);
					$value = $this->Html->link($value, $params, array('target' => 'viewport'));
				}
			}
			$output .= $li_tabs . "<li>".$value;
			if(isset($val['children'][0]))
			{
				$output .= $this->listElement($val['children'], $modelName, $fieldName, $level+1, $options);
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
