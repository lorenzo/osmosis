<div class="topics index">
<h2><?php __('Topics');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('forum_id');?></th>
	<th><?php echo $paginator->sort('member_id');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('locked');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($topics as $topic):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $topic['Topic']['id']; ?>
		</td>
		<td>
			<?php echo $topic['Topic']['title']; ?>
		</td>
		<td>
			<?php echo $html->link($topic['Forum']['id'], array('controller'=> 'forums', 'action'=>'view', $topic['Forum']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($topic['Member']['id'], array('controller'=> 'members', 'action'=>'view', $topic['Member']['id'])); ?>
		</td>
		<td>
			<?php echo $topic['Topic']['created']; ?>
		</td>
		<td>
			<?php echo $topic['Topic']['locked']; ?>
		</td>
		<td>
			<?php echo $topic['Topic']['status']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $topic['Topic']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $topic['Topic']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $topic['Topic']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $topic['Topic']['id'])); ?>
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
		<li><?php echo $html->link(__('New Topic', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Forums', true), array('controller'=> 'forums', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Forum', true), array('controller'=> 'forums', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Discussions', true), array('controller'=> 'discussions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Discussion', true), array('controller'=> 'discussions', 'action'=>'add')); ?> </li>
	</ul>
</div>
