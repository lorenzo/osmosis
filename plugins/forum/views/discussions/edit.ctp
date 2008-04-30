<div class="discussions form">
<?php echo $form->create('Discussion');?>
	<fieldset>
 		<legend><?php __('Edit Discussion');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('content');
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>