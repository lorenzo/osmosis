<?php

class WikiHelper extends AppHelper {
	
	function fixHeadings($string) {
		$replace = array_reverse(array('h1'=>'h2','h2'=>'h3','h3'=>'h4','h4'=>'h5','h5'=>'h6'));
		foreach($replace as $k => $v) {
			$string = r($k,$v,$string);
		}
		return $string;
	}
	
	function format($string) {
		$string = $this->fixHeadings($string);
		return $string;
	}
}
?>