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
class Post extends BlogAppModel {

	var $name = 'Post';
	var $useTable = 'blog_posts';

	/**
	 * Validation Rules for Fields
	 *
	 * @var array
	 **/
	var $validate = array(
		'title' => array(
		    'required' => array(
		        'rule'		=> array( 'custom','/.+/'),
		        'required'	=> true,
		        'on'		=> 'create'
			)
		),
		'body' => array(
		    'required'		=> array(
		        'rule'		=> array( 'custom','/.+/'),
		        'required'	=> true,
		        'on'		=> 'create'
			)
		),
		'blog_id' => array(
		    'required' => array(
		        'rule'		=> array( 'custom','/.+/'),
		        'required'	=> true,
		        'on'		=> 'create'
			)
		),
	);

	/**
	 * Attached behaviors
	 *
	 * @var array
	 **/
	var $actsAs = array(
		'Sluggable' => array('label' => 'title', 'slug' => 'slug', 'overwrite' => false)
	);

	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/
	var $belongsTo = array(
		// Post BelongsTo Post
		'Blog' => array(
			'className'		=> 'Blog.Blog',
			'foreignKey'	=> 'blog_id',
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> '',
			'counterCache'	=> ''
		)
	);

	/**
	 * HasMany (N-1) relation descriptors
	 *
	 * @var array
	 **/
	var $hasMany = array(
		// Post HasMany Comments
		'Comment' => array(
			'className'		=> 'Blog.Comment',
			'foreignKey'	=> 'post_id',
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> '',
			'limit'			=> '',
			'offset'		=> '',
			'dependent'		=> true,
			'exclusive'		=> '',
			'finderQuery'	=> '',
			'counterQuery'	=> ''
		)
	);
	
	/**
	 * Model contructor. Initializes the validation error messages with i18n
	 *
	 * @see Model::__construct
	 */
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'title.required', __('Please write the title of the post', true)
		);
		$this->setErrorMessage(
			'body.required', __('Please write the content of the posts', true)
		);
		$this->setErrorMessage(
			'blog_id.required', __('Blog ID missing', true)
		);
		parent::__construct($id,$table,$ds);
	}
}
?>