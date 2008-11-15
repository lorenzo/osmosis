<style type="text/css" media="screen">
	.note {border:#ccc 1px dashed;background:#f5f5f5;}
</style>
<h1><?php __('Your password was successfully reset'); ?></h1>
<p>
	<?php 
		echo String::insert(
			__('Hi :name,', true),
			array('name' => $name)
		); ?>
</p>
<p class="note">
	<?php __('We are sending you his email to confirm that your password was successfully reset.'); ?><br />
	<?php 
		echo String::insert(
			__('It\'s a pleasure to welcome you back to :site!'),
			array('site' => $site)
		);
	?>
</p>
<p>
	<?php
		echo String::insert(
			__('If you didn\'t ask to recover your password. You should head to :recover_url and change it again.', true),
			array('recover_url' => $html->url(array('controller' => 'members', 'action' => 'recover', 'full_base' => true)))
		);
	?>
</p>