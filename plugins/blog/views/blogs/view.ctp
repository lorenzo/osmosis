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
			'/members/view/' . $blog['Member']['id'],
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
			echo $this->element('post', array('post' => $post));
		endforeach; ?>
<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add', $blog['Blog']['id'])); ?> </li>
		</ul>
	</div>
</div>
