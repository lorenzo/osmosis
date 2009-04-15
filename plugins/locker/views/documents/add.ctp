<div class="lockerDocuments form">
<?php echo $form->create('LockerDocument',array('type' => 'file', 'url' => array('controller' => 'documents')));?>
	<fieldset>
 		<legend><?php __d('locker','Add File');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('file', array('type' => 'file'), array('label' => __d('locker','File', true)));
		echo $form->input('description', array('label' =>__d('locker','Description', true)));
		echo $form->input('folder_id', array('label' =>__d('locker','Folder', true)));
	?>
	</fieldset>
<?php echo $form->end(__d('locker','Save', true));?>
</div>