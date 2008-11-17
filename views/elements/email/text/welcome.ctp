<?php
	echo String::insert(
		__('Welcome to :site!', true),
		array('site' => $site)
	);
?>


<?php 
	echo String::insert(
		__('Hi :name,', true),
		array('name' => $name)
	);
?>

<?php 
	echo String::insert(
		__('You have been registered into :site!', true),
		array('site' => $site)
	);
?>


<?php 
	echo String::insert(
		__('To log into access the site please use this username: :username :password_same'),
		array(
			'username' => $username,
			'password_same' => $password_same ? 
						__('(Your password is the same as your username, remember to change it soon)', true) :
						__('and the password you selected', true)
		)
	);
?>
