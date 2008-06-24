<div class="forum forums view">
<h2>
	<?php  __('Forum');?>
</h2>
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
<p class="actions-button">
	<?php
		echo ' ';
		echo $html->link(
			__('Create a new Topic', true),
			array('controller' => 'topics', 'action' => 'add', 'course_id' => $course['Course']['id'])
		);
	?>
</p>
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
				?> <br /> <?php echo $filter->filter($topic['description']); ?> &mdash;
				<?php
					if ($topic['status']!='locked') :
						echo $html->link(
							__('edit', true),
							array('controller' => 'topics', 'action' => 'edit', 'topic_id' =>  $topic['id'])
						);
				?> &mdash;
				<?php
					endif;
					echo $html->link(
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
<?php endif; ?>
	<div class="actions">
		<ul>
			<li>
				<?php
					echo $html->link(
						__('Create a new Topic', true),
						array('controller' => 'topics', 'action' => 'add', 'course_id' => $course['Course']['id'])
					);
				?>
			</li>
		</ul>
	</div>
</div>
