<div class="wikis form">
<?php echo $form->create('Wiki');?>
	<fieldset>
 		<legend><?php __d('wiki','Add Wiki');?></legend>
	<?php
		echo $form->input('course_id');
		echo $form->input('name', array('label' => __d('wiki','Title', true), 'size' => 60));
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end(__d('wiki','Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__d('wiki','List Wikis', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__d('wiki','List Courses', true), array('controller'=> 'courses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('wiki','New Course', true), array('controller'=> 'courses', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__d('wiki','List Entries', true), array('controller'=> 'entries', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('wiki','New Entry', true), array('controller'=> 'entries', 'action'=>'add')); ?> </li>
	</ul>
</div>
