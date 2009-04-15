<h1><?php __('Bingo!')?></h1>
<p>
	<?php
		__('Your answer was correct, now you can change your password.');
	?>
</p>
<?php echo $form->create('Member',array('action' => 'recover'));?>
	<fieldset>
 		<legend><?php __('Select your new password');?></legend>
	<?php
		echo $form->input('password', array('label' => array('class' => 'wide')));
		echo $form->input('password_confirm', array('label' => array('class' => 'wide'), 'type' => 'password'));
		echo $form->input('answer', array('type' => 'hidden'));
		echo $form->input('field', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $form->end(__('Recover',true));?>
