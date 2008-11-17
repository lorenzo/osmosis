<style type="text/css" media="screen">
	.note {border:#ccc 1px dashed;background:#f5f5f5;padding:10px;}
</style>
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
</p>
<p class="note">
	<?php 
		echo String::insert(
			__('You have been registered into :site!'),
			array('site' => $site)
		);
	?>
	<br />
	<?php 
		echo String::insert(
			__('To access the site please use this username: <strong>:username</strong>:password_same'),
			array(
				'username' => $username,
				'password_same' => $password_same ? 
							__('(Your password is the same as your username, remember to change it soon)', true) :
							''
			)
		);
	?>
</p>