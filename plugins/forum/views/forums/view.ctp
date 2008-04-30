<div class="forums view">
<h2>
	<?php  __('Forum');?> &mdash;
	<?php echo $html->link(__('Add Topic', true), array('controller' => 'topics', 'action' => 'add', 'forum' => $forum['Forum']['id'])); ?>
</h2>
<?php if (!empty($forum['Topic'])):?>
<table cellpadding="0" cellspacing="0" class="forum-list">
	<tr>
		<th><?php __('Status'); ?></th>
		<th><?php __('Topic'); ?></th>
		<th class="plain date"><?php __('Created'); ?></th>
		<!-- <th class="actions"><?php __('Actions');?></th> -->
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
					);?> <br /> <?php echo $topic['description']; ?>
			</td>
			<td class="date"><?php echo $time->nice($topic['created']);?></td>
			<!-- <td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'topics', 'action'=>'view', $topic['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'topics', 'action'=>'edit', $topic['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'topics', 'action'=>'delete', $topic['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $topic['id'])); ?>
			</td> -->
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Topic', true), array('controller'=> 'topics', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
