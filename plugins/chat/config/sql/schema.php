<?php
class ChatSchema extends CakeSchema {
	var $name = 'Chat';

	var $chat_messages = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'sender_id' => array('type'=>'integer', 'null' => false, 'length' => 10),
			'receiver_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'room_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'created' => array('type'=>'integer', 'null' => false),
			'text' => array('type'=>'string', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $chat_rooms = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $chat_members_rooms = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'member_id' => array('type'=>'integer', 'null' => false, 'length' => 10),
			'room_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
}
?>
