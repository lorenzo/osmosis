<div class="clozeQuestions">
<h2><?php __('ClozeQuestions');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('body');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($clozeQuestions as $clozeQuestion):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $clozeQuestion['ClozeQuestion']['id'] ?>
		</td>
		<td>
			<?php echo $clozeQuestion['ClozeQuestion']['title'] ?>
		</td>
		<td>
			<?php echo $clozeQuestion['ClozeQuestion']['body'] ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $clozeQuestion['ClozeQuestion']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $clozeQuestion['ClozeQuestion']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $clozeQuestion['ClozeQuestion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $clozeQuestion['ClozeQuestion']['id'])); ?>
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
		<li><?php echo $html->link(sprintf(__('New %s', true), __('ClozeQuestion', true)), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Quizzes', true)), array('controller'=> 'quizzes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s',  true), __('Quiz', true)), array('controller'=> 'quizzes', 'action'=>'add')); ?> </li>
	</ul>
</div>
