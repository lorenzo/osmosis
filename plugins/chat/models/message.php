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
class Message extends ChatAppModel {

	var $name = 'Message';
	var $useTable = 'chat_messages';

	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/	
	var $belongsTo = array(
		// Message BelongsTo Member (Sender)
		'Sender' => array(
			'className'		=> 'Member',
			'foreignKey'	=> 'sender_id',
			'conditions'	=> '',
			'fields'		=> array('id','username','full_name')
		),
		// Message BelongsTo Member (Receiver)
		'Receiver' => array(
			'className'		=> 'Member',
			'foreignKey'	=> 'receiver_id',
			'conditions'	=> '',
			'fields'		=> array('id','username','full_name'),
		),
		/*
		'Room' => array(
			'className' => 'Room',
			'foreignKey' => 'room_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		*/
	);

	/**
	 * Registers a message
	 *
	 * @param string $sender_id Id of the sending member
	 * @param string $receiver_id Id of the receiving member
	 * @param string $message Message sent
	 * @return boolean true on success
	 */
	function send($sender_id,$receiver_id,$message) {
		$data = array();
		$data['Message']['sender_id'] = $sender_id;
		$data['Message']['receiver_id'] = $receiver_id;
		$data['Message']['text'] = $message;
		$data['Message']['created'] = time();
		return $this->save($data);
	}

	/**
	 * Returns all messages since a date (timestamp)
	 *
	 * @param string $receiver_id Id of the receiving member
	 * @param int $since timestamp since last request
	 * @return mixed array of messages or false if none found
	 */
	function receive($receiver_id, $since) {
		return $this->find('all',array(
			'conditions'	=> array('receiver_id' => $receiver_id, 'created >' => "$since"),
			'order'			=> 'created ASC',
			'limit'			=> 10,
			'fields'		=> array('id','created','text','sender_id', 'Sender.full_name')
			)
		);
	}
}
?>