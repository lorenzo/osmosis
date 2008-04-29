<?php

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