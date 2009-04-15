<?php echo $form->create('Member',array('action' => 'recover'));?>
	<fieldset>
		<p>
			<?php
				__('To complete your password recovery, please answer your security question.');
			?>
		</p>
 		<legend><?php __('Answer your security question');?></legend>
		<div class="input">
			<strong class="label"><?php __('Question'); ?></strong>
			<?php echo $question; ?>
		</div>
	<?php
		echo $form->input('answer', array('size' => 50));
		echo $form->input('field', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $form->end(__('Recover',true));?>
