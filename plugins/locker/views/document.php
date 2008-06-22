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
App::import('View','Media');
class DocumentView extends MediaView {

/**
 * Constructor
 *
 * @param object $controller
 */
	function __construct(&$controller) {
		parent::__construct($controller);
	}

/**
 * Enter description here...
 *
 * @return unknown
 */
	
	function render() {
		$name = null;
		$download = null;
		$extension = null;
		$id = null;
		$modified = null;
		$path = null;
		$size = null;
		if (isset($this->viewVars['mime']) && !empty($this->viewVars['mime']))
			$this->mimeType[$this->viewVars['extension']] = $this->viewVars['mime'];

		extract($this->viewVars, EXTR_OVERWRITE);
		
		if (!$extension) {
			$extension = 'bin';
		}

		if (file_exists($path) && isset($extension) && array_key_exists($extension, $this->mimeType) && connection_status() == 0) {
			$chunkSize = 1 * (1024 * 8);
			$buffer = '';
			$fileSize = @filesize($path);
			$handle = fopen($path, 'rb');
			if ($handle === false) {
				return false;
			}
			if (isset($modified) && !empty($modified)) {
				$modified = gmdate('D, d M Y H:i:s', strtotime($modified, time())) . ' GMT';
			} else {
				$modified = gmdate('D, d M Y H:i:s').' GMT';
			}

			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Last-Modified: $modified");

			if ($download) {
				$contentType = 'application/octet-stream';
				$agent = env('HTTP_USER_AGENT');

				if (preg_match('%Opera(/| )([0-9].[0-9]{1,2})%', $agent) || preg_match('/MSIE ([0-9].[0-9]{1,2})/', $agent)) {
					$contentType = 'application/octetstream';
				}

				header('Content-Type: ' . $contentType);
				header("Content-Disposition: attachment; filename=\"" . $name . "\";");
				header("Expires: 0");
				header('Accept-Ranges: bytes');
				header("Cache-Control: private", false);
				header("Pragma: private");

				$httpRange = env('HTTP_RANGE');

				if (isset($httpRange)) {
					list ($toss, $range) = explode("=", $httpRange);
					str_replace($range, "-", $range);

					$size = $fileSize - 1;
					$length = $fileSize - $range;

					header("HTTP/1.1 206 Partial Content");
					header("Content-Length: $length");
					header("Content-Range: bytes $range$size/$fileSize");
					fseek($handle, $range);
				} else {
					header("Content-Length: " . $fileSize);
				}
			} else {
				header("Content-Type: " . $this->mimeType[$extension]);
				header("Content-Length: " . $fileSize);
			}
			@ob_end_clean();

			while (!feof($handle) && connection_status() == 0) {
				set_time_limit(0);
				$buffer = fread($handle, $chunkSize);
				echo $buffer;
				@flush();
				@ob_flush();
			}
			fclose($handle);
			return((connection_status() == 0) && !connection_aborted());
		}
		return false;
	}
}
?>
