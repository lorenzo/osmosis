<div class="forums view">
<h2><?php  __('Forum');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $forum['Forum']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Course'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($forum['Course']['name'], array('controller'=> 'courses', 'action'=>'view', $forum['Course']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Forum', true), array('action'=>'edit', $forum['Forum']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Forum', true), array('action'=>'delete', $forum['Forum']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $forum['Forum']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Forums', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Forum', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Courses', true), array('controller'=> 'courses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Course', true), array('controller'=> 'courses', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Subjects', true), array('controller'=> 'subjects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Subject', true), array('controller'=> 'subjects', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Subjects');?></h3>
	<?php if (!empty($forum['Subject'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Forum Id'); ?></th>
		<th><?php __('Member Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Locked'); ?></th>
		<th><?php __('Status'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($forum['Subject'] as $subject):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $subject['id'];?></td>
			<td><?php echo $subject['title'];?></td>
			<td><?php echo $subject['forum_id'];?></td>
			<td><?php echo $subject['member_id'];?></td>
			<td><?php echo $subject['created'];?></td>
			<td><?php echo $subject['locked'];?></td>
			<td><?php echo $subject['status'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'subjects', 'action'=>'view', $subject['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'subjects', 'action'=>'edit', $subject['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'subjects', 'action'=>'delete', $subject['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subject['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Subject', true), array('controller'=> 'subjects', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
