<h2><?php echo $wiki['Wiki']['name']; ?></h2>
<p><?php echo $wiki['Wiki']['description']; ?></p>
<!--<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Wiki', true), array('action'=>'edit', $wiki['Wiki']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Wiki', true), array('action'=>'delete', $wiki['Wiki']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $wiki['Wiki']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Wikis', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Wiki', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Courses', true), array('controller'=> 'courses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Course', true), array('controller'=> 'courses', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Entries', true), array('controller'=> 'entries', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Entry', true), array('controller'=> 'entries', 'action'=>'add')); ?> </li>
	</ul>
</div>-->
<div class="related">
	<h3><?php __('Related Entries');?></h3>
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
				
				<?php echo $html->link($entry['title'] , array('controller'=> 'entries', 'action'=>'view', $entry['id'])); ?>
				<span class="note">
					&mdash; <?php __('Revision')?> <?php echo $entry['revision'];?>
						(<?php echo $html->link(__('history', true), array('controller' => 'revisions', 'action' => 'history', $entry['id'])); ?>)
					&mdash; <?php echo $time->format('d/m/Y', $entry['created']);?></span>
			</h3>
			<p>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'entries', 'action'=>'edit', $entry['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'entries', 'action'=>'delete', $entry['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $entry['id'])); ?>
			</p>
		</li>
	<?php endforeach; ?>
	</ul>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Title'); ?></th>
		<th><?php __('Revision'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Entry', true), array('controller'=> 'entries', 'action'=>'add', $wiki['Wiki']['id']));?> </li>
		</ul>
	</div>
</div>
