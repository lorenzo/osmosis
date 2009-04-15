<div class="subjects index">
<h2><?php __d('forum','Subjects');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __d('forum','Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
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
	<th class="actions"><?php __d('forum','Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($subjects as $subject):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $subject['Subject']['id']; ?>
		</td>
		<td>
			<?php echo $subject['Subject']['title']; ?>
		</td>
		<td>
			<?php echo $html->link($subject['Forum']['id'], array('controller'=> 'forums', 'action'=>'view', $subject['Forum']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($subject['Member']['id'], array('controller'=> 'members', 'action'=>'view', $subject['Member']['id'])); ?>
		</td>
		<td>
			<?php echo $subject['Subject']['created']; ?>
		</td>
		<td>
			<?php echo $subject['Subject']['locked']; ?>
		</td>
		<td>
			<?php echo $subject['Subject']['status']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__d('forum','View', true), array('action'=>'view', $subject['Subject']['id'])); ?>
			<?php echo $html->link(__d('forum','Edit', true), array('action'=>'edit', $subject['Subject']['id'])); ?>
			<?php echo $html->link(__d('forum','Delete', true), array('action'=>'delete', $subject['Subject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subject['Subject']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__d('forum','previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__d('forum','next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__d('forum','New Subject', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__d('forum','List Forums', true), array('controller'=> 'forums', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('forum','New Forum', true), array('controller'=> 'forums', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__d('forum','List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('forum','New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__d('forum','List Discussions', true), array('controller'=> 'discussions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('forum','New Discussion', true), array('controller'=> 'discussions', 'action'=>'add')); ?> </li>
	</ul>
</div>
