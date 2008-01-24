<?php
	$html->css('/blog/css/blog.css', null, null, false);
?>
<div id="blog-header">
	<h2><?php echo $blog['Blog']['title']; ?></h2>
	<p class="description"><?php echo $blog['Blog']['description']; ?></p>
	<p class="author"><?php __('By:'); ?> 
	<?php
		echo $html->link(
			$blog['Member']['full_name'],
			'#',
			array(
				'title' => 'Ver el perfil de ' . $blog['Member']['full_name']
			)
		);
	?></p>
</div>
<div class="blog-posts">
	<?php if (!empty($blog['Post'])):?>
	<?php
		$i = 0;
		foreach ($blog['Post'] as $post):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<h3 id="post<?php echo $post['id']?>" class="post-title"><?php echo $html->link($post['title'], array('controller'=>'posts','action'=>'view', $post['slug']));?></h3>
		<div class="date">
			<span class="month"><?php echo $time->format('M', $post['created']);?></span>
			<span class="day"><?php echo $time->format('d', $post['created']);?></span>
		</div>
		<div class="body">	
			<?php echo $post['body'];?>
		</div>
		<?php echo $html->link(__('Edit', true), array('controller'=>'posts', 'action' => 'edit', $post['id'])); ?>
	<?php endforeach; ?>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add', $blog['Blog']['id'])); ?> </li>
		</ul>
	</div>
</div>
