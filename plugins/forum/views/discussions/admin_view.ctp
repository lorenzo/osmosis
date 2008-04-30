<div class="discussions view">
<h2><?php  __('Discussion');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $discussion['Discussion']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Topic'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($discussion['Topic']['title'], array('controller'=> 'topics', 'action'=>'view', $discussion['Topic']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Member'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($discussion['Member']['id'], array('controller'=> 'members', 'action'=>'view', $discussion['Member']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $discussion['Discussion']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Content'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $discussion['Discussion']['content']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Locked'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $discussion['Discussion']['locked']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $discussion['Discussion']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Discussion', true), array('action'=>'edit', $discussion['Discussion']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Discussion', true), array('action'=>'delete', $discussion['Discussion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $discussion['Discussion']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Discussions', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Discussion', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Topics', true), array('controller'=> 'topics', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Topic', true), array('controller'=> 'topics', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Responses', true), array('controller'=> 'responses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Response', true), array('controller'=> 'responses', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Responses');?></h3>
	<?php if (!empty($discussion['Response'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Discussion Id'); ?></th>
		<th><?php __('Member Id'); ?></th>
		<th><?php __('Content'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($discussion['Response'] as $response):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $response['id'];?></td>
			<td><?php echo $response['discussion_id'];?></td>
			<td><?php echo $response['member_id'];?></td>
			<td><?php echo $response['content'];?></td>
			<td><?php echo $response['created'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'responses', 'action'=>'view', $response['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'responses', 'action'=>'edit', $response['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'responses', 'action'=>'delete', $response['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $response['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Response', true), array('controller'=> 'responses', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
