<div class="posts view">
		<h2>
			<?php echo $post['Post']['title']; ?>
		</h2>
			<?php echo $post['Post']['body']; ?>
		<p><?php __('Created'); ?>
			<?php echo $post['Post']['created']; ?>
			</p>
		<p><?php __('Modified'); ?>
			<?php echo $post['Post']['modified']; ?>
			</p>
</div>
<div class="related">
	<h3><?php __('Comments');?></h3>
	<?php if (!empty($post['Comment'])):?>
	<?php
		$i = 0;
		foreach ($post['Comment'] as $comment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<div class="comment">
		<?php echo $comment['comment'];?>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
		<?php echo $this->renderElement('comments/add_comment', array('post_id'=> $post['Post']['id']));?>
		<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'blogs', 'action'=>'view', $post['Post']['blog_id'])); ?> </li>
	</ul>
</div>
</div>
