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
class InitAclController extends AppController {
	var $name = 'InitAcl';
	var $components = array('Acl','InitAcl');
	var $uses = array('Member','Role');
	
	function init() {
		$this->InitAcl->deleteDB();
		// AROS
		$public_id = $this->InitAcl->initRole('Public');
		$member_id = $this->InitAcl->initRole('Member', $public_id);
		$attendee_id = $this->InitAcl->initRole('Attendee', $member_id);
		$helper_id = $this->InitAcl->initRole('Assistant', $attendee_id);
		$professor_id = $this->InitAcl->initRole('Professor', $helper_id);
		$creator_id = $this->InitAcl->initRole('Owner', $professor_id);
		$member = array('Member' => 
			array(
				'institution_id'=> '00-00000',
				'full_name'	=> 'Administrator',
				'email'		=> 'admin@root.com',
				'phone'		=> '000000000',
				'country'	=> 'Venezuela',
				'city'		=> 'Caracas',
				'sex'		=> 'M',
				'username'	=> 'admin',
				'password'	=> 'admin',
				'password_confirm'	=> 'admin',
				'admin'		=> 1
    		)
		);
		$member_id = $this->InitAcl->initMember($member);
		
		//ACOS
		$id = $this->InitAcl->createAco(null, null, null, "ROOT");
		$con_id = $this->InitAcl->createAco(null, null, $id, "Controllers/");
		$con_id = $this->InitAcl->createAco(null, null, $con_id, "App/");
		
		App::import('File','permissions',true,CONFIGS);
		$permissions = new OsmosisPermissions;
		foreach ($permissions as $controller => $actions) {
			if ($controller{0} == '_') continue;
			$_id = $this->InitAcl->createAco(null, null, $con_id, $controller);
			foreach ($actions as $action => $leastRole) {
				$this->InitAcl->createAco(null, null, $_id, $action);
				$this->Acl->Aro->Permission->create();
				$this->Acl->allow($leastRole,$controller.'/'.$action);
			}
		}
		$this->autoRender = false;
	}
	
	function isAuthorized() {
		if (Configure::read('Auth.disabled')) {
			return true;
		}
		return false;
	}

}
?>
