<div class="posts view">
<h2><?php  __('Post');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id'); ?></dt>
		<dd class="altrow">
			<?php echo $post['Post']['id']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Title'); ?></dt>
		<dd>
			<?php echo $post['Post']['title']; ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Body'); ?></dt>
		<dd class="altrow">
			<?php echo $post['Post']['body']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Created'); ?></dt>
		<dd>
			<?php echo $post['Post']['created']; ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Modified'); ?></dt>
		<dd class="altrow">
			<?php echo $post['Post']['modified']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Blog'); ?></dt>
		<dd>
			<?php echo $html->link($post['Blog']['title'], array('controller'=> 'blogs', 'action'=>'view', $post['Blog']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Post', true), array('action'=>'edit', $post['Post']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Post', true), array('action'=>'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['Post']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Posts', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Blogs', true), array('controller'=> 'blogs', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Blog', true), array('controller'=> 'blogs', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Comments', true), array('controller'=> 'comments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Comment', true), array('controller'=> 'comments', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Comments');?></h3>
	<?php if (!empty($post['Comment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Post Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($post['Comment'] as $comment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr>
			<td><?php echo $comment['id'];?></td>
			<td><?php echo $comment['title'];?></td>
			<td><?php echo $comment['description'];?></td>
			<td><?php echo $comment['post_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'comments', 'action'=>'view', $comment['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'comments', 'action'=>'edit', $comment['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'comments', 'action'=>'delete', $comment['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Comment', true), array('controller'=> 'comments', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
