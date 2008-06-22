<div id="locker-contents">
<?php
	if (
		isset($parentFolder['SubFolder']) && count($parentFolder['SubFolder'])>0 ||
		isset($parentFolder['Document']) && count($parentFolder['Document'])>0
	) :
?>
	<ul>
	<?php
		foreach ($parentFolder['SubFolder'] as $i => $folder) :
			echo $this->element('file_info', array('file' => $folder, 'type' => 'folder'));
		endforeach;
		foreach ($parentFolder['Document'] as $i => $document) :
			echo $this->element('file_info', array('file' => $document, 'type' => 'document'));
		endforeach;
	?>
	</ul>
<?php
	else:
?>
	<p class="empty">&mdash; <?php __('This folder is empty'); ?> &mdash;</p>
<?php
	endif;
?>
</div>