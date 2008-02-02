<?php
	$html->css('/blog/css/blog.css', null, null, false);
?>
<?php
	echo $this->renderElement('post', array('post' => $post['Post']));
?>
<div class="comments">
	<h3><?php __('Comments');?></h3>
<?php
	if (!empty($post['Comment'])):
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
</div>
<?php echo $this->renderElement('comments/add_comment', array('post_id'=> $post['Post']['id']));?>
<ul>
		<li><?php echo $html->link(__('List Post', true), array('controller'=> 'blogs', 'action'=>'view', $post['Post']['blog_id'])); ?></li>
		</ul>
