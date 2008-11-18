<div class="comments view">
<h2><?php  __d('blog','Comment');?></h2>
	<dl>
		<dt class="altrow"><?php __d('blog','Id'); ?></dt>
		<dd class="altrow">
			<?php echo $comment['Comment']['id']; ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __d('blog','Description'); ?></dt>
		<dd class="altrow">
			<?php echo $comment['Comment']['description']; ?>
			&nbsp;
		</dd>
		<dt><?php __d('blog','Post'); ?></dt>
		<dd>
			<?php echo $html->link($comment['Post']['title'], array('controller'=> 'posts', 'action'=>'view', $comment['Post']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__d('blog','Edit Comment', true), array('action'=>'edit', $comment['Comment']['id'])); ?> </li>
		<li><?php echo $html->link(__d('blog','Delete Comment', true), array('action'=>'delete', $comment['Comment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comment['Comment']['id'])); ?> </li>
		<li><?php echo $html->link(__d('blog','List Comments', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('blog','New Comment', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__d('blog','List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('blog','New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
