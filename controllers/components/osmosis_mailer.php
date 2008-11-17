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

App::import('Model', 'Setting');
class OsmosisMailerComponent extends Object {
	
	var $controller;
	var $Setting;
	var $configs = array(
		'sendAs'	=> 'both',
		'delivery'	=> 'mail'
	);
	var $components = array('Email', 'SwiftEmail');
	
	function initialize(&$controller) {
		$this->controller =& $controller;
		$this->Email = $this->SwiftEmail;
		$this->Email->Controller =& $controller;
		$this->Setting = ClassRegistry::init('Setting');
		$dbconfigs = $this->Setting->find('all', array('conditions' => array('key LIKE' => 'Mailer.%')));
		$dbconfigs =Set::combine($dbconfigs, '{n}.Setting.key', '{n}.Setting.value');
		foreach ($dbconfigs as $key => $value) {
			unset($dbconfigs[$key]);
			$dbconfigs[str_replace('Mailer.', '', $key)] = $value;
		}
		$this->configs = array_merge($this->configs, $dbconfigs);
		return true;
	}
	
	function __from($only = false) {
		$name = $this->configs['name'];
		$email = $this->configs['username'] . '@' . $this->configs['domain'];
		switch ($only) {
			case 'name':
				return $name;
				break;
			case 'email':
				return $email;
				break;
			default:
				return $name . ' <' . $email . '>';
				break;
		}
	}
	
	function sendEmail($configs) {
		$configs = array_merge($this->configs, $configs);
		$this->Email->to		= $configs['to'];
		$this->Email->from		= $this->__from('email');
		$this->Email->replyTo	= $this->__from('email');
        $this->Email->subject	= $configs['subject'];
		$this->Email->template	= $configs['template'];
		$this->Email->sendAs	= $configs['sendAs'];
		$this->Email->delivery	= $configs['delivery'];
		if ($configs['usesmtp']) {
			$this->Email->delivery = 'smtp';
			$this->Email->smtpOptions['host'] = $configs['smtphost'];
			if (isset($configs['smtplogin'])) {
				$this->Email->smtpOptions['username'] = $configs['smtplogin'];
				$this->Email->smtpOptions['password'] = $configs['smtppassword'];
				$this->Email->smtpOptions['port'] = $configs['smtpport'];
			}
		}
		return $this->Email->send();
	}
}
?>