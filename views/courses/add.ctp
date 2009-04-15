<div class="course">
<?php echo $form->create('Course');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('Course', true));?></legend>
	<?php
		echo $form->input('department_id', array('label'=>__('Department', true)));
		echo $form->input('name', array('label'=> __('Name', true)));
		echo $form->input('code', array('label'=>__('Code', true)));
		echo $form->input('description', array('label'=>__('Description',true)));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
