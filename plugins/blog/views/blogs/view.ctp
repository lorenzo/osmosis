<div class="blogs view">
<h2><?php  __('Blog');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id'); ?></dt>
		<dd class="altrow">
			<?php echo $blog['Blog']['id']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Title'); ?></dt>
		<dd>
			<?php echo $blog['Blog']['title']; ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Description'); ?></dt>
		<dd class="altrow">
			<?php echo $blog['Blog']['description']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Owner'); ?></dt>
		<dd>
			<?php echo $blog['Blog']['owner']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Blog', true), array('action'=>'edit', $blog['Blog']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Blog', true), array('action'=>'delete', $blog['Blog']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $blog['Blog']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Blogs', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Blog', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Posts');?></h3>
	<?php if (!empty($blog['Post'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Body'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Blog Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($blog['Post'] as $post):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr>
			<td><?php echo $post['id'];?></td>
			<td><?php echo $post['title'];?></td>
			<td><?php echo $post['body'];?></td>
			<td><?php echo $post['created'];?></td>
			<td><?php echo $post['modified'];?></td>
			<td><?php echo $post['blog_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'posts', 'action'=>'view', $post['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'posts', 'action'=>'edit', $post['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'posts', 'action'=>'delete', $post['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
