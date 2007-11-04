<div class="scormAttendeeTrackings">
<h2><?php __('ScormAttendeeTrackings');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('scorm_id');?></th>
	<th><?php echo $paginator->sort('sco_id');?></th>
	<th><?php echo $paginator->sort('student_id');?></th>
	<th><?php echo $paginator->sort('datamodel_element');?></th>
	<th><?php echo $paginator->sort('value');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($scormAttendeeTrackings as $scormAttendeeTracking):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['id'] ?>
		</td>
		<td>
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['scorm_id'] ?>
		</td>
		<td>
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['sco_id'] ?>
		</td>
		<td>
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['student_id'] ?>
		</td>
		<td>
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['datamodel_element'] ?>
		</td>
		<td>
			<?php echo $scormAttendeeTracking['ScormAttendeeTracking']['value'] ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $scormAttendeeTracking['ScormAttendeeTracking']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $scormAttendeeTracking['ScormAttendeeTracking']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $scormAttendeeTracking['ScormAttendeeTracking']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $scormAttendeeTracking['ScormAttendeeTracking']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('ScormAttendeeTracking', true)), array('action'=>'add')); ?></li>
	</ul>
</div>
