<div class="entries index">
<h2><?php __('Entries');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('wiki_id');?></th>
	<th><?php echo $paginator->sort('member_id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('revision');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($entries as $entry):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $entry['Entry']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($entry['Wiki']['name'], array('controller'=> 'wikis', 'action'=>'view', $entry['Wiki']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($entry['Member']['id'], array('controller'=> 'members', 'action'=>'view', $entry['Member']['id'])); ?>
		</td>
		<td>
			<?php echo $entry['Entry']['title']; ?>
		</td>
		<td>
			<?php echo $entry['Entry']['revision']; ?>
		</td>
		<td>
			<?php echo $entry['Entry']['created']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $entry['Entry']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $entry['Entry']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $entry['Entry']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $entry['Entry']['id'])); ?>
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
