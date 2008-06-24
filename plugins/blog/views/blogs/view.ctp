<h1>
	<?php
		printf(__('%s\' Blog', true), $blog['Member']['full_name']);
	?>
</h1>
<?php
	if ($Osmosis['active_member']['id']==$blog['Member']['id']) :
?>
	<ul class="reverse actions">
		<li class="add">
			<?php
				echo $html->link(
					__('New Post', true),
					array('controller'=> 'posts', 'action'=>'add', $blog['Blog']['id'])
				);
			?>
		</li>
	</ul>
<?php
	endif;
?>
<div class="blog-posts">
<?php
	if (!empty($blog['Post'])):
		$i = 0;
		foreach ($blog['Post'] as $post):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			echo $this->element('post', array('post' => $post));
		endforeach;
	else :
?>
	<p>
		<?php
			__('No Posts written yet');
		?>
	</p>
<?php
	endif;
?>
</div>
