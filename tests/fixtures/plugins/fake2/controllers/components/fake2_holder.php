<?php
App::import('Component','PlaceholderData');

class Fake2HolderComponent extends PlaceHolderDataComponent {
	var $name = 'Fake2Holder';
	var $auto = true;
	var $types = array('other');
	
	function other() {
		return array('var' => 'value');
	}
}
?>