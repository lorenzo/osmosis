<div class="courses form">
<?php echo $form->create('Course');?>
	<fieldset>
 		<legend><?php __('Add Course');?></legend>
	<?php
		echo $form->input('department_id');
		echo $form->input('owner_id', array('multiple' => 'multiple'));
		echo $form->input('code');
		echo $form->input('name');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Courses', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Departments', true), array('controller'=> 'departments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Department', true), array('controller'=> 'departments', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Owner', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
	</ul>
</div>
