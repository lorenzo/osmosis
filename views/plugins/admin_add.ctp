<div class="plugins form">
<?php echo $form->create('Plugin');?>
	<fieldset>
 		<legend><?php __('Add Plugin');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('active');
		echo $form->input('folder');
		echo $form->input('Course');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Plugins', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Courses', true), array('controller'=> 'courses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Course', true), array('controller'=> 'courses', 'action'=>'add')); ?> </li>
	</ul>
</div>
