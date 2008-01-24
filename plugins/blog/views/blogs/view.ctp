<div class="blogs view">
	<h2><?php echo $blog['Blog']['title']; ?></h2>
	<p><?php echo $blog['Blog']['description']; ?></p>
</div>
<div class="related">
	<dt> Blog_id </dt>
	<?php echo $blog['Blog']['id']?>
	<dt> member_id </dt><?php echo $blog['Blog']['member_id']?>
	<?php if (!empty($blog['Post'])):?>
	<?php
		$i = 0;
		foreach ($blog['Post'] as $post):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<h3><?php echo $html->link($post['title'], array('controller'=>'posts','action'=>'view', $post['slug']));?></h3>
		<div class="body">	
			<p><?php echo $post['body'];?></p>
			<p><?php echo $post['created'];?></p>
		</div>		
	<?php endforeach; ?>
<?php endif; ?>

	<div class="actions">
	<!-- aquí van los links de actions -->
	<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add', $blog['Blog']['id'])); ?> </li>
	</div>
</div>
