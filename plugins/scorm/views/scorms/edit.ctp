<div class="scorm">
<?php echo $form->create('Scorm');?>
	<fieldset>
 		<legend><?php __('Edit');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>