<div class="matchingQuestions">
<h2><?php __('MatchingQuestions');?></h2>
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
	<th><?php echo $paginator->sort('max_associations');?></th>
	<th><?php echo $paginator->sort('min_associations');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($matchingQuestions as $matchingQuestion):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $matchingQuestion['MatchingQuestion']['id'] ?>
		</td>
		<td>
			<?php echo $matchingQuestion['MatchingQuestion']['body'] ?>
		</td>
		<td>
			<?php echo $matchingQuestion['MatchingQuestion']['shuffle'] ?>
		</td>
		<td>
			<?php echo $matchingQuestion['MatchingQuestion']['max_associations'] ?>
		</td>
		<td>
			<?php echo $matchingQuestion['MatchingQuestion']['min_associations'] ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $matchingQuestion['MatchingQuestion']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $matchingQuestion['MatchingQuestion']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $matchingQuestion['MatchingQuestion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $matchingQuestion['MatchingQuestion']['id'])); ?>
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
		<li><?php echo $html->link(sprintf(__('New %s', true), __('MatchingQuestion', true)), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Matching Choices', true)), array('controller'=> 'matching_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s',  true), __('Matching Choice', true)), array('controller'=> 'matching_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
