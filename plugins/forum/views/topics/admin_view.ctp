<div class="topics view">
<h2><?php  __('Topic');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $topic['Topic']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $topic['Topic']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Forum'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($topic['Forum']['id'], array('controller'=> 'forums', 'action'=>'view', $topic['Forum']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Member'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($topic['Member']['id'], array('controller'=> 'members', 'action'=>'view', $topic['Member']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $topic['Topic']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Locked'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $topic['Topic']['locked']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $topic['Topic']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Topic', true), array('action'=>'edit', $topic['Topic']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Topic', true), array('action'=>'delete', $topic['Topic']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $topic['Topic']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Topics', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Topic', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Forums', true), array('controller'=> 'forums', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Forum', true), array('controller'=> 'forums', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Discussions', true), array('controller'=> 'discussions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Discussion', true), array('controller'=> 'discussions', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Discussions');?></h3>
	<?php if (!empty($topic['Discussion'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Topic Id'); ?></th>
		<th><?php __('Member Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Content'); ?></th>
		<th><?php __('Locked'); ?></th>
		<th><?php __('Status'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($topic['Discussion'] as $discussion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $discussion['id'];?></td>
			<td><?php echo $discussion['topic_id'];?></td>
			<td><?php echo $discussion['member_id'];?></td>
			<td><?php echo $discussion['title'];?></td>
			<td><?php echo $discussion['content'];?></td>
			<td><?php echo $discussion['locked'];?></td>
			<td><?php echo $discussion['status'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'discussions', 'action'=>'view', $discussion['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'discussions', 'action'=>'edit', $discussion['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'discussions', 'action'=>'delete', $discussion['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $discussion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Discussion', true), array('controller'=> 'discussions', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
