<div class="lockerFolders form">
<?php echo $form->create('LockerFolder',array('url' => array('controller' => 'folders')));?>
	<fieldset>
 		<legend><?php __('Add Folder');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('parent_id',array('empty' => true));
	?>
	</fieldset>
<?php echo $form->end('Save');?>
</div>
