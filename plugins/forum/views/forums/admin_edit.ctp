<div class="forums form">
<?php echo $form->create('Forum');?>
	<fieldset>
 		<legend><?php __('Edit Forum');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('course_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Forum.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Forum.id'))); ?></li>
		<li><?php echo $html->link(__('List Forums', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Courses', true), array('controller'=> 'courses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Course', true), array('controller'=> 'courses', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Topics', true), array('controller'=> 'topics', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Topic', true), array('controller'=> 'topics', 'action'=>'add')); ?> </li>
	</ul>
</div>
