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
			$line = trim($line);
			if (strlen($line) == 0 || !in_array($line[0], array('M', 'A', '?'))) {
				continue;
			}
			list($svn_info, $file) = preg_split('/[\s]+/', $line, -1, PREG_SPLIT_NO_EMPTY);
			if (strlen($svn_info) > 1) {
				$svn_info = substr($svn_info, 0, 1);
			}

			$file_info = $this->__needsProcessing($svn_info, $file);
			if ($file_info===false) {
				continue;
			}

			$processing = 'Processing ' . str_replace(getcwd(), '', $file);
			$separator = str_repeat('=', strlen($processing));
			$this->out($separator);
			$this->out($processing);
			$this->out($separator);
			$this->out('>> ' . $file_info['status']);
			
			if (!$file_info['has_header']) {
				$this->out('   - Adding Ósmosis header');
				if ($this->askContinue('    - Do you wish to add Ósmosis\' header to this file?')) {
					$file_info['has_header'] = $this->add_header($file_info);
					if($file_info['has_header']) {
						$this->out('    - Header added');
					} else {
						$this->err('Header could not be added');
					}
				}
			}
			
			if (!$file_info['versioned']) {
				$this->out('   - Adding file to subversion');
				if (!$file_info['versioned'] = $this->svn_add($file)) {
					$this->err('    - Could not add this file to subversion!');
				} else {
					$this->out('    - File added to subversion!');
				}
			}
			
			if ($file_info['versioned']) {
				$this->out('   - Setting svn:keywords');
				if ($this->svn_keywords($file_info)) {
					$this->out('    - Keywords set: ' . $file_info['keywords']);
				} else {
					$this->err('Keywords could not be set');
				}
			}
			
			$this->out('');
		}
	}
	
	
	function __needsProcessing($svn_info, $file) {
		$status = '';
		$versioned = $svn_info != '?';
		$statuses = array(
			'M' => 'File is in svn but has modifications',
			'A' => 'File is new in svn',
			'?' => 'File has not been added to svn'
		);
		if (in_array($svn_info, array_keys($statuses))) {
			$status = $statuses[$svn_info];
		} else {
			return false;
		}
		if (preg_match('/php|js$/', $file, $extension) !=1) {
			return false;
		}
		$extension = $extension[0];
		$keywords = $this->__getKeywords($file, $versioned);
		$has_header = $this->__hasHeader($file);
		return compact('file', 'extension', 'versioned', 'svn_info', 'status', 'keywords', 'has_header');
	}
	
	/**
	 * Returns the keywords to set to the file (merges the existing ones with the ones needed in the header)
	 *
	 * @param string $file path to file
	 * @param string $versioned if this file is already in svn
	 * @param string $keywords keywords needed by the header
	 * @return string list of space separated keywords
	 */
	function __getKeywords($file, $versioned, $keywords = array('LastChangedBy', 'Date', 'Revision', 'Id')) {
		if (!$versioned) {
			return $keywords;
		}
		$propget = "svn propget svn:keywords $file";
		exec($propget, $output, $status);
		foreach ($output as $i => $value) {
			if (empty($value)) unset($output[$i]);
		}
		$output = trim(implode(' ', $output));
		$output = explode(' ', $output);
		
		// array_merge doesn't work as we want here (only with string keys)
		$output = array_combine($output, $output);
		$keywords = array_combine($keywords, $keywords);
		$output = array_merge($output, $keywords);
		return implode(' ', array_keys($output));
	}
	
	/**
	 * Determines if a file has the header already
	 *
	 * @param string $file path to file
	 * @return boolean
	 */
	function __hasHeader($file) {
		$file = new File($file);
		$contents = $file->read();
		$file->close();
		if (strpos($contents, 'This file is part of Ósmosis LMS.')===false) {
			return false;
		}
		return true;
	}
	/**
	 * Add Ósmosis header information to file if does't have it.
	 *
	 * @param string $file path to file.
	 * @param string $extension php or js
	 * @return boolean True if header added 
	 **/
	function add_header($file_info) {
		$file = new File($file_info['file']);
		$contents = $file->read();
		$contents = trim($contents);
		switch ($file_info['extension']) {
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
	 **/
	function svn_add($file) {
		$add = "svn add $file";
		// if (!$this->askContinue("$add?")) {
		// 	return false;
		// }
		exec($add, $output, $status);
		return $status === 0;
	}
	
	/**
	 * Sets keywords to a file
	 *
	 * @return boolean
	 **/
	function svn_keywords($file_info) {
		$propset = 'svn propset svn:keywords \' ' . $file_info['keywords'] . '\' ' . $file_info['file'];
		exec($propset, $output, $status);
		return $status === 0;
	}
}
?>