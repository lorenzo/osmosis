<div class="choiceQuestions">
<h2><?php __('ChoiceQuestions');?></h2>
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
foreach ($choiceQuestions as $choiceQuestion):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $choiceQuestion['ChoiceQuestion']['id'] ?>
		</td>
		<td>
			<?php echo $choiceQuestion['ChoiceQuestion']['body'] ?>
		</td>
		<td>
			<?php echo $choiceQuestion['ChoiceQuestion']['shuffle'] ?>
		</td>
		<td>
			<?php echo $choiceQuestion['ChoiceQuestion']['max_choices'] ?>
		</td>
		<td>
			<?php echo $choiceQuestion['ChoiceQuestion']['min_choices'] ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $choiceQuestion['ChoiceQuestion']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $choiceQuestion['ChoiceQuestion']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $choiceQuestion['ChoiceQuestion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $choiceQuestion['ChoiceQuestion']['id'])); ?>
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
		<li><?php echo $html->link(sprintf(__('New %s', true), __('ChoiceQuestion', true)), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Choice Choices', true)), array('controller'=> 'choice_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s',  true), __('Choice Choice', true)), array('controller'=> 'choice_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
