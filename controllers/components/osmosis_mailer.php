<?php
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