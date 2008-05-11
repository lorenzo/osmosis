<?php
class Message extends ChatAppModel {

	var $name = 'Message';
	var $useTable = 'chat_messages';
	var $belongsTo = array(
			'Sender' => array('className' => 'Member',
								'foreignKey' => 'sender_id',
								'conditions' => '',
								'fields' => array('id','username','full_name'),
			),
			'Receiver' => array('className' => 'Member',
								'foreignKey' => 'receiver_id',
								'conditions' => '',
								'fields' => array('id','username','full_name'),
			),
			/*'Room' => array('className' => 'Room',
								'foreignKey' => 'room_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)*/
	);
	
	function send($sender_id,$receiver_id,$message) {
		$data = array();
		$data['Message']['sender_id'] = $sender_id;
		$data['Message']['receiver_id'] = $receiver_id;
		$data['Message']['text'] = $message;
		$data['Message']['created'] = time();
		return $this->save($data);
	}
	
	function receive($receiver_id,$since) {
		$conditions = array('receiver_id' => $receiver_id, 'created' => "> $since");
		return $this->find('all',array(
			'conditions' => $conditions,
			'order' => 'created ASC',
			'limit' => 10,
			'fields' => array('id','created','text','sender_id', 'Sender.full_name')
			)
		);
	}

}
?>