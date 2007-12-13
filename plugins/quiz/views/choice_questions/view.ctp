<div class="choiceQuestion">
<h2><?php  __('ChoiceQuestion');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $choiceQuestion['ChoiceQuestion']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Body') ?></dt>
		<dd>
			<?php echo $choiceQuestion['ChoiceQuestion']['body'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Shuffle') ?></dt>
		<dd class="altrow">
			<?php echo $choiceQuestion['ChoiceQuestion']['shuffle'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Max Choices') ?></dt>
		<dd>
			<?php echo $choiceQuestion['ChoiceQuestion']['max_choices'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Min Choices') ?></dt>
		<dd class="altrow">
			<?php echo $choiceQuestion['ChoiceQuestion']['min_choices'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('ChoiceQuestion', true)), array('action'=>'edit', $choiceQuestion['ChoiceQuestion']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('ChoiceQuestion', true)), array('action'=>'delete', $choiceQuestion['ChoiceQuestion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $choiceQuestion['ChoiceQuestion']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('ChoiceQuestions', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('ChoiceQuestion', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Choice Choices', true)), array('controller'=> 'choice_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Choice Choice', true)), array('controller'=> 'choice_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Choice Choices', true));?></h3>
	<?php if (!empty($choiceQuestion['ChoiceChoice'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Choice Question Id') ?></th>
		<th><?php __('Text') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($choiceQuestion['ChoiceChoice'] as $choiceChoice):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $choiceChoice['id'];?></td>
			<td><?php echo $choiceChoice['choice_question_id'];?></td>
			<td><?php echo $choiceChoice['text'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'choice_choices', 'action'=>'view', $choiceChoice['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'choice_choices', 'action'=>'edit', $choiceChoice['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'choice_choices', 'action'=>'delete', $choiceChoice['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $choiceChoice['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(sprintf(__('New %s', true), __('Choice Choice', true)), array('controller'=> 'choice_choices', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Quizzes', true));?></h3>
	<?php if (!empty($choiceQuestion['Quiz'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Name') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($choiceQuestion['Quiz'] as $quiz):
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
