<?php
	echo $this->element('email/html/styles_simple_email');
?>
<h1>
	<?php
		echo String::insert(
			__('Welcome to :site!', true),
			array('site' => $site)
		);
	?>
</h1>
<p>
	<?php 
		echo String::insert(
			__('Hi :name,', true),
			array('name' => $name)
		); ?>
<br />
	<?php 
		echo String::insert(
			__('You have been registered into :site!', true),
			array('site' => $site)
		);
	?>
</p>
<p class="info">
	<?php 
		echo String::insert(
			__('To log into access the site please use this username: <strong>:username</strong> :password_same'),
			array(
				'username' => $username,
				'password_same' => $password_same ? 
							__('(Your password is the same as your username, remember to change it soon)', true) :
							__('and the password you selected', true)
			)
		);
	?>
</p>