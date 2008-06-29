<?php $html->css('diff',null,null,false) ?>
<div class="revisions diff">
	<h2>
		<?php
			echo $entry['Entry']['title'];
		?><span class="note"><?php
			if ($rev1==null) {
				$link1 = $html->link(
					__('keep this revision', true),
					array(
						'controller'	=> 'entries',
						'action'		=> 'view',
						$entry['Entry']['slug'],
						'wiki_id'		=> $this->params['named']['wiki_id']
					)
				);
				$link2 = $html->link(
					__('return to this revision', true),
					array(
						'controller'	=> 'entries',
						'action'		=> 'restore',
						$entry['Entry']['id'],
						$rev2,
						'wiki_id'		=> $this->params['named']['wiki_id']
					)
				);
				$rev1 = __('Current Version', true);
				$rev2 = __('Revision', true) . $rev2;
				__('Differences between current revision and previous');
			} else {
				$link1 = $html->link(
					__('return to this revision', true),
					array(
						'controller'	=> 'entries',
						'action'		=> 'restore',
						$entry['Entry']['id'],
						$rev1,
						'wiki_id'		=> $this->params['named']['wiki_id']
					)
				);
				$link2 = $html->link(
					__('return to this revision', true),
					array(
						'controller'	=> 'entries',
						'action'		=> 'restore',
						$entry['Entry']['id'],
						$rev2,
						'wiki_id'		=> $this->params['named']['wiki_id']
					)
				);
				$rev1 = __('Revision', true) . $rev1;
				$rev2 = __('Revision', true) . $rev2;
				$msg = printf(__('Differences between revisions %s and %s', true), $rev1, $rev2);
			}
		?>
		</span>
	</h2>
	<div id="diff">
		<?php echo $diff ?>
	</div>
	<div class="wiki-compared-content">
		<h3><?php echo $rev1; ?><span class="note"><?php echo $link1; ?></span></h3>
		<div class="content">
			<?php echo $content1; ?>
		</div>
	</div>
	<div class="wiki-compared-content">
		<h3><?php echo $rev2; ?><span class="note"><?php echo $link2; ?></span></h3>
		<div class="content">
			<?php echo $content2; ?>
		</div>
	</div>
</div>