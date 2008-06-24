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
class Blog extends BlogAppModel {

	var $name = 'Blog';
	var $useTable = 'blog_blogs';

	/**
	 * HasMany (N-1) relation descriptors
	 *
	 * @var array
	 **/
	var $hasMany = array(
		// Blog HasMany Post
		'Post' => array(
			'className'		=> 'Blog.Post',
			'foreignKey'	=> 'blog_id',
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> 'created DESC',
			'limit'			=> '',
			'offset'		=> '',
			'dependent'		=> '',
			'exclusive'		=> '',
			'finderQuery'	=> '',
			'counterQuery'	=> ''
		)
	);
	
	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/
	var $belongsTo = array(
		// Blog BelongsTo Member (Writer)
		'Member' => array(
			'className' => 'Member'
		)
	);
		
	/**
	 * Returns the blog (and creates it, if it doesn't exists) of the member
	 *
	 * @param $member_id int Id of the member 
	 * @param $just_id boolean wether the return value is the blog data or just the id
	 * @return mixed The parent folder data of the member's locker or false if not found
	 **/
	function userBlog($member_id) {
		$id = $this->field('id', compact('member_id'));
		if (!$id) {
			$blog = $this->save(array('Blog' => compact('member_id')));
			$id = $this->id;
		}
		return $id;
	}
}
?>
