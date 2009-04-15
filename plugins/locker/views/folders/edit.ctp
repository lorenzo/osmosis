<div class="lockerFolders form">
<?php echo $form->create('LockerFolder',array('url' => array('controller' => 'folders')));?>
	<fieldset>
 		<legend><?php __d('locker','Change Folder Name');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end(__d('locker','Save', true));?>
</div>