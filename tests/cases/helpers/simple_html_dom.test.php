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

App::import('Helper','SimpleHtmlDom');
class SimpleHtmlDomHelperTest extends CakeTestCase {
	var $fixtures = null;
	var $SimpleHtmlDom;
	
	function setUp() {
		parent::setUp();
		Router::reload();
		$this->SimpleHtmlDom = new SimpleHtmlDomHelper();
	}
	
	function tearDown() {
		if (isset($this->SimpleHtmlDom)) {
			unset($this->SimpleHtmlDom);
		}
	}	
	
	function testGlobalStylesToAttibutes() {
		$input = <<<eohtml
<style type="text/css" media="screen">
	.note {border:#ccc 1px dashed;
		background:#f5f5f5;}
	.baz {border:red 1px solid;}
</style>
	<style type="text/css" media="screen">
		.note1 {border:#ccc 1px dashed;background:#f5f5f5;}
		.baz1 {border:red 1px solid;}
	</style>
<p>Hello, this doesn't have any styling</p>
<p class="note">This should be styled</p>
eohtml;
		$expected = <<<eohtml
<p>Hello, this doesn't have any styling</p>
<p style="border:#ccc 1px dashed;background:#f5f5f5;">This should be styled</p>
eohtml;
		$this->assertEqual($this->SimpleHtmlDom->globalStylesToAttibutes($input), $expected);
	}
}
?>