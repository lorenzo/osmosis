<div class="forums index">
<h2><?php __('Forums');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('course_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($forums as $forum):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $forum['Forum']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($forum['Course']['name'], array('controller'=> 'courses', 'action'=>'view', $forum['Course']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $forum['Forum']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $forum['Forum']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $forum['Forum']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $forum['Forum']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Forum', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Courses', true), array('controller'=> 'courses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Course', true), array('controller'=> 'courses', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Topics', true), array('controller'=> 'topics', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Topic', true), array('controller' => 'topics', 'action' => 'add', 'forum' => $forum['Forum']['id'])); ?> </li>
	</ul>
</div>
