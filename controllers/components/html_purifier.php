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
/**
 * Component that provides functions to purify, prevent xss attacks, and make standard-compliant html code
 */
class HtmlPurifierComponent extends Object {
	
	function __get($member) {
		if($member == 'lib') {
			App::import('Vendor','htmlpurifier',array('file' =>'htmlpurifier/HTMLPurifier.auto.php'));
			$config = HTMLPurifier_Config::createDefault();
			$config->set('Cache','SerializerPath',CACHE);
			$config->set('HTML', 'TidyLevel', 'heavy');
			$config->set('Filter', 'YouTube', true);
			$this->lib = new HTMLPurifier($config);
			return $this->lib;
		}
	}
	
	/**
	 * Initializes the component
	 */
	function startup(&$controller) {
		$this->controller = $controller;
	}
	
	/**
	 * Cleans $html from possible xss and strip tags out from a whitelist. It also performs a replace of
	 * non-standart tags and converts them into a well-formatted html string.
	 *
	 * @param string $html
	 */
	
	function purify($html) {
		return $this->lib->purify($html);
	}
}
