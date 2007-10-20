<?php
class MemberFixture extends CakeTestFixture {
    var $name = 'Member';
    var $import = array('model'=>'Member');
    var $records = array(
    	array(
    		'id' 	=> 1,
    		'institution_id' => '02-35389',
    		'full_name'		=> 'Jose Rodriguez',
    		'email'			=> 'jose.zap@hotmail.com',
    		'phone'			=> '9614041',
    		'country'		=> 'Venezuela',
    		'city'			=> 'Caracas',
    		'sex'			=> 'M',
    		'role_id'		=> 1,
    		'username'		=> 'lorenzo',
    		'password'		=> 'DSASAASXZXXV2131DSAs321D'
		),
		array(
    		'id' 	=> 2,
    		'institution_id' => '02-32421',
    		'full_name'		=> 'Wanna Gaby',
    		'email'			=> 'jose.zip@hotmail.com',
    		'phone'			=> '9614041',
    		'country'		=> 'Venezuela',
    		'city'			=> 'Caracas',
    		'sex'			=> 'M',
    		'role_id'		=> 1,
    		'username'		=> 'lorenzo',
    		'password'		=> 'DSASAASXZXXV2131DSAs321D'
		),
    );
} 
?>