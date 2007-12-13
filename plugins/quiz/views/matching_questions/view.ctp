<div class="matchingQuestion">
<h2><?php  __('MatchingQuestion');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $matchingQuestion['MatchingQuestion']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Body') ?></dt>
		<dd>
			<?php echo $matchingQuestion['MatchingQuestion']['body'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Shuffle') ?></dt>
		<dd class="altrow">
			<?php echo $matchingQuestion['MatchingQuestion']['shuffle'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Max Associations') ?></dt>
		<dd>
			<?php echo $matchingQuestion['MatchingQuestion']['max_associations'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Min Associations') ?></dt>
		<dd class="altrow">
			<?php echo $matchingQuestion['MatchingQuestion']['min_associations'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('MatchingQuestion', true)), array('action'=>'edit', $matchingQuestion['MatchingQuestion']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('MatchingQuestion', true)), array('action'=>'delete', $matchingQuestion['MatchingQuestion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $matchingQuestion['MatchingQuestion']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('MatchingQuestions', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('MatchingQuestion', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Matching Choices', true)), array('controller'=> 'matching_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Matching Choice', true)), array('controller'=> 'matching_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Matching Choices', true));?></h3>
	<?php if (!empty($matchingQuestion['MatchingChoice'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Matching Question Id') ?></th>
		<th><?php __('Text') ?></th>
		<th><?php __('Source') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($matchingQuestion['MatchingChoice'] as $matchingChoice):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $matchingChoice['id'];?></td>
			<td><?php echo $matchingChoice['matching_question_id'];?></td>
			<td><?php echo $matchingChoice['text'];?></td>
			<td><?php echo $matchingChoice['source'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'matching_choices', 'action'=>'view', $matchingChoice['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'matching_choices', 'action'=>'edit', $matchingChoice['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'matching_choices', 'action'=>'delete', $matchingChoice['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $matchingChoice['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(sprintf(__('New %s', true), __('Matching Choice', true)), array('controller'=> 'matching_choices', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Quizzes', true));?></h3>
	<?php if (!empty($matchingQuestion['Quiz'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Name') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($matchingQuestion['Quiz'] as $quiz):
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
