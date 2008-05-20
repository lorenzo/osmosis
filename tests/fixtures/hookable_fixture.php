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
class HookableFixture extends CakeTestFixture {
    var $name = 'Hookable';
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary', 'extra'=> 'auto_increment'),		
		'title' => array('type' => 'string', 'null' => false),
		'body' => 'text',
		'created' => 'datetime',
		'modified' => 'datetime'
	);
	
	var $records = array(
		array ('id' => 1, 'title' => 'First Article', 'body' => 'First Article Body', 'created' => '2007-03-18 10:39:23', 'modified' => '2007-03-18 10:41:31'),
		array ('id' => 2, 'title' => 'Second Article', 'body' => 'Second Article Body', 'created' => '2007-03-18 10:41:23', 'modified' => '2007-03-18 10:43:31'),
		array ('id' => 3, 'title' => 'Third Article', 'body' => 'Third Article Body', 'created' => '2007-03-18 10:43:23', 'modified' => '2007-03-18 10:45:31')
	);
} 
?>
