<?php
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