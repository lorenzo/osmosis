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
/**
 * Component that provides functions to initialize Access control lists
 */
class InitAclComponent extends Object {
	var $components = array('Acl','Auth');
	
	/**
	 * Initializes the component
	 */
	function startup(&$controller) {
		$this->controller = $controller;
		$this->Member = ClassRegistry::init('Member');
		$this->Role = ClassRegistry::init('Role');
		return true;
	}
	
	function createAro($model, $foreign, $parent, $alias) {
		$this->Acl->Aro->create();
		$this->Acl->Aro->save(array(
      		       'model'=>$model,
      		       'foreign_key'=>$foreign,
      		       'parent_id'=>$parent,
      		       'alias'=>$alias)
                );
		return $this->Acl->Aro->getLastInsertId();
	}

	function createAco($model, $foreign, $parent, $alias) {
		$this->Acl->Aco->create();
		$this->Acl->Aco->save(array(
      		       'model'=>$model,
      		       'foreign_key'=>$foreign,
      		       'parent_id'=>$parent,
      		       'alias'=>$alias)
                );
		return $this->Acl->Aco->getLastInsertId();
	}
  
	function deleteDB() {
		$this->Acl->Aco->query('TRUNCATE '.$this->Acl->Aco->table);
		$this->Acl->Aro->query('TRUNCATE '.$this->Acl->Aro->table);
		$this->Acl->Aro->query('TRUNCATE '.$this->Acl->Aco->hasAndBelongsToMany['Aro']['joinTable']);
		$this->Member->query('TRUNCATE '.$this->Member->table);
		$this->Role->query('TRUNCATE '.$this->Role->table);
	}
	
	function initRole($role_name, $parent_id = null) {
		$this->Role->create();
		$this->Role->save(array('Role'=>array('role'=>$role_name,'parent_id'=>$parent_id)));
		$this->Acl->Aro->id = $this->Acl->Aro->field('id',array('foreign_key'=>$this->Role->getLastInsertId()));
		$this->Acl->Aro->save(array('alias'=>$role_name));
		return $this->Role->getLastInsertId();
	}
	
	function initMember($data) {
		$this->Member->create();
		$this->Auth->userModel = 'Member';
		$data = $this->Auth->hashPasswords($data);
		$this->Member->save($data,false);
		return $this->Member->getLastInsertId();
	}
	
	function loadPermissions($plugin = null) {
		if (!$plugin && isset($this->controller->plugin) && !empty($this->controller->plugin))
			$plugin = $this->controller->plugin;
		
		$permissions = $path = false;
		
		if ($plugin) {
			$plugin = Inflector::camelize($plugin);
			$instance = ClassRegistry::init('Plugin');
			$path = $instance->getPath($plugin);
			if (!$path)
				return false;
			
			App::import('File','permissions',array('search' => $path.DS.'config'));
			$class = $plugin.'Permissions';
			$permissions = new $class;
			$parentAco = $this->Acl->Aco->field('id',array('alias' => 'Controllers'));
			$parentAco = $this->createAco(null, null, $parentAco, $plugin);
			
			if (!$parentAco)
				return false;
		}

		if (!$path && empty($plugin)) {
			App::import('File','permissions',true,CONFIGS);
			$permissions = new OsmosisPermissions;
			$parentAco = $this->createAco(null, null, null, "ROOT");
			$parentAco = $this->createAco(null, null, $parentAco, "Controllers");
			$parentAco = $this->createAco(null, null, $parentAco, "App");
		}
		
		foreach ($permissions as $controller => $actions) {
			if ($controller{0} == '_') continue;
			
			$_id = $this->createAco(null, null, $parentAco, $controller);
			foreach ($actions as $action => $leastRole) {
				$this->createAco(null, null, $_id, $action);
				$this->Acl->Aro->Permission->create();
				$this->Acl->allow($leastRole,$controller.'/'.$action);
			}
		}
		
		return true;
	}
	
	
	 
}
