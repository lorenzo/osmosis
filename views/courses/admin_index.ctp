<div class="courses index">
<h2><?php __('Courses');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('department_id');?></th>
	<th><?php echo $paginator->sort('owner_id');?></th>
	<th><?php echo $paginator->sort('code');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($courses as $course):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $course['Course']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($course['Department']['name'], array('controller'=> 'departments', 'action'=>'view', $course['Department']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($course['Owner']['id'], array('controller'=> 'members', 'action'=>'view', $course['Owner']['id'])); ?>
		</td>
		<td>
			<?php echo $course['Course']['code']; ?>
		</td>
		<td>
			<?php echo $course['Course']['name']; ?>
		</td>
		<td>
			<?php echo $course['Course']['description']; ?>
		</td>
		<td>
			<?php echo $course['Course']['created']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $course['Course']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $course['Course']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $course['Course']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $course['Course']['id'])); ?>
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
		<li><?php echo $html->link(__('New Course', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Departments', true), array('controller'=> 'departments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Department', true), array('controller'=> 'departments', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Owner', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
	</ul>
</div>
