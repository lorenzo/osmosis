<h2>
	<?php
		echo $html->link(
			__('View this Folder\'s Content', true),
			array(
				'controller'	=> 'folders',
				'action'		=> 'view',
				$parentFolder['LockerFolder']['id']
			)
		);
	?>
</h2>
<?php
	$wrap_names = false;
	echo $this->element('folder_contents', compact('parentFolder', 'wrap_names'));
?>