<div class="forum discussions view">
	<h2><?php echo $discussion['Discussion']['title']; ?></h2>
	<p class="small-description">
		<?php
			printf(
				__('You are currently viewing a discussion inside the <em>%s</em> topic.', true),
				$html->link(
					$discussion['Topic']['name'],
					array('controller' => 'topics', 'action' => 'view', $discussion['Topic']['id'])
				)
			);
		?>
	</p>
	<div id="discussion" class="forum-message altrow">
		<?php
			echo $this->element(
				'forum_message',
				array('author' => $discussion['Member'], 'message' => $discussion['Discussion'], 'controller' => 'discussions')
			);
		?>
	</div>
<?php
	echo $this->renderElement('discussion_responses', array('responses' => $responses));
?>
</div>
<div class="quick-respond">
	<h3><?php __('Reply to this discussion'); ?></h3>
	<?php
	if ($discussion['Discussion']['status']=='unlocked') :
		echo $this->renderElement('quick_response', array('discussion_id' => $discussion['Discussion']['id']));
	else :
		__('This Discussion is locked, you cannot reply.');
	endif;
	?>
</div>