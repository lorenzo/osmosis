<?php
class InitAclController extends AppController {
	var $name = 'InitAcl';
	var $components = array('Acl','Auth');
	var $uses = array('Member','Role');
	
	function createAro($model, $foreign, $parent, $alias) {
		$this->Acl->Aro->create();
		$this->Acl->Aro->save(array(
      		       'model'=>$model,
      		       'foreign_key'=>$foreign,
      		       'parent_id'=>$parent,
      		       'alias'=>$alias)
                );
		return $this->Acl->Aro->id;
	}

	function createAco($model, $foreign, $parent, $alias) {
		$this->Acl->Aco->create();
		$this->Acl->Aco->save(array(
      		       'model'=>$model,
      		       'foreign_key'=>$foreign,
      		       'parent_id'=>$parent,
      		       'alias'=>$alias)
                );
		return $this->Acl->Aco->id;
	}
  
	function deleteDB() {
		$this->Member->query("TRUNCATE acos");
		$this->Member->query("TRUNCATE aros");
		$this->Member->query("TRUNCATE aros_acos");
		$this->Member->query("TRUNCATE members");
		$this->Member->query("TRUNCATE roles");
	}
	
	function initRole($role_name,$parent_id=null) {
		$this->Role->create();
		$this->Role->save(array('Role'=>array('role'=>$role_name,'parent_id'=>$parent_id)));
		return $this->Role->getLastInsertId();
	}
	
	function initMember($data) {
		$this->Member->create();
		$data = $this->Auth->hashPasswords($data);
		$this->Member->save($data);
		return $this->Member->getLastInsertId();
	}
	
	function init() {
		$this->deleteDB();
		
		// AROS
		$root_id = $this->createAro(null,null, null,'ROOT');
		$role_id = $this->initRole('Admin');
		$this->Acl->Aro->id = $this->Acl->Aro->field('id',array('foreign_key'=>$role_id));
		$this->Acl->Aro->save(array('parent_id'=>$root_id,'alias'=>'Admin'));
		$aro_id = $this->Acl->Aro->id;
		$member = array('Member' => 
			array(
			'institution_id' => '00-00000',
    		'full_name'		=> 'Administrator',
    		'email'			=> 'admin@root.com',
    		'phone'			=> '000000000',
    		'country'		=> 'Venezuela',
    		'city'			=> 'Caracas',
    		'sex'			=> 'M',
    		'role_id'		=> $role_id,
    		'username'		=> 'admin',
    		'password'		=> 'admin'
    		)
		);
		$member_id = $this->initMember($member);
		
		//ACOS
		$id = $this->createAco(null, null, null, "ROOT");
		$id = $this->createAco(null, null, $id, "Controllers/");
		$this->Acl->allow('Admin','ROOT', 'Controllers/');
		
		$this->autoRender = false;
	}
}
?>
