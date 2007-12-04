<div class="comments view">
<h2><?php  __('Comment');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id'); ?></dt>
		<dd class="altrow">
			<?php echo $comment['Comment']['id']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Title'); ?></dt>
		<dd>
			<?php echo $comment['Comment']['title']; ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Description'); ?></dt>
		<dd class="altrow">
			<?php echo $comment['Comment']['description']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Post'); ?></dt>
		<dd>
			<?php echo $html->link($comment['Post']['title'], array('controller'=> 'posts', 'action'=>'view', $comment['Post']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Comment', true), array('action'=>'edit', $comment['Comment']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Comment', true), array('action'=>'delete', $comment['Comment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comment['Comment']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Comments', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Comment', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
