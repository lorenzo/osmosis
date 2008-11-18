<div class="forum topics view">
<h2>
	<?php
		__d('forum','Topic:');
	 	echo ' ' . $topic['Topic']['name'];
	?>
</h2>
<div id="forum-head">
<p class="small-description">
	<?php
		printf(
			__d('forum','You are currently viewing the discussions started around this topic <strong>"%s"</strong> inside the <em>%s</em> course forum.', true),
			$topic['Topic']['name'],
			$html->link(
				$topic['Course']['name'],
				array('controller' => 'topics', 'action' => 'index', 'course_id' => $topic['Course']['id'])
			)
		);
	?>
</p>
<ul class="actions">
	<li class="add">
		<?php
			echo  $html->link(
				__d('forum','Start a discussion', true),
				array('controller'=> 'discussions','action'=>'add','topic_id' => $topic['Topic']['id'])
			);
		?>
	</li>
</ul>
</div>
<?php
	if (!empty($topic['Discussion'])):
?>
	<table cellpadding="0" cellspacing="0" class="forum-list">
	<tr>
		<th><?php __d('forum','Status'); ?></th>
		<th><?php __d('forum','Title'); ?> / <?php __('Author &mdash; Created'); ?> </th>
		<th class="date"><?php __d('forum','Last Response'); ?></th>
		<th class="number"><?php __d('forum','Responses'); ?></th>
		<th class="number"><?php __d('forum','Views'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($topic['Discussion'] as $discussion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td class="discussion-status <?php echo $discussion['status'] ?>"><?php echo $discussion['status'];?></td>
			<?php $sticky = ($discussion['sticky']) ? ' class="sticky"' : ''; ?>
			<td<?php echo $sticky; ?>>
				<?php
					echo $html->link(
						$discussion['title'],
						array(
							'controller'=> 'discussions',
							'action'=>'view',
							'discussion_id' => $discussion['id']
						),
						array('title' => $text->truncate(strip_tags($discussion['content'])))
					);
				?> 	<?php
						if (!in_array($Osmosis['currentRole'],a('Member','Public','Attendee'))) :
							echo '&mdash; '.$html->link(
								__d('forum','edit', true),
								array('controller' => 'discussions', 'action' => 'edit', 'discussion_id' =>  $discussion['id'])
							);
					?>
					<?php
						endif;
						if (in_array($Osmosis['currentRole'],a('Professor','Admin')))
						echo ' &mdash; '.$html->link(
							__d('forum','delete', true),
							array('controller' => 'discussions', 'action' => 'delete', $discussion['id']),
							array('confirm' => __d('forum','This will also delete all responses on this discussion', true))
						);
					?>
				<br />
				<?php echo $discussion['Member']['full_name']; ?> &mdash;
				<span class="date"><?php echo $time->nice($discussion['created']); ?></span>
			</td>
			<td class="last-response date">
				<?php
					$last_response = $discussion['Response'];
					if (!empty($last_response)) {
						$last_response = $last_response[0];
						echo $time->nice($last_response['created']) . '<br />';
						printf(
							__d('forum','By: %s', true),
							$html->link(
								$last_response['Member']['full_name'],
								array(
									'controller' => 'members',
									'action' => 'view',
									'plugin' => '',
									$last_response['Member']['id']
								)
							)
						);
					 } else {
						__d('forum','No responses yet');
					}
				?>
			</td>
			<td class="number"><?php echo $discussion['response_count']; ?></td>
			<td class="number"><?php echo $discussion['discussion_visit_count']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php
	else :
?>
	<p><?php __d('forum','No discussions registered yet'); ?>
<?php
	endif;
?>
<ul class="reverse actions">
	<li class="add">
		<?php
			echo  $html->link(
				__d('forum','Start a discussion', true),
				array('controller'=> 'discussions','action'=>'add','topic_id' => $topic['Topic']['id'])
			);
		?>
	</li>
</ul>
</div>
