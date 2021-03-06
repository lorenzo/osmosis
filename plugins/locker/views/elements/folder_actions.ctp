<div id="locker-actions">
	<?php
		$folder_id = $parentFolder['LockerFolder']['id'];
		$owner = $parentFolder['LockerFolder']['member_id'];
		if ($Osmosis['active_member']['id']==$owner) :
	?>
		<div class="create-folder action">
			<?php
				echo $form->create('LockerFolder',array('url' => array('controller' => 'folders')));
				echo $form->input('name', array('div' => false, 'label' => __d('locker','Add Folder:', true)));
				echo $form->input('parent_id',array('type' => 'hidden', 'value' => $folder_id));
				echo $form->end(__d('locker','Create Folder', true));
			?>
		</div>
		<div class="upload-file action">
			<?php
				echo $form->create('LockerDocument',array('type' => 'file', 'url' => array('controller' => 'documents')));
				echo $form->input('file',array('type' => 'file', 'label' => __d('locker','Upload File:', true)));
				echo $form->input('folder_id', array('type' => 'hidden', 'value' => $folder_id));
				echo $form->end(__d('locker','Upload File', true));
			?>
		</div>
	<?php
		else :
	?>
		<div class="drop-file action">
			<?php
				echo $form->create(
					'LockerDocument',
					array('type' => 'file', 'url' => array('controller' => 'documents', 'action' => 'drop'))
				);
				echo $form->input('file',array('type' => 'file', 'label' => __d('locker','Leave a File to this user:', true)));
				echo $form->input('folder_id', array('type' => 'hidden', 'value' => $folder_id));
				echo $form->end(__d('locker','Upload File', true));
			?>
		</div>
	<?php
		endif;
	?>
</div>