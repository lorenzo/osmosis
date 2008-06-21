<div class="departments form">
<?php echo $form->create('Department');?>
	<fieldset>
 		<legend><?php __('Add Department');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Departments', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Courses', true), array('controller'=> 'courses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Course', true), array('controller'=> 'courses', 'action'=>'add')); ?> </li>
	</ul>
</div>
