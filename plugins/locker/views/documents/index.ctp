<div class="lockerDocuments index">
<h2><?php __('LockerDocuments');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('member_id');?></th>
	<th><?php echo $paginator->sort('folder_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($lockerDocuments as $lockerDocument):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $lockerDocument['LockerDocument']['id']; ?>
		</td>
		<td>
			<?php echo $lockerDocument['LockerDocument']['name']; ?>
		</td>
		<td>
			<?php echo $lockerDocument['LockerDocument']['description']; ?>
		</td>
		<td>
			<?php echo $lockerDocument['LockerDocument']['member_id']; ?>
		</td>
		<td>
			<?php echo $lockerDocument['LockerDocument']['folder_id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $lockerDocument['LockerDocument']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $lockerDocument['LockerDocument']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $lockerDocument['LockerDocument']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $lockerDocument['LockerDocument']['id'])); ?>
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
		<li><?php echo $html->link(__('New LockerDocument', true), array('action'=>'add')); ?></li>
	</ul>
</div>
