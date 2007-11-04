<div class="scormAttendeeTracking">
<?php echo $form->create('ScormAttendeeTracking');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Edit %s', true), __('ScormAttendeeTracking', true));?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('scorm_id');
		echo $form->input('sco_id');
		echo $form->input('student_id');
		echo $form->input('datamodel_element');
		echo $form->input('value');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('ScormAttendeeTracking.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('ScormAttendeeTracking.id'))); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('ScormAttendeeTrackings', true)), array('action'=>'index'));?></li>
	</ul>
</div>
