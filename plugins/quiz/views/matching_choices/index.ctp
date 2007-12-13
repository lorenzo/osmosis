<div class="matchingChoices">
<h2><?php __('MatchingChoices');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('matching_question_id');?></th>
	<th><?php echo $paginator->sort('text');?></th>
	<th><?php echo $paginator->sort('source');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($matchingChoices as $matchingChoice):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $matchingChoice['MatchingChoice']['id'] ?>
		</td>
		<td>
			<?php echo $html->link(__($matchingChoice['MatchingQuestion']['id'], true), array('controller'=> 'matching_questions', 'action'=>'view', $matchingChoice['MatchingQuestion']['id'])); ?>
		</td>
		<td>
			<?php echo $matchingChoice['MatchingChoice']['text'] ?>
		</td>
		<td>
			<?php echo $matchingChoice['MatchingChoice']['source'] ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $matchingChoice['MatchingChoice']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $matchingChoice['MatchingChoice']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $matchingChoice['MatchingChoice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $matchingChoice['MatchingChoice']['id'])); ?>
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
		<li><?php echo $html->link(sprintf(__('New %s', true), __('MatchingChoice', true)), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Matching Questions', true)), array('controller'=> 'matching_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s',  true), __('Matching Question', true)), array('controller'=> 'matching_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
