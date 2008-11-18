<div class="events form">
<?php echo $form->create('Event', array('url' => array('course_id' => $course_id)));?>
	<fieldset>
 		<legend><?php __d('agenda','Add Event');?></legend>
	<?php
		echo $form->input('date',array('type' => 'date'));
		echo $form->input('location');
		echo $form->input('all_day');
		echo $form->input('headline');
		echo $form->input('detail');
		echo $form->input('course_id',array('type' => 'hidden', 'value' => $course_id));
	?>
	</fieldset>
<?php echo $form->end(__d('agenda','Add Event',true));?>
</div>
