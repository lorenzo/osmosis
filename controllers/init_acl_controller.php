<?php
class InitAclController extends AppController {
	var $name = 'InitAcl';
	var $components = array('Acl','InitAcl');
	var $uses = array();
	var $controllers = array(
		'Members' => array('index','view','add','edit','delete'),
		'Courses' => array('index','view','add','edit','delete'),
		'Departments' => array('index','view','add','edit','delete'),
	);
	
	function init() {
		$this->InitAcl->deleteDB();
		// AROS
		$admin_id = $this->InitAcl->initRole('Admin');
		$instructor_id = $this->InitAcl->initRole('Instructor');
		$attendee_id = $this->InitAcl->initRole('Attendee');	
		$member = array('Member' => 
			array(
				'institution_id'	=> '00-00000',
		    		'full_name'		=> 'Administrator',
		    		'email'		=> 'admin@root.com',
		    		'phone'		=> '000000000',
		    		'country'		=> 'Venezuela',
		    		'city'		=> 'Caracas',
		    		'sex'			=> 'M',
		    		'role_id'		=> $admin_id,
		    		'username'		=> 'admin',
		    		'password'		=> 'admin'
    			)
		);
		$member_id = $this->InitAcl->initMember($member);
		
		//ACOS
		$id = $this->InitAcl->createAco(null, null, null, "ROOT");
		$con_id = $this->InitAcl->createAco(null, null, $id, "Controllers/");
		$con_id = $this->InitAcl->createAco(null, null, $con_id, "App/");
		foreach ($this->controllers as $controller => $actions) {
			$_id = $this->InitAcl->createAco(null, null, $con_id, $controller);
			foreach ($actions as $action) {
				$this->InitAcl->createAco(null, null, $_id, $action);
			}
		}
		$this->Acl->allow('Admin','ROOT');
		$this->autoRender = false;
	}
	
	function isAuthorized() {
		if(Configure::read('Auth.disabled')) {
			return true;
		}
		return false;
	}

}
?>
