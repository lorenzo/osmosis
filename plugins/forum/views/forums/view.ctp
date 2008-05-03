<div class="forum forums view">
<h2>
	<?php  __('Forum');?>
</h2>
<p class="small-description">
	<?php
		printf(
			__('You are currently viewing the topics in the <em>%s</em> course forum.', true),
			$html->link(
				$forum['Course']['name'],
				array('controller' => 'topics', 'action' => 'view', $forum['Course']['id'])
			)
		);
		echo ' ';
		echo $html->link(
			__('Create a new Topic', true),
			array('controller' => 'topics', 'action' => 'add', 'forum' => $forum['Forum']['id'])
		);
	?>
</p>
<?php if (!empty($forum['Topic'])):?>
<table cellpadding="0" cellspacing="0" class="forum-list">
	<tr>
		<th><?php __('Status'); ?></th>
		<th><?php __('Topic'); ?></th>
		<th class="plain date"><?php __('Created'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($forum['Topic'] as $topic):
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
						array('controller'=> 'topics', 'action'=>'view', $topic['id'])
					);
				?> <br /> <?php echo $topic['description']; ?> &mdash;
				<?php
					if ($topic['status']!='locked') :
						echo $html->link(__('edit', true), array('controller' => 'topics', 'action' => 'edit', $topic['id']));
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
			<li><?php echo $html->link(__('New Topic', true), array('controller' => 'topics', 'action' => 'add', 'forum' => $forum['Forum']['id']));?> </li>
		</ul>
	</div>
</div>
