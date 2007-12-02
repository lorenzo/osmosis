<div class="entries view">
<h2><?php  __('Entry');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id'); ?></dt>
		<dd class="altrow">
			<?php echo $entry['Entry']['id']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Wiki'); ?></dt>
		<dd>
			<?php echo $html->link($entry['Wiki']['name'], array('controller'=> 'wikis', 'action'=>'view', $entry['Wiki']['id'])); ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Member'); ?></dt>
		<dd class="altrow">
			<?php echo $html->link($entry['Member']['id'], array('controller'=> 'members', 'action'=>'view', $entry['Member']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php __('Title'); ?></dt>
		<dd>
			<?php echo $entry['Entry']['title']; ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Content'); ?></dt>
		<dd class="altrow">
			<?php echo $entry['Entry']['content']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Revision'); ?></dt>
		<dd>
			<?php echo $entry['Entry']['revision']; ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Created'); ?></dt>
		<dd class="altrow">
			<?php echo $entry['Entry']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Entry', true), array('action'=>'edit', $entry['Entry']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Entry', true), array('action'=>'delete', $entry['Entry']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $entry['Entry']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Entries', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Entry', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Wikis', true), array('controller'=> 'wikis', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Wiki', true), array('controller'=> 'wikis', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Revisions', true), array('controller'=> 'revisions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Revision', true), array('controller'=> 'revisions', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Revisions');?></h3>
	<?php if (!empty($entry['Revision'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Entry Id'); ?></th>
		<th><?php __('Member Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Content'); ?></th>
		<th><?php __('Revision'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($entry['Revision'] as $revision):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr class="altrow">
			<td><?php echo $revision['id'];?></td>
			<td><?php echo $revision['entry_id'];?></td>
			<td><?php echo $revision['member_id'];?></td>
			<td><?php echo $revision['title'];?></td>
			<td><?php echo $revision['content'];?></td>
			<td><?php echo $revision['revision'];?></td>
			<td><?php echo $revision['created'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'revisions', 'action'=>'view', $revision['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'revisions', 'action'=>'edit', $revision['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'revisions', 'action'=>'delete', $revision['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $revision['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Revision', true), array('controller'=> 'revisions', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
