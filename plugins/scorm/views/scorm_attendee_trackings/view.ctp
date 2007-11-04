<div class="scormAttendeeTracking">
<h2><?php  __('ScormAttendeeTracking');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Scorm Id') ?></dt>
		<dd>
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['scorm_id'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Sco Id') ?></dt>
		<dd class="altrow">
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['sco_id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Student Id') ?></dt>
		<dd>
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['student_id'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Datamodel Element') ?></dt>
		<dd class="altrow">
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['datamodel_element'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Value') ?></dt>
		<dd>
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['value'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('ScormAttendeeTracking', true)), array('action'=>'edit', $scormAttendeeTracking['ScormAttendeeTracking']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('ScormAttendeeTracking', true)), array('action'=>'delete', $scormAttendeeTracking['ScormAttendeeTracking']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $scormAttendeeTracking['ScormAttendeeTracking']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('ScormAttendeeTrackings', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('ScormAttendeeTracking', true)), array('action'=>'add')); ?> </li>
	</ul>
</div>
