<?php
class MessagesController extends ChatAppController {

	var $name = 'Messages';
	
	function beforeFilter() {
		parent::beforeFilter();
		Configure::write('debug',1);
	}

	function send($to) {
		if (!$this->Message->send($this->Auth->user('id'),$to,$this->data['Message']['text']))
			$error = __('The message could not be delivered');
		$this->set(compact('error'));
	}
	
	function receive($since) {
		//$tries = 500;
		//while($tries-- > 0) {
			$messages = $this->Message->receive($this->Auth->user('id'),$since);
		//	if (count($messages) > 0) {break;}
		//	$this->_sleeper(200);
		//}
		
		$time = (empty($messages)) ? $since : time();
		$this->set('messages',$messages);
		$this->set('timestamp',$time);
	}
	
/*	function _sleeper($mSec) {
	    static $socket=false;
	    if($socket===false){
	        $socket=array(socket_create(AF_INET,SOCK_STREAM,0));
	    }
	    $pSock=$socket;
	    $uSex = $mSec * 1000;
	    socket_select($read=NULL,$write=NULL,$pSock,0,$mSec);
	    return true;
	}
*/
	
	function isAuthorized() {
		return true;
	}
}
?>