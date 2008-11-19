<div class="wikis index">
<h2><?php __d('wiki','Wikis');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __d('wiki','Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('course_id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th class="actions"><?php __d('wiki','Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($wikis as $wiki):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $wiki['Wiki']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($wiki['Course']['name'], array('controller'=> 'courses', 'action'=>'view', $wiki['Course']['id'])); ?>
		</td>
		<td>
			<?php echo $wiki['Wiki']['name']; ?>
		</td>
		<td>
			<?php echo $wiki['Wiki']['description']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__d('wiki','View', true), array('action'=>'view', $wiki['Wiki']['id'])); ?>
			<?php echo $html->link(__d('wiki','Edit', true), array('action'=>'edit', $wiki['Wiki']['id'])); ?>
			<?php echo $html->link(__d('wiki','Delete', true), array('action'=>'delete', $wiki['Wiki']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $wiki['Wiki']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__d('wiki','previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__d('wiki','next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__d('wiki','New Wiki', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__d('wiki','List Courses', true), array('controller'=> 'courses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('wiki','New Course', true), array('controller'=> 'courses', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__d('wiki','List Entries', true), array('controller'=> 'entries', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('wiki','New Entry', true), array('controller'=> 'entries', 'action'=>'add')); ?> </li>
	</ul>
</div>
