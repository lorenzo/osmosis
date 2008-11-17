<?php
	echo $this->element('email/html/styles_simple_email');
?>
<h1><?php __('Your password was successfully reset'); ?></h1>
<p>
	<?php 
		echo String::insert(
			__('Hi <strong>:name</strong>,', true),
			array('name' => $name)
		); ?>
</p>
<p>
	<?php __('We are sending you his email to confirm that your password was successfully reset.'); ?><br />
	<?php 
		echo String::insert(
			__('It\'s a pleasure to welcome you back to :site!', true),
			array('site' => $site)
		);
	?>
</p>
<p class="warning">
	<strong><?php __('Note:'); ?></strong>
	<?php __('If you didn\'t do any password recovery, this could mean that somebody guessed your security question.'); ?><br /><br />
	<?php
	
		echo String::insert(
			__('You should head to :recover_url and change it again.', true),
			array('recover_url' => $html->url(array('controller' => 'members', 'action' => 'recover', 'full_base' => true)))
		);
	?><br /><br />
	<strong>
	<?php
		__('And remember to change your security question!');
	?>
	</strong>
</p>