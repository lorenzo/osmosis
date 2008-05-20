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
 * Component that rovides functions to purify, prevent xss attacks, and make standard-compliant html code
 */
App::import('Vendor','Wiki.diff/diff_engine');
class DiffComponent extends Object {
	
	
	function __get($param) {
		if($param == 'formater') {
			$this->formater = new HtmlDiffFormatter();
			return $this->formater;
		}
	}
	
	/**
	 * Initializes the component
	 */
	function startup(&$controller) {
		$this->controller = $controller;
	}
	
	
	function diff($old,$new) {
		//$old = strip_tags($old);
		//$new = strip_tags($new);
		$old = str_replace( "\r\n", "\n", $old );
		$new = str_replace( "\r\n", "\n", $new );
		$old = explode( "\n",$old);
		$new = explode( "\n",$new);
		return new Diff( $old, $new );
	}
	
	function format($diff) {
		$formatter = new HtmlDiffFormatter();
		return $this->formater->format( $diff );
	}
	
	function formatted_diff($old,$new) {
		return $this->format($this->diff($old,$new));
	}
}
