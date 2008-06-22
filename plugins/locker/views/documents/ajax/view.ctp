<div id="document-description"><?php
		$description = $lockerDocument['LockerDocument']['description'];
		if (empty($description)) {
			__('This file has no description');
		} else {
			echo $description;
		}
	?>
</div>
<div class="actions">
	<?php
		echo $html->link(
			__('Delete', true),
			array(
				'controller'	=> 'documents',
				'action'		=> 'delete',
				$lockerDocument['LockerDocument']['id']
			), array('class' => 'delete'),
			sprintf(__('Please confirm the deletion of %s', true), $lockerDocument['LockerDocument']['name'])
		);
		echo $html->link(
			__('Download', true),
			array(
				'controller'	=> 'documents',
				'action'		=> 'download',
				$lockerDocument['LockerDocument']['id']
			), array('class' => 'download')
		);
	?>
</div>