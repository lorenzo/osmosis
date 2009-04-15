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

class HTMLPurifier_Filter_Ustream extends HTMLPurifier_Filter
{
    
    public $name = 'Ustream';
    
    public function preFilter($html, $config, $context) {
        $pre_regex = '#<object[^>]+>.+?'.
            'http://www.ustream.tv/([A-Za-z0-9\-\/]+).+?</object>#s';
        $pre_replace = '<span class="ustream-embed">\1</span>';
        return preg_replace($pre_regex, $pre_replace, $html);
    }
    
    public function postFilter($html, $config, $context) {
        $post_regex = '#<span class="ustream-embed">([A-Za-z0-9\-_\/]+)</span>#';
        $post_replace = '<object width="450" height="320" '.
            'data="http://www.ustream.tv/\1">'.
            '<param name="movie" value="http://www.ustream.tv/\1"></param>'.
            '<param name="wmode" value="transparent"></param>'.
            '<param name="allowfullscreen" value="true"></param>'.
            '<!--[if IE]>'.
            '<embed src="http://www.ustream.tv/\1"'.
            'type="application/x-shockwave-flash"'.
            'wmode="transparent" width="450" height="320" allowfullscreen="true" />'.
            '<![endif]-->'.
            '</object>';
        return preg_replace($post_regex, $post_replace, $html);
    }
    
}
?>
