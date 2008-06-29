<div id="wiki-content">
	<?php
		echo $this->element('entry', array('entry' => $main));
	?>
	<div id="wiki-sidebar">
		<h5><?php echo $data['Wiki']['name']; ?></h5>
		<div class="wiki-description">
			<p><?php echo $filter->filter($data['Wiki']['description']); ?></p>
			<ul class="reverse actions">
				<li class="edit">
					<?php
						$link = __('Modify this information', true);
						if (empty($data['Wiki']['description'])) {
							$link = __('Add a description', true);
						}
						echo $html->link($link,
							array(
								'controller'	=> 'wikis',
								'action'		=> 'edit',
								'wiki_id'		=> $data['Wiki']['id']
							)
						);
					?>
				</li>
			</ul>
		</div>
		
		<h5><?php __('Recent changes'); ?></h5>
		<div class="wiki-recent">
			<ul>
			<?php
				$i = 0;
				foreach ($data['Entry'] as $entry):
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' altrow';
					}
					echo $this->element('recent_entry', compact('entry', 'class'));
				endforeach;
			?>
			</ul>
			<ul class="reverse actions">
				<li class="add">
					<?php
						echo $html->link(
							__('New Entry', true),
							array('controller'=> 'entries', 'action'=>'add', 'wiki_id' => $data['Wiki']['id']));
					?>
				</li>
				<li class="info">
					<?php
						echo $html->link(
							__('Index of Entries', true),
							array(
								'controller'	=> 'entries',
								'action'		=> 'index',
								'wiki_id'		=> $data['Wiki']['id']
							)
						);
					?>
					
				</li>
			</ul>			
		</div>
	</div>
</div>