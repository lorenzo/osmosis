<?php
/* SVN FILE: $Id$ */
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
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */

class WikiSchema extends CakeSchema {
	var $name = 'Wiki';

	var $wiki_wikis = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => false),
			'name' => array('type'=>'string', 'null' => false),
			'description' => array('type'=>'text', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $wiki_entries = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'wiki_id' => array('type'=>'integer', 'null' => false),
			'member_id' => array('type'=>'integer', 'null' => false),
			'title' => array('type'=>'string', 'null' => false,'length' => 100),
			'content' => array('type'=>'text', 'null' => false),
			'revision' => array('type'=>'integer', 'null' => false, 'default' => '1', 'length' => 6),
			'created' => array('type'=>'datetime', 'null' => false),
			'updated' => array('type'=>'datetime', 'null' => false),
			'slug' => array('type'=>'string', 'null' => false,'length' => 110),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $wiki_revisions = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'entry_id' => array('type'=>'integer', 'null' => false),
			'member_id' => array('type'=>'integer', 'null' => false),
			'title' => array('type'=>'string', 'null' => false),
			'content' => array('type'=>'text', 'null' => false),
			'revision' => array('type'=>'integer', 'null' => false, 'length' => 6),
			'created' => array('type'=>'datetime', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
}
?>
