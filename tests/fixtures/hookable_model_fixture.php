<?php
class HookableModelFixture extends CakeTestFixture {
	var $name = 'HookableModel';
	var $table = 'hookables';
	var $fields = array(
			'id' => array('type' => 'integer', 'key' => 'primary'),
			'locale' => array('type' => 'string', 'length' => 6, 'null' => false),
			'model' => array('type' => 'string', 'null' => false),
			'foreign_key' => array('type' => 'integer', 'null' => false),
			'field' => array('type' => 'string', 'null' => false),
			'content' => array('type' => 'text'));
	var $records = array(
		array('locale' => 'eng', 'model' => 'TranslatedItemWithTable', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Another Title #1'),
		array('locale' => 'eng', 'model' => 'TranslatedItemWithTable', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Another Content #1')
	);
}
?>