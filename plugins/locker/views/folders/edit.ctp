<div class="lockerFolders form">
<?php echo $form->create('LockerFolder',array('url' => array('controller' => 'folders')));?>
	<fieldset>
 		<legend><?php __('Change Folder Name');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end(__('Save', true));?>
</div>