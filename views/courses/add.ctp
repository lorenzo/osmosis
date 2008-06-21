<div class="course">
<?php echo $form->create('Course');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('Course', true));?></legend>
	<?php
		echo $form->input('department_id');
		echo $form->input('name');
		echo $form->input('code',array('label'=>'Short Name'));
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
