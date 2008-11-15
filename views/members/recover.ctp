<div id="login">
	<?php echo $form->create('Member',array('action'=>'recover'));?>
		<fieldset>
	 		<legend><?php __('Recover Password');?></legend>
		<?php
			echo $form->input('field', array('label' => __('Username or Email', true)));
		?>
		</fieldset>
	<?php echo $form->end(__('Recover',true));?>
</div>