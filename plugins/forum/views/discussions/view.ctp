<div class="discussions view">
	<h2><?php echo $discussion['Topic']['name']; ?> :: <?php echo $discussion['Discussion']['title']; ?></h2>
	<div id="discussion" class="forum-message altrow">
		<p class="author">
			<?php printf(__('By %s', true), $discussion['Member']['full_name']); ?> <br />
			<span class="date"><?php echo $time->nice($discussion['Discussion']['created']); ?></span>
		</p>
		<div class="message">
			<div class="content">
				<?php
					echo $discussion['Discussion']['content'];
				?>
			</div>
		</div>
	</div>
<?php
	echo $this->requestAction(
		'/forum/responses/discussion_responses/' . $discussion['Discussion']['id'],
		array('return')
	);
?>
</div>
<div class="quick-respond">
	<?php
		echo $this->renderElement('quick_response');
	?>
</div>
