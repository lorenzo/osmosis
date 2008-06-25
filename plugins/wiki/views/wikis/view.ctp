<h2><?php echo $wiki['Wiki']['name']; ?></h2>
<p><?php echo $filter->filter($wiki['Wiki']['description']); ?></p>
	<ul class="actions">
		<li class="add">
			<?php
				echo $html->link(
					__('New Entry', true),
					array('controller'=> 'entries', 'action'=>'add', 'wiki_id' => $wiki['Wiki']['id']));
			?>
		</li>
	</ul>
<div class="related">
	<h3><?php __('Recent Entries');?></h3>
	<?php if (!empty($wiki['Entry'])):?>
	<ul>
	<?php
		$i = 0;
		foreach ($wiki['Entry'] as $entry):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<li>
			<h3>
				
				<?php echo $html->link($entry['title'] , array('controller'=> 'entries', 'action'=>'view', $entry['slug'],'wiki_id' => $wiki['Wiki']['id'])); ?>
				<span class="note">
					&mdash; <?php __('Revision')?> <?php echo $entry['revision'];?>
						(<?php echo $html->link(__('history', true), array('controller' => 'revisions', 'action' => 'history', $entry['id'],'wiki_id' => $wiki['Wiki']['id'])); ?>)
					&mdash; <?php echo $time->format('d/m/Y', $entry['updated']);?>
					&mdash;
					<?php echo $html->link(__('Edit', true), array('controller'=> 'entries', 'action'=>'edit', $entry['id'], 'wiki_id' => $wiki['Wiki']['id'])); ?>
				</span>
			</h3>
		</li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>
</div>
