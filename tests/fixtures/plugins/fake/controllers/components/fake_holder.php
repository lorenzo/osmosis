<?php
App::import('Component','PlaceholderData');

class FakeHolderComponent extends PlaceHolderDataComponent {
	var $name = 'FakeHolder';
	var $auto = true;
	var $types = array('menu');
	
	function getData($type = null) {
		return array('var' => 'value');
	}
}
?>