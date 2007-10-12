<div class="sco">
<?php echo $form->create('Sco');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Sco');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('scorm_id');
		echo $form->input('parent_id');
		echo $form->input('manifest');
		echo $form->input('organization');
		echo $form->input('identifier');
		echo $form->input('href');
		echo $form->input('title');
		echo $form->input('completionThreshold');
		echo $form->input('parameters');
		echo $form->input('isvisible');
		echo $form->input('attemptAbsoluteDurationLimit');
		echo $form->input('dataFromLMS');
		echo $form->input('attemptLimit');
		echo $form->input('scormType');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Sco.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('Sco.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Scos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Objectives', true), array('controller'=> 'objectives', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Objective', true), array('controller'=> 'objectives', 'action'=>'add')); ?> </li>
	</ul>
</div>