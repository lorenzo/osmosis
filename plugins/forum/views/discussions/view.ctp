<div class="forum discussions view">
	<h2>
		<?php
			__('Discussion:');
			echo ' ' . $discussion['Discussion']['title'];
		?>
	</h2>
	<p class="small-description">
		<?php
			printf(
				__('You are currently viewing a discussion inside the <em>%s</em> topic.', true),
				$html->link(
					$discussion['Topic']['name'],
					array('controller' => 'topics', 'action' => 'view', 'topic_id' => $discussion['Topic']['id'])
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
	echo $this->element('discussion_responses', array('responses' => $responses));
?>
</div>
<div class="quick-respond">
	<?php
	if ($discussion['Discussion']['status']!='locked' && $discussion['Topic']['status']!='locked') :
		echo $this->element('quick_response', array('discussion_id' => $discussion['Discussion']['id']));
	else :
	?>
		<p><?php __('This Discussion is locked, you cannot reply.'); ?></p>
	<?php
	endif;
	?>
</div>