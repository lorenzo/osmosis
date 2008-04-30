<div class="discussions index">
<h2><?php __('Discussions');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('topic_id');?></th>
	<th><?php echo $paginator->sort('member_id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('content');?></th>
	<th><?php echo $paginator->sort('locked');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($discussions as $discussion):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $discussion['Discussion']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($discussion['Topic']['title'], array('controller'=> 'topics', 'action'=>'view', $discussion['Topic']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($discussion['Member']['id'], array('controller'=> 'members', 'action'=>'view', $discussion['Member']['id'])); ?>
		</td>
		<td>
			<?php echo $discussion['Discussion']['title']; ?>
		</td>
		<td>
			<?php echo $discussion['Discussion']['content']; ?>
		</td>
		<td>
			<?php echo $discussion['Discussion']['locked']; ?>
		</td>
		<td>
			<?php echo $discussion['Discussion']['status']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $discussion['Discussion']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $discussion['Discussion']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $discussion['Discussion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $discussion['Discussion']['id'])); ?>
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
		<li><?php echo $html->link(__('New Discussion', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Topics', true), array('controller'=> 'topics', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Topic', true), array('controller'=> 'topics', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Responses', true), array('controller'=> 'responses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Response', true), array('controller'=> 'responses', 'action'=>'add')); ?> </li>
	</ul>
</div>
