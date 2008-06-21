<div class="wikis form">
<?php echo $form->create('Wiki');?>
	<fieldset>
 		<legend><?php __('Edit Wiki');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('course_id');
		echo $form->input('name');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Wiki.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Wiki.id'))); ?></li>
		<li><?php echo $html->link(__('List Wikis', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Courses', true), array('controller'=> 'courses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Course', true), array('controller'=> 'courses', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Entries', true), array('controller'=> 'entries', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Entry', true), array('controller'=> 'entries', 'action'=>'add')); ?> </li>
	</ul>
</div>
