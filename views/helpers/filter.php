<?php
class FilterHelper extends Helper {
	
	var $helpers = array('Html');
	var $engine = null;
	
	function _initEngine() {
		Configure::load('latex');
	}
}
?>
