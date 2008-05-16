<?php
App::import('Component','PlaceholderData');

class FakeHolderComponent extends PlaceHolderDataComponent {
	var $name = 'FakeHolder';
	var $auto = true;
	var $types = array('menu');
	
	function menu() {
		return array('var' => 'value');
	}
}
?>