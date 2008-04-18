<div id="login">
	<?php echo $form->create('Member',array('action'=>'login'));?>
		<fieldset>
	 		<legend><?php __('member.login.legend');?></legend>
		<?php
			echo $form->input('username');
			echo $form->input('password');
		?>
		</fieldset>
	<?php echo $form->end(__('member.login.submit',true));?>
</div>