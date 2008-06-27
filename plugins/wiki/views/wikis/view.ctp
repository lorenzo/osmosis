<div id="wiki-content">
	<?php
		echo $this->element('entry_title', array('entry' => $data['Entry'][0]));
	?>
	<div id="wiki-sidebar">
		<h5><?php echo $data['Wiki']['name']; ?></h5>
		<p><?php echo $filter->filter($data['Wiki']['description']); ?></p>
		<h5><?php __('Recent changes'); ?></h5>
		
		<ul class="actions">
			<li class="add">
				<?php
					echo $html->link(
						__('New Entry', true),
						array('controller'=> 'entries', 'action'=>'add', 'wiki_id' => $data['Wiki']['id']));
				?>
			</li>
		</ul>
	</div>
	<?php
		echo $this->element('entry', array('entry' => $data['Entry'][0]));
	?>
</div>
	
<div class="related">
	<h3><?php __('Recent Entries');?></h3>
	<?php if (!empty($data['Entry'])):?>
	<ul>
	<?php
		$i = 0;
		foreach ($data['Entry'] as $entry):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<li>
			<h3>
				
				<?php echo $html->link($entry['title'] , array('controller'=> 'entries', 'action'=>'view', $entry['slug'],'wiki_id' => $data['Wiki']['id'])); ?>
				<span class="note">
					&mdash; <?php __('Revision')?> <?php echo $entry['revision'];?>
						(<?php echo $html->link(__('history', true), array('controller' => 'revisions', 'action' => 'history', $entry['id'],'wiki_id' => $data['Wiki']['id'])); ?>)
					&mdash; <?php echo $time->format('d/m/Y', $entry['updated']);?>
					&mdash;
					<?php echo $html->link(__('Edit', true), array('controller'=> 'entries', 'action'=>'edit', $entry['id'], 'wiki_id' => $data['Wiki']['id'])); ?>
				</span>
			</h3>
		</li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>
</div>
