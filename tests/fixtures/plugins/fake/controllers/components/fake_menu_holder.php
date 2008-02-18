<?php
App::import('Component','PlaceholderData');

class FakeMenuHolderComponent extends PlaceHolderDataComponent {
	var $name = 'FakeMenu';
	var $type = 'menu';
	var $auto = true;
	
	function getData() {
		return array('var' => 'value');
	}
}
?>