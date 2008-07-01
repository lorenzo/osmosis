<div class="forum forums view">
<h2>
	<?php  __('Forum');?>
</h2>
<div id="forum-head">
	<p class="small-description">
		<?php
			printf(
				__('You are currently viewing the topics in the <em>%s</em> course forum.', true),
				$html->link(
					$course['Course']['name'],
					array('controller' => 'courses', 'action' => 'view', $course['Course']['id'], 'plugin' => '')
				)
			);
		
		?>
	</p>
	<ul class="actions">
		<li class="add">
			<?php
				echo $html->link(
					__('Create a new Topic', true),
					array('controller' => 'topics', 'action' => 'add', 'course_id' => $course['Course']['id'])
				);
			?>
		</li>
	</ul>
</div>
<?php if (!empty($topics)):?>
<table cellpadding="0" cellspacing="0" class="forum-list">
	<tr>
		<th><?php __('Status'); ?></th>
		<th><?php __('Topic'); ?></th>
		<th class="plain date"><?php __('Created'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($topics as $topic):
			$topic = $topic['Topic'];
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td class="discussion-status <?php echo $topic['status'] ?>"><?php echo $topic['status'];?></td>
			<td>
				<?php
					echo $html->link(
						$topic['name'],
						array('controller'=> 'topics', 'action'=>'view', 'topic_id' =>  $topic['id'])
					);
				?> <br /> <?php echo $filter->filter($topic['description']); ?>
				<?php
					if (!in_array($Osmosis['currentRole'],a('Member','Public','Attendee'))) :
						echo '&mdash; '.$html->link(
							__('edit', true),
							array('controller' => 'topics', 'action' => 'edit', 'topic_id' =>  $topic['id'])
						);
				?>
				<?php
					endif;
					if (in_array($Osmosis['currentRole'],a('Professor','Admin')))
					echo ' &mdash; '.$html->link(
						__('delete', true),
						array('controller' => 'topics', 'action' => 'delete', $topic['id']),
						array('confirm' => __('This will also delete all discussions on this topic', true))
					);
				?>
			</td>
			<td class="date"><?php echo $time->nice($topic['created']);?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<ul class="reverse actions">
		<li class="add">
			<?php
				echo $html->link(
					__('Create a new Topic', true),
					array('controller' => 'topics', 'action' => 'add', 'course_id' => $course['Course']['id'])
				);
			?>
		</li>
	</ul>
<?php endif; ?>
</div>
