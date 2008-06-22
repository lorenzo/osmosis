<li>
	<?php
		if ($type == 'folder') {
			$url = array(
				'controller'	=> 'folders',
				'action'		=> 'view',
				$file['id']
			);
			echo $html->link(
				$file['name'], $url,
				array(
					'class'	=> 'item folder',
					'rev'	=> $file['id'],
					'rel'	=> $html->url($url),
					'title'	=> $file['name']
				)
			);
		}
		if ($type == 'document') {
			$file_type = $mime->convert($file['type'], $file['file_name']);
			$url = array(
				'controller'	=> 'documents',
				'action'		=> 'view',
				$file['id']
			);
			$title = $name = $file['name'];
			$ext = '';
			$name = explode('.', $name);
			$plus = 0;
			if (count($name)==1) {
				$plus = 4;
				$name = $title;
			} else {
				$ext = '.' . array_pop($name);
				$name = implode('.', $name);
			}
			$name = str_replace(' ', '^', $name);
			$name = wordwrap($text->truncate($name, 16 + $plus, '[...]'), 10, '<br />', true);
			$name = str_replace('^', ' ', $name) . $ext;
			echo $html->link($name, $url,
				array(
					'class'	=> 'item document ' . $file_type,
					'rev'	=> $file['id'],
					'rel'	=> $html->url($url),
					'title'	=> $title
				), false, false
			);
		}
	?>
</li>