<div class="orderingQuestion">
<h2><?php  __('OrderingQuestion');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $orderingQuestion['OrderingQuestion']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Body') ?></dt>
		<dd>
			<?php echo $orderingQuestion['OrderingQuestion']['body'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Shuffle') ?></dt>
		<dd class="altrow">
			<?php echo $orderingQuestion['OrderingQuestion']['shuffle'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Max Choices') ?></dt>
		<dd>
			<?php echo $orderingQuestion['OrderingQuestion']['max_choices'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Min Choices') ?></dt>
		<dd class="altrow">
			<?php echo $orderingQuestion['OrderingQuestion']['min_choices'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('OrderingQuestion', true)), array('action'=>'edit', $orderingQuestion['OrderingQuestion']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('OrderingQuestion', true)), array('action'=>'delete', $orderingQuestion['OrderingQuestion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orderingQuestion['OrderingQuestion']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('OrderingQuestions', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('OrderingQuestion', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Ordering Choices', true)), array('controller'=> 'ordering_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Ordering Choice', true)), array('controller'=> 'ordering_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Ordering Choices', true));?></h3>
	<?php if (!empty($orderingQuestion['OrderingChoice'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Ordering Question Id') ?></th>
		<th><?php __('Text') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($orderingQuestion['OrderingChoice'] as $orderingChoice):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $orderingChoice['id'];?></td>
			<td><?php echo $orderingChoice['ordering_question_id'];?></td>
			<td><?php echo $orderingChoice['text'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'ordering_choices', 'action'=>'view', $orderingChoice['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'ordering_choices', 'action'=>'edit', $orderingChoice['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'ordering_choices', 'action'=>'delete', $orderingChoice['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orderingChoice['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(sprintf(__('New %s', true), __('Ordering Choice', true)), array('controller'=> 'ordering_choices', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Quizzes', true));?></h3>
	<?php if (!empty($orderingQuestion['Quiz'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Name') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($orderingQuestion['Quiz'] as $quiz):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $quiz['id'];?></td>
			<td><?php echo $quiz['name'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'quizzes', 'action'=>'view', $quiz['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'quizzes', 'action'=>'edit', $quiz['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'quizzes', 'action'=>'delete', $quiz['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $quiz['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(sprintf(__('New %s', true), __('Quiz', true)), array('controller'=> 'quizzes', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
