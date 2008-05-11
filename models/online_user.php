<?php
class OnlineUser extends AppModel {

	var $name = 'OnlineUser';
	var $primaryKey = 'member_id';

	var $belongsTo = array(
			'Member' => array('className' => 'Member',
								'foreignKey' => 'member_id',
								'conditions' => '',
								'fields' => array('id','full_name','username'),
								'order' => ''
			)
	);
	
	function beforeFind() {
		$time = Cache::read('OnlineUser.lastCheck');
		
		if (!$time) {
			$time = time();
			Cache::write('OnlineUser.lastCheck',$time,$time + Configure::read('Session.timeout'));
		}
		
		$expires = $time +  Configure::read('Session.timeout');
		if (Configure::read('Cache.disabled') == true || time() > $expires) {
			$db =& ConnectionManager::getDataSource($this->useDbConfig);
			$db->execute("DELETE FROM " . $this->useTable . " WHERE " . $db->name($this->useTable .'.modified') . " < ". $db->value($expires));
			Cache::write('OnlineUser.lastCheck',$time);
		}
		return true;
	}

}
?>