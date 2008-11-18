<div class="subjects view">
<h2><?php  __d('forum','Subject');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d('forum','Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d('forum','Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d('forum','Forum'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($subject['Forum']['id'], array('controller'=> 'forums', 'action'=>'view', $subject['Forum']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d('forum','Member'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($subject['Member']['id'], array('controller'=> 'members', 'action'=>'view', $subject['Member']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d('forum','Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d('forum','Locked'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['locked']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d('forum','Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__d('forum','Edit Subject', true), array('action'=>'edit', $subject['Subject']['id'])); ?> </li>
		<li><?php echo $html->link(__d('forum','Delete Subject', true), array('action'=>'delete', $subject['Subject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subject['Subject']['id'])); ?> </li>
		<li><?php echo $html->link(__d('forum','List Subjects', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('forum','New Subject', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__d('forum','List Forums', true), array('controller'=> 'forums', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('forum','New Forum', true), array('controller'=> 'forums', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__d('forum','List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('forum','New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__d('forum','List Discussions', true), array('controller'=> 'discussions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('forum','New Discussion', true), array('controller'=> 'discussions', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __d('forum','Related Discussions');?></h3>
	<?php if (!empty($subject['Discussion'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __d('forum','Id'); ?></th>
		<th><?php __d('forum','Subject Id'); ?></th>
		<th><?php __d('forum','Member Id'); ?></th>
		<th><?php __d('forum','Title'); ?></th>
		<th><?php __d('forum','Content'); ?></th>
		<th><?php __d('forum','Locked'); ?></th>
		<th><?php __d('forum','Status'); ?></th>
		<th class="actions"><?php __d('forum','Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($subject['Discussion'] as $discussion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $discussion['id'];?></td>
			<td><?php echo $discussion['subject_id'];?></td>
			<td><?php echo $discussion['member_id'];?></td>
			<td><?php echo $discussion['title'];?></td>
			<td><?php echo $discussion['content'];?></td>
			<td><?php echo $discussion['locked'];?></td>
			<td><?php echo $discussion['status'];?></td>
			<td class="actions">
				<?php echo $html->link(__d('forum','View', true), array('controller'=> 'discussions', 'action'=>'view', $discussion['id'])); ?>
				<?php echo $html->link(__d('forum','Edit', true), array('controller'=> 'discussions', 'action'=>'edit', $discussion['id'])); ?>
				<?php echo $html->link(__d('forum','Delete', true), array('controller'=> 'discussions', 'action'=>'delete', $discussion['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $discussion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__d('forum','New Discussion', true), array('controller'=> 'discussions', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
