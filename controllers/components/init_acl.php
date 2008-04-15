<?php
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
		App::import('Model','Member');
		App::import('Model','Role');
		$this->Member = $controller->Member;
		$this->Role = $controller->Role;
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
		$this->Member->save($data);
		return $this->Member->getLastInsertId();
	}
	
	
	 
}
