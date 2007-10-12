<div class="scorm">
<?php echo $form->create('Scorm');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Scorm');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('course_id');
		echo $form->input('name');
		echo $form->input('file_name');
		echo $form->input('description');
		echo $form->input('version');
		echo $form->input('hash');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Scorm.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('Scorm.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Scorms', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Scos', true), array('controller'=> 'scos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Sco', true), array('controller'=> 'scos', 'action'=>'add')); ?> </li>
	</ul>
</div>