<div class="documents index">
<h2><?php __('Documents');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('locker_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($documents as $document):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $document['Document']['id']; ?>
		</td>
		<td>
			<?php echo $document['Document']['description']; ?>
		</td>
		<td>
			<?php echo $html->link($document['Locker']['id'], array('controller'=> 'lockers', 'action'=>'view', $document['Locker']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $document['Document']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $document['Document']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $document['Document']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $document['Document']['id'])); ?>
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
		<li><?php echo $html->link(__('New Document', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Lockers', true), array('controller'=> 'lockers', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Locker', true), array('controller'=> 'lockers', 'action'=>'add')); ?> </li>
	</ul>
</div>
