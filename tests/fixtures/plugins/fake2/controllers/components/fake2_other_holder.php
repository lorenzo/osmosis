<?php
App::import('Component','PlaceholderData');

class Fake2OtherHolderComponent extends PlaceHolderDataComponent {
	var $name = 'Fake2Other';
	var $type = 'other';
	var $auto = true;
	
	function getData() {
		return array('var' => 'value');
	}
}
?>