<?php
class AgendaSchema extends CakeSchema {
	var $name = 'Agenda';

	var $agenda_events = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'member_id' => array('type'=>'integer', 'null' => false),
			'date' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
			'location' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
			'all_day' => array('type'=>'boolean', 'null' => false, 'default' => '0'),
			'headline' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'detail' => array('type'=>'text', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $agenda_events_tags = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'event_id' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 10),
			'tag_id' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 10),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
}

?>