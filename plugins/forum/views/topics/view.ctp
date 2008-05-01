<div class="forum topics view">
<h2>
	<?php
	 	__($topic['Topic']['name'])
	?>
</h2>
<p class="small-description">
	<?php
	// debug($topic);
		printf(
			__('You are currently in a topic inside the <em>%s</em> course forum.', true),
			$html->link(
				$topic['Forum']['Course']['name'],
				array('controller' => 'forums', 'action' => 'view', $topic['Forum']['id'])
			)
		);
		echo ' ';
		echo  $html->link(
			__('Start a discussion', true),
			array(
				'controller'=> 'discussions',
				'action'=>'add',
				'topic' => $topic['Topic']['id']
			)
		);
	?>
</p>
<?php
	if (!empty($topic['Discussion'])):
?>
	<table cellpadding="0" cellspacing="0" class="forum-list">
	<tr>
		<th><?php __('Status'); ?></th>
		<th><?php __('Title'); ?> / <?php __('Author &mdash; Created'); ?> </th>
		<th class="date"><?php __('Last Response'); ?></th>
		<th class="number"><?php __('Responses'); ?></th>
		<th class="number"><?php __('Views'); ?></th>
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
							$discussion['id']
						),
						array('title' => $text->truncate(strip_tags($discussion['content'])))
					);
				?> <br />
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
							__('By: %s', true),
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
						__('No responses yet');
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
	<p><?php __('No discussions registered yet'); ?>
<?php
	endif;
?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Discussion', true), array('controller'=> 'discussions', 'action'=>'add', 'topic' => $topic['Topic']['id']));?> </li>
		</ul>
	</div>
</div>
