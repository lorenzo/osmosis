<?php
/* SVN FILE: $Id: subject_fixture.php 323 2008-05-20 03:23:52Z joaquin.win $ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision: 323 $
 * @modifiedby		$LastChangedBy: joaquin.win $
 * @lastmodified	$Date: 2008-05-19 22:53:52 -0430 (Mon, 19 May 2008) $
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
*/

class TopicFixture extends CakeTestFixture {
	var $name = 'Topic';
	var $table = 'forum_topics';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => false),
			'name' => array('type'=>'string', 'null' => false, 'length' => 120),
			'description' => array('type'=>'string', 'null' => false),
			'forum_id' => array('type'=>'integer', 'null' => false),
			'created' => array('type'=>'datetime', 'null' => false),
			'status' => array('type'=>'string', 'null' => false, 'default' => 'unlocked', 'length' => 20),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'course_id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'description'  => 'Lorem ipsum dolor sit amet',
			'forum_id'  => 1,
			'created'  => '2008-06-06 14:59:46',
			'status'  => 'Lorem ipsum dolor '
			));
}
?>
