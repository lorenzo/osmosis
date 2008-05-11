<?php 
/* SVN FILE: $Id$ */
/* ChatMessage Fixure generated on: 2008-05-03 12:05:52 : 1209831172*/

class ChatMessageFixture extends CakeTestFixture {
	var $name = 'ChatMessage';
	var $table = 'chat_messages';
	var $fields = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'sender_id' => array('type'=>'integer', 'null' => false, 'length' => 10),
			'receiver_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'room_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'created' => array('type'=>'datetime', 'null' => false),
			'text' => array('type'=>'string', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'sender_id'  => 1,
			'receiver_id'  => 1,
			'room_id'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2008-05-03 12:12:52',
			'text'  => 'Lorem ipsum dolor sit amet'
			));
}
?>