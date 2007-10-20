<?php
class Member extends AppModel {

	var $name = 'Member';
	var $validate = null; /* array(
		'email' => array(
		    'valid' => array(
		        'rule' => 'email',
		        'message' => 'member.email.invalid'
		        )
		),
		'country' => VALID_NOT_EMPTY,
		'city' => VALID_NOT_EMPTY,
		'age' => VALID_NOT_EMPTY,array(
		    'number' => array(
		        'rule' => 'numeric',
		        'message' => 'member.age.invalid'
		        )
		),
		'sex' => VALID_NOT_EMPTY,
		'role_id' => VALID_NOT_EMPTY,
		'username' => VALID_NOT_EMPTY,
		'password' => VALID_NOT_EMPTY,
	);*/
	
	var $belongsTo = array(
			'Role' => array('className' => 'Role',
								'foreignKey' => 'role_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);
	
    var $actsAs = array('Acl');

    function parentNode(){
        if (!$this->id) {
            return null;
        }
        $data = $this->read();
        if (!$data[$this->name][$this->Role->foreignKey]){
            return null;
        } else {
            return array('model' => 'Role', 'foreign_key' => $data[$this->Name][$this->Role->foreignKey]);
        }
    }

}
?>
