<div class="lockerDocuments form">
<?php echo $form->create('LockerDocument',array('url' => array('controller' => 'documents')));?>
	<fieldset>
 		<legend><?php __('Edit Document Info');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('folder_id');
	?>
	</fieldset>
<?php echo $form->end(__('Save', true));?>
</div>
