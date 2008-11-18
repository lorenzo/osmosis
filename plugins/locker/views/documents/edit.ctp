<div class="lockerDocuments form">
<?php echo $form->create('LockerDocument',array('url' => array('controller' => 'documents')));?>
	<fieldset>
 		<legend><?php __d('locker','Edit Document Info');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end(__d('locker','Save', true));?>
</div>
