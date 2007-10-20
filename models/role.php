<?php
class Role extends AppModel {

	var $name = 'Role';
	var $validate = null;/*array(
		'parent_id' => VALID_NOT_EMPTY,
		'role' => VALID_NOT_EMPTY,
	);*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Parent' => array('className' => 'Role',
								'foreignKey' => 'parent_id'
								),
	);

	var $hasMany = array(
			'Member' => array('className' => 'Member',
								'foreignKey' => 'role_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'dependent' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);
	
    var $actsAs = array('Acl');

    function parentNode(){
        if (!$this->id) {
            return null;
        }
        $data = $this->read();
        if (!$data[$this->name]['parent_id']){
            return null;
        } else {
            return $data[$this->name]['parent_id'];
        }
    }

}
?>
