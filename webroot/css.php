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
 * Enter description here...
 */
	require(CONFIGS . 'paths.php');
	require(CAKE . 'basics.php');
	require(LIBS . 'folder.php');
	require(LIBS . 'file.php');
/**
 * Enter description here...
 *
 * @param unknown_type $path
 * @param unknown_type $name
 * @return unknown
 */
	function make_clean_css($path, $name) {
		 require(VENDORS . 'csspp' . DS . 'csspp.php');
		 $data  =file_get_contents($path);
		 $csspp =new csspp();
		 $output=$csspp->compress($data);
		 $ratio =100 - (round(strlen($output) / strlen($data), 3) * 100);
		 $output=" /* file: $name, ratio: $ratio% */ " . $output;
		 return $output;
	}
/**
 * Enter description here...
 *
 * @param unknown_type $path
 * @param unknown_type $content
 * @return unknown
 */
	function write_css_cache($path, $content) {
		 if (!is_dir(dirname($path))) {
			  mkdir(dirname($path));
		 }
		 $cache=new File($path);
		 return $cache->write($content);
	}

	if (preg_match('|\.\.|', $url) || !preg_match('|^ccss/(.+)$|i', $url, $regs)) {
		 die(__('Wrong file name.'));
	}

	$filename = 'css/' . $regs[1];
	$filepath = CSS . $regs[1];
	$cachepath = CACHE . 'css' . DS . str_replace(array('/','\\'), '-', $regs[1]);

	if (!file_exists($filepath)) {
		 die(__('Wrong file name.'));
	}

	if (file_exists($cachepath)) {
		 $templateModified=filemtime($filepath);
		 $cacheModified   =filemtime($cachepath);

		 if ($templateModified > $cacheModified) {
			  $output=make_clean_css($filepath, $filename);
			  write_css_cache($cachepath, $output);
		 } else {
			  $output = file_get_contents($cachepath);
		 }
	} else {
		 $output=make_clean_css($filepath, $filename);
		 write_css_cache($cachepath, $output);
	}
	header("Date: " . date("D, j M Y G:i:s ", $templateModified) . 'GMT');
	header("Content-Type: text/css");
	header("Expires: " . gmdate("D, j M Y H:i:s", time() + DAY) . " GMT");
	header("Cache-Control: cache"); // HTTP/1.1
	header("Pragma: cache");        // HTTP/1.0
	print $output;
?>
