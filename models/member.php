<?php
class Member extends AppModel {
	var $name = 'Member';
	var $displayField = 'full_name';

	var $validate = array(
			'name' => array(
			    'valid' => array(
			        'rule' => '/.+/',
			        )
			),
			'email' => array(
			    'valid' => array(
			        'rule' => 'email',
			        )
			),
			'country' => array(
			    'valid' => array(
			        'rule' => '/.+/',
			        )
			),
			'city' => array(
			    'valid' => array(
			        'rule' => '/.+/',
			        )
			),
			'age' => array(
			    'number' => array(
			        'rule' => 'numeric',
			        )
			),
			'sex' =>  array(
			    'valid' => array(
			        'rule' => '/.+/',
			        )
			),
			'role_id' => array(
			    'valid' => array(
			        'rule' => '/.+/',
			        )
			),
			'username' =>  array(
			    'valid' => array(
			        'rule' => '/.+/',
			        )
			),
			'password' =>  array(
			    'valid' => array(
			        'rule' => '/.+/',
			        )
			),
		);
		
	var $belongsTo = array(
			'Role' => array('className' => 'Role',
								'foreignKey' => 'role_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);
	
    var $actsAs = array('Acl');
    
    function __construct($id = false, $table = null, $ds = null) {
    	$this->validate['email']['valid']['message'] = __('The email address provided is not correct',true);
    	$this->validate['country']['valid']['message'] = __('The country name can not be empty',true);
    	$this->validate['city']['valid']['message'] = __('The city name can not be empty',true);
    	$this->validate['age']['number']['message'] = __('The age must be a number',true);
    	$this->validate['sex']['valid']['message'] = __('The sex can not be empty',true);
    	$this->validate['rol_id']['valid']['message'] = __('The rol_id can not be empty',true);
    	$this->validate['username']['valid']['message'] = __('The username can not be empty',true);
    	$this->validate['password']['valid']['message'] = __('The password can not be empty',true);
    	$this->validate['name']['valid']['message'] = __('The name can not be empty',true);	
		parent::__construct($id,$table,$ds);
    }
    

    function parentNode(){
        if (!$this->id) {
            return null;
        }
        $data = $this->read();
        if (!$data[$this->name]['role_id']){
            return null;
        } else {
            return array('model' => 'Role', 'foreign_key' => $data[$this->name]['role_id']);
        }
    }

}
?>
