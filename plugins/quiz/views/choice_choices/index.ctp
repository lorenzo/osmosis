<div class="choiceChoices">
<h2><?php __('ChoiceChoices');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('choice_question_id');?></th>
	<th><?php echo $paginator->sort('text');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($choiceChoices as $choiceChoice):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $choiceChoice['ChoiceChoice']['id'] ?>
		</td>
		<td>
			<?php echo $html->link(__($choiceChoice['ChoiceQuestion']['id'], true), array('controller'=> 'choice_questions', 'action'=>'view', $choiceChoice['ChoiceQuestion']['id'])); ?>
		</td>
		<td>
			<?php echo $choiceChoice['ChoiceChoice']['text'] ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $choiceChoice['ChoiceChoice']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $choiceChoice['ChoiceChoice']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $choiceChoice['ChoiceChoice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $choiceChoice['ChoiceChoice']['id'])); ?>
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
		<li><?php echo $html->link(sprintf(__('New %s', true), __('ChoiceChoice', true)), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Choice Questions', true)), array('controller'=> 'choice_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s',  true), __('Choice Question', true)), array('controller'=> 'choice_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
