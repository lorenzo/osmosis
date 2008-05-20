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
class ChatsController extends ChatAppController {

	var $name = 'Chats';
	var $helpers = array('Xml');
	var $uses = array('Member');
	
	function beforeFilter() {
		parent::beforeFilter();
		Configure::write('debug',0);
	}
	
	function connect() {
		$time = ($this->Session->check('Chat.lastPoll')) ? $this->Session->read('Chat.lastPoll') : time();
		$this->set('status',1);
		$this->set('timestamp',$time);
	}
	
	function contact_list($chat_id = null) {
		$enrollments = $this->Member->Enrollment->find('all',
		array(
			'conditions' => array('member_id' => $this->Auth->user('id')),
			'restrict'	=> 'Enrollment'
			)
		);
		
	}
	
	function user($id) {
		$user = $this->Member->isOnline($id);
		$this->set('user', $user);
		$this->set('status',empty($user) ? 2 :1);
	}
	
	protected function __updateOnlineUsers() {
		if (!$this->RequestHandler->isAjax())
			parent::__updateOnlineUsers();
	}
}
?>
