<div class="members index">
<h2><?php __('Members');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('institution_id');?></th>
	<th><?php echo $paginator->sort('full_name');?></th>
	<th><?php echo $paginator->sort('email');?></th>
	<th><?php echo $paginator->sort('phone');?></th>
	<th><?php echo $paginator->sort('country');?></th>
	<th><?php echo $paginator->sort('city');?></th>
	<th><?php echo $paginator->sort('age');?></th>
	<th><?php echo $paginator->sort('sex');?></th>
	<th><?php echo $paginator->sort('username');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($members as $member):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $member['Member']['id']; ?>
		</td>
		<td>
			<?php echo $member['Member']['institution_id']; ?>
		</td>
		<td>
			<?php echo $member['Member']['full_name']; ?>
		</td>
		<td>
			<?php echo $member['Member']['email']; ?>
		</td>
		<td>
			<?php echo $member['Member']['phone']; ?>
		</td>
		<td>
			<?php echo $member['Member']['country']; ?>
		</td>
		<td>
			<?php echo $member['Member']['city']; ?>
		</td>
		<td>
			<?php echo $member['Member']['age']; ?>
		</td>
		<td>
			<?php echo $member['Member']['sex']; ?>
		</td>
		<td>
			<?php echo $member['Member']['username']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('admin' => false,'action'=>'view', $member['Member']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $member['Member']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $member['Member']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $member['Member']['id'])); ?>
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
		<li><?php echo $html->link(__('New Member', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('Batch Load', true), array('action'=>'batch_load')); ?></li>
	</ul>
</div>
