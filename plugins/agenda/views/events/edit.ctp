<div class="events form">
<?php echo $form->create('Event', array('url' => array('course_id' => $course_id)));?>
	<fieldset>
 		<legend><?php __('Edit Event');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('date');
		echo $form->input('location');
		echo $form->input('all_day');
		echo $form->input('headline');
		echo $form->input('detail');
	?>
	</fieldset>
<?php echo $form->end(__('Save',true));?>
</div>