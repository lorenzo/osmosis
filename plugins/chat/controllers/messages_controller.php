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
class MessagesController extends ChatAppController {

	var $name = 'Messages';
	
	function beforeFilter() {
		parent::beforeFilter();
	}

	function send($to) {
		if (!$this->Message->send($this->Auth->user('id'),$to,$this->data['Message']['text']))
			$error = __('The message could not be delivered');
		$this->set(compact('error'));
	}
	
	function receive($since = 0) {
		if (!$since) {
			$since = ($this->Session->check('Chat.lastPoll')) ? $this->Session->read('Chat.lastPoll') : time();
		}

		$messages = $this->Message->receive($this->Auth->user('id'),$since);
		
		if (!empty($messages)) {
			$since = time();
			$this->Session->write('Chat.lastPoll',$since);
		}
		$this->set('messages',$messages);
		$this->set('timestamp',$since);
	}

	function isAuthorized() {
		return $this->Auth->user();
	}
}
?>
