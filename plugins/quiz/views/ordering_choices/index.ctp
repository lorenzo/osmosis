<div class="orderingChoices">
<h2><?php __('OrderingChoices');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('ordering_question_id');?></th>
	<th><?php echo $paginator->sort('text');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($orderingChoices as $orderingChoice):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $orderingChoice['OrderingChoice']['id'] ?>
		</td>
		<td>
			<?php echo $html->link(__($orderingChoice['OrderingQuestion']['id'], true), array('controller'=> 'ordering_questions', 'action'=>'view', $orderingChoice['OrderingQuestion']['id'])); ?>
		</td>
		<td>
			<?php echo $orderingChoice['OrderingChoice']['text'] ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $orderingChoice['OrderingChoice']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $orderingChoice['OrderingChoice']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $orderingChoice['OrderingChoice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orderingChoice['OrderingChoice']['id'])); ?>
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
		<li><?php echo $html->link(sprintf(__('New %s', true), __('OrderingChoice', true)), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Ordering Questions', true)), array('controller'=> 'ordering_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s',  true), __('Ordering Question', true)), array('controller'=> 'ordering_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
