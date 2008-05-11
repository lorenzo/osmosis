<?php
class ChatsController extends ChatAppController {

	var $name = 'Chats';
	var $helpers = array('Xml');
	var $uses = array();
	
	function beforeFilter() {
		parent::beforeFilter();
		Configure::write('debug',0);
	}
	
	function connect() {
		$this->set('status',1);
		$this->set('timestamp',time());
	}
	
	function contact_list($chat_id = null) {
		App::import('Model','OnlineUser');
		$online = new OnlineUser;
		$users = $online->find('all');
		$members = Set::extract('/Member',$users);
	}
	
	function user($id) {
		App::import('Model','OnlineUser');
		$online = new OnlineUser;
		$user = $online->find('first',array('conditions' => array('member_id' => $id)));
		$this->set('user',$user);
		$this->set('status',empty($user) ? 2 :1);
	}
	
	protected function __updateOnlineUsers() {
		if (!$this->RequestHandler->isAjax())
			parent::__updateOnlineUsers();
	}
}
?>