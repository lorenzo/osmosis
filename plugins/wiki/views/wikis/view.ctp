<div class="wikis view">
<h2><?php  __('Wiki');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id'); ?></dt>
		<dd class="altrow">
			<?php echo $wiki['Wiki']['id']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Course'); ?></dt>
		<dd>
			<?php echo $html->link($wiki['Course']['name'], array('controller'=> 'courses', 'action'=>'view', $wiki['Course']['id'])); ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Name'); ?></dt>
		<dd class="altrow">
			<?php echo $wiki['Wiki']['name']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Description'); ?></dt>
		<dd>
			<?php echo $wiki['Wiki']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
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
</div>
<div class="related">
	<h3><?php __('Related Entries');?></h3>
	<?php if (!empty($wiki['Entry'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Wiki Id'); ?></th>
		<th><?php __('Member Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Content'); ?></th>
		<th><?php __('Revision'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($wiki['Entry'] as $entry):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr>
			<td><?php echo $entry['id'];?></td>
			<td><?php echo $entry['wiki_id'];?></td>
			<td><?php echo $entry['member_id'];?></td>
			<td><?php echo $entry['title'];?></td>
			<td><?php echo $entry['content'];?></td>
			<td><?php echo $entry['revision'];?></td>
			<td><?php echo $entry['created'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'entries', 'action'=>'view', $entry['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'entries', 'action'=>'edit', $entry['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'entries', 'action'=>'delete', $entry['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $entry['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Entry', true), array('controller'=> 'entries', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
