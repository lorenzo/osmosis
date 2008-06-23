<li>
	<?php
		if ($type == 'folder') {
			$url = array(
				'plugin'		=> 'locker',
				'controller'	=> 'folders',
				'action'		=> 'view',
				$file['id']
			);
			$class = 'item folder';
			if ($file['name'] == 'dropbox' && $parentFolder['parent_id'] == null) {
				$file['name'] = __('Dropbox', true);
				$class .= ' dropbox';
			}
			list($rev, $rel, $title) = array($file['id'], $html->url($url), $file['name']);
			$rel .= '?q=ajax';
			echo $html->link($file['name'], $url, compact('class', 'rev', 'rel', 'title'));
		}
		if ($type == 'document') {
			$file_type = $mime->convert($file['type'], $file['file_name']);
			$url = array(
				'plugin'		=> 'locker',
				'controller'	=> 'documents',
				'action'		=> 'view',
				$file['id']
			);
			$title = $name = $file['name'];
			if ($wrap_names) {
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
			}
			list($class, $rev, $rel) = array('item document ' . $file_type, $file['id'], $html->url($url));
			$rel .= '?q=ajax';
			echo $html->link($name, $url, compact('class', 'rev', 'rel', 'title'), false, false);
		}
	?>
</li>