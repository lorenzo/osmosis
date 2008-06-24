<h1>
	<?php
		$title = sprintf(__('%s\' Blog', true), $post['Blog']['Member']['full_name']);
		echo $html->link($title, array('controller'=> 'blogs', 'action'=>'view', $post['Post']['blog_id']));
	?>
</h1>
<?php
	echo $this->element('post', array('post' => $post['Post']));
?>
<h3 id="comments"><?php __('Comments');?></h3>
<div class="comments">
<?php
	if (!empty($post['Comment'])) :
		$i = 0;
		foreach ($post['Comment'] as $comment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
?>
	<div class="comment">
		<?php echo $filter->filter($comment['comment']);?>
	</div>
<?php
	endforeach;
	else :
?>
	<p><?php __('No comments yet'); ?></p>
<?php
	endif;
?>
</div>
<?php echo $this->element('comments/add_comment', array('post_id'=> $post['Post']['id']));?>
