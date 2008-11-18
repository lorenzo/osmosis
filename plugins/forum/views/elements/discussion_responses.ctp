<div class="responses">
<?php
	if (!empty($responses)):
?>
<h3>
	<?php __d('forum','Responses'); ?>
	<span>
		<?php
			echo $paginator->counter(array(
				'format' => __d('forum','Page %page% of %pages%', true)
				)
			);
		?>
	</span>
</h3>
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
		<?php
			echo $this->element(
				'forum_message',
				array('author' => $response['Member'], 'message' => $response['Response'], 'controller' => 'responses')
			);
		?>
	</li>
	<?php
			endforeach;
	?>
</ol>
<div class="paging">
	<?php
		$paginator->options['url'] = array('controller' => 'discussions', 'action' => 'view', $response['Discussion']['id']);
	?>
	<?php echo $paginator->prev('<< '.__d('forum','previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__d('forum','next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

<?php
	endif;
?>
</div>