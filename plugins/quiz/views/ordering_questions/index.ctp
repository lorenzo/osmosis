<div class="orderingQuestions">
<h2><?php __('OrderingQuestions');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('body');?></th>
	<th><?php echo $paginator->sort('shuffle');?></th>
	<th><?php echo $paginator->sort('max_choices');?></th>
	<th><?php echo $paginator->sort('min_choices');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($orderingQuestions as $orderingQuestion):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $orderingQuestion['OrderingQuestion']['id'] ?>
		</td>
		<td>
			<?php echo $orderingQuestion['OrderingQuestion']['body'] ?>
		</td>
		<td>
			<?php echo $orderingQuestion['OrderingQuestion']['shuffle'] ?>
		</td>
		<td>
			<?php echo $orderingQuestion['OrderingQuestion']['max_choices'] ?>
		</td>
		<td>
			<?php echo $orderingQuestion['OrderingQuestion']['min_choices'] ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $orderingQuestion['OrderingQuestion']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $orderingQuestion['OrderingQuestion']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $orderingQuestion['OrderingQuestion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orderingQuestion['OrderingQuestion']['id'])); ?>
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
		<li><?php echo $html->link(sprintf(__('New %s', true), __('OrderingQuestion', true)), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Ordering Choices', true)), array('controller'=> 'ordering_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s',  true), __('Ordering Choice', true)), array('controller'=> 'ordering_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
