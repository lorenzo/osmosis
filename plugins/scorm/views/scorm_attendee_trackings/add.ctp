<div class="scormAttendeeTracking">
<?php echo $form->create('ScormAttendeeTracking');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('ScormAttendeeTracking', true));?></legend>
	<?php
		echo $form->input('scorm_id');
		echo $form->input('sco_id');
		echo $form->input('student_id');
		echo $form->input('datamodel_element');
		echo $form->input('value');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('ScormAttendeeTrackings', true)), array('action'=>'index'));?></li>
	</ul>
</div>
