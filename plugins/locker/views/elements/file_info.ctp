<li>
	<?php
		if ($type == 'folder') {
			echo $html->link(
				$file['name'],
				array(
					'controller'	=> 'folders',
					'action'		=> 'view',
					$file['id']
				), array('class' => 'item folder')
			);
		}
		if ($type == 'document') {
			$file_type = Inflector::slug($file['type']);
			if ($file_type=='text_plain' || $file_type=='application_octet_stream') {
				$file_type = array_pop(explode('.', $file['file_name']));
			}
			echo $html->link(
				wordwrap($text->truncate($file['file_name'], 20), 10, '<br />', 1),
				array(
					'controller'	=> 'documents',
					'action'		=> 'view',
					$file['id']
				), array('class' => 'item ' . $file_type, 'rel' => '#hola'), false, false
			);
		}
	?>
</li>
