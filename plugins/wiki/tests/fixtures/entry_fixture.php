<?php
class EntryFixture extends CakeTestFixture {
    var $name = 'Entry';
  	var $import = array('model' => 'Entry');
	var $records = array( 
		array(
			'id'=>1,
			'wiki_id' => 1,
			'title'=>'a title',
			'content' => 'a content',
			'member_id' => 2
		)
	);
} 
?>
