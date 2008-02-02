<div class="documents form">
<?php echo $form->create('Document');?>
	<fieldset>
 		<legend><?php __('Edit Document');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('description');
		echo $form->input('locker_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Document.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Document.id'))); ?></li>
		<li><?php echo $html->link(__('List Documents', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Lockers', true), array('controller'=> 'lockers', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Locker', true), array('controller'=> 'lockers', 'action'=>'add')); ?> </li>
	</ul>
</div>
