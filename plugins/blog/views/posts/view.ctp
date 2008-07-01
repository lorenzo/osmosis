<h1>
	<?php
		$title = sprintf(__('%s\' Blog', true), $post['Blog']['Member']['full_name']);
		echo $html->link($title, array('controller'=> 'blogs', 'action'=>'view', $post['Post']['blog_id']));
	?>
</h1>
<?php
	echo $this->element('post', array('post' => $post['Post'], 'single' => true));
?>
<h3 id="comments"><?php __('Comments');?></h3>
<div class="comments">
<?php
	if (!empty($post['Comment'])) :
		$i = 0;
		foreach ($post['Comment'] as $comment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' altrow';
			}
			if ($post['Blog']['member_id'] == $comment['Member']['id']) {
				$class = ' owner';
			}
?>
	<div id="comment-<?php echo $comment['id']; ?>" class="comment<?php echo $class ?>">
		<cite>
			<?php
				echo $html->link($comment['Member']['full_name'],
					array(
						'plugin'		=> null,
						'controller'	=> 'members',
						'action'		=> 'view',
						$comment['Member']['id']
					)
				);
			?>
		</cite> <?php echo sprintf(__('wrote %s:',true),$time->timeAgoInWords($comment['created'])); ?>
		<?php
			echo $html->link(
				'#',
				array(
					'plugin'		=> 'blog',
					'controller'	=> 'posts',
					'action'		=> 'view',
					$post['Post']['slug'],
					'#'				=> 'comment-' . $comment['id']
				)
			);
		?>
		<blockquote>
			<?php
				echo $filter->filter($comment['comment']);
			?>
		</blockquote>
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
