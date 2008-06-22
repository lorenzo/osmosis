<?php
$document = $lockerDocument['LockerDocument'];
echo $this->element('folder_path', compact('path', 'member', 'document'));
?>
<div class="<?php echo $mime->convert($document['type'], $document['name']); ?>">
	<h2>
	<?php
		$name = $document['name'];
		echo $name;
	?>
	</h2>
	<div id="document-description">
		<?php
			$description = $document['description'];
			if (empty($description)) {
				__('This file has no description');
			} else {
				echo $description;
			}
		?>
		<ul class="actions">
			<li class="edit">
			<?php
				echo $html->link(
					__('Edit', true),
					array(
						'controller'	=> 'documents',
						'action'		=> 'edit',
						$document['id']
					)
				);
			?>
			</li>
			<li class="delete">
			<?php
				echo $html->link(
					__('Delete', true),
					array(
						'controller'	=> 'documents',
						'action'		=> 'delete',
						$document['id']
					), null,
					sprintf(__('Please confirm the deletion of %s', true), $document['name'])
				);
			?>
			</li>
			<li class="download">
			<?php
				echo $html->link(
					__('Download', true),
					array(
						'controller'	=> 'documents',
						'action'		=> 'download',
						$document['id']
					)
				);
			?>
			</li>
		</ul>
	</div>
</div>