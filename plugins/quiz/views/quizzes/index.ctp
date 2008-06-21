<div class="quizzes">
<h2><?php __('Quizzes');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('name');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($quizzes as $quiz):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $quiz['Quiz']['name'] ?>
			<?php echo $html->link(__('Change name', true), array('action'=>'rename', $quiz['Quiz']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $quiz['Quiz']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $quiz['Quiz']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $quiz['Quiz']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $quiz['Quiz']['id'])); ?>
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
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Quiz', true)), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Association Questions', true)), array('controller'=> 'association_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s',  true), __('Association Question', true)), array('controller'=> 'association_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
