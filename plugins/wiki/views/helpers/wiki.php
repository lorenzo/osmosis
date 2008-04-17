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
		preg_match_all('/<a([\s^>].*)*href="([^"]+)"([\s^>].*)*>([^<]+)<\/a>/', $string, &$matches);
		foreach($matches[2] as $key => $match) {
			if (strpos($match, 'http://')===0) continue;
			$link = $this->Html->link($matches[4][$key],array(
					'controller' => 'entries',
					'action'     => 'view',
					preg_replace(array('/[^[A-Za-zÀ-ÖØ-öø-ÿ]\s]/', '/\\s+/') , array(' ', '_'), $matches[2][$key])
					), 
				array('title' => $matches[2][$key]));
			$string = str_replace($matches[0][$key],$link,$string);
		}
		return $string;
	}
}
?>