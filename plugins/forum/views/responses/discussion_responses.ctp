<div class="responses">
<?php
	if (!empty($responses)):
?>
<h3><?php __('Responses'); ?></h3>
<ol class="responses">
	<?php
		$i = 0;
		foreach ($responses as $response):
			$class = null;
			if ($i++ % 2 != 0) {
				$class = 'altrow';
			}
		?>
	<li class="forum-message <?php echo $class;?>">
		<p class="author">
			<?php printf(__('By %s', true), $response['Member']['full_name']); ?> <br />
			<span class="date"><?php echo $time->nice($response['Response']['created']);?></span>
		</p>
		<div class="message">
			<div class="content">
				<?php echo $response['Response']['content'];?>
			</div>
		</div>
			
			<!-- <td class="actions">
				<?php //echo $html->link(__('View', true), array('controller'=> 'responses', 'action'=>'view', $response['id'])); ?>
				<?php //echo $html->link(__('Edit', true), array('controller'=> 'responses', 'action'=>'edit', $response['id'])); ?>
				<?php //echo $html->link(__('Delete', true), array('controller'=> 'responses', 'action'=>'delete', $response['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $response['id'])); ?>
			</td> -->
	</li>
	<?php
			endforeach;
	?>
</ol>
<?php
	endif;
?>
</div>