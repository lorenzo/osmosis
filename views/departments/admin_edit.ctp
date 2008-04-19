<div class="departments form">
<?php echo $form->create('Department');?>
	<fieldset>
 		<legend><?php __('Edit Department');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Department.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Department.id'))); ?></li>
		<li><?php echo $html->link(__('List Departments', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Courses', true), array('controller'=> 'courses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Course', true), array('controller'=> 'courses', 'action'=>'add')); ?> </li>
	</ul>
</div>
