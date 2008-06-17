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

App::import('File', 'Core');
class OsmosisShell extends Shell {
	
	/**
	 * Header file content
	 *
	 * @var string
	 **/
	var $__header;
	
	/**
	 * Main function
	 *
	 * @return void
	 */
	function main() {
		$here = $this->params['working'];
		$st = exec("svn st $here", $modified);
		$header = new File($here . DS . 'file_header.txt');
		$this->__header = $header->read();
		$this->out('');
		foreach ($modified as $n => $line) {
			list($svn_info, $file) = preg_split('/[\s]+/', $line, -1, PREG_SPLIT_NO_EMPTY);
			if ($svn_info == '?' && preg_match('/\.(php)|\.(js)/', $file, $matches)) {
				$processing = "Processing $file";
				$this->out($processing);
				if (!$this->askContinue()) {
					$this->out('skipped...');
					$this->out('');
					continue;
				}
				if (!$this->add_header($file, $matches[1])) {
					$this->err('Header could not be added');
					$this->out('');
					continue;
				}
				if (!$this->svn_add($file)) {
					$this->out('skipped...');
					$this->out('');
					continue;
				}
				if (!$this->svn_keywords($file)) {
					$this->err('Keywords could not be set');
				}
				$this->out(str_repeat('=', strlen($processing)) . "\n");
				$this->out('');
			}
		}
	}
	
	/**
	 * Add Ósmosis header information to file if does't have it.
	 *
	 * @param string $file path to file.
	 * @param string $extension php or js
	 * @return boolean True if header added 
	 **/
	function add_header($file, $extension) {
		$file = new File($file);
		$contents = $file->read();
		if (strpos($contents, 'This file is part of Ósmosis LMS.')!==false) {
			return false;
		}
		$contents = preg_replace('/^[\s]+/', '', $contents);
		switch ($extension) {
			case 'php':
				if (strpos($contents, '<?php')===0) {
					$new_content = preg_replace('/^<\?php/', "<?php\n" . $this->__header, $contents);
				} else {
					return false;
				}
			break;
			case 'js':
				$new_content = $this->__header . "\n" . $contents;
			break;
			default:
				return false;
		}
		$file->write($new_content);
		$file->close();
		return true;
	}
	
	/**
	 * Ask user permission
	 *
	 * @return boolean
	 **/
	function askContinue($message = 'continue?') {
		$response = '';
		while ($response == '') {
			$response = $this->in($message, array('y', 'n'), 'y');
		}
		if (strtoupper($response) == 'N') {
			return false;
		}
		return true;
	}
	
	/**
	 * Adds a file to subversions
	 *
	 * @return boolean true if added
	 * @author Joaquín Windmüller
	 **/
	function svn_add($file) {
		$add = "svn add $file";
		if (!$this->askContinue("$add?")) {
			return false;
		}
		exec($add, $output, $status);
		if ($status === 0) {
			return true;
		}
		return false;
	}
	
	/**
	 * Sets keywords to a file
	 *
	 * @return boolean
	 * @author Joaquín Windmüller
	 **/
	function svn_keywords($file) {
		$propset = "svn propset svn:keywords 'LastChangedBy Date Revision Id' $file";
		exec($propset, $output, $status);
		if ($status === 0) {
			$this->out("\nKeywords set");
			return true;
		}
		return false;
	}
}
?>