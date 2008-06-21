<div class="lockerDocuments form">
<?php echo $form->create('LockerDocument',array('type' => 'file', 'url' => array('controller' => 'documents')));?>
	<fieldset>
 		<legend><?php __('Add File');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('file', array('type' => 'file'));
		echo $form->input('description', array('label' =>__('Description', true)));
		echo $form->input('folder_id', array('label' =>__('Folder', true)));
	?>
	</fieldset>
<?php echo $form->end('Save');?>
</div>