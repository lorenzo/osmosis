<div class="quiz">
<h2><?php  __('Quiz');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $quiz['Quiz']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Name') ?></dt>
		<dd>
			<?php echo $quiz['Quiz']['name'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('Quiz', true)), array('action'=>'edit', $quiz['Quiz']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('Quiz', true)), array('action'=>'delete', $quiz['Quiz']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $quiz['Quiz']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Quizzes', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Quiz', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Association Questions', true)), array('controller'=> 'association_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Association Question', true)), array('controller'=> 'association_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Association Questions', true));?></h3>
	<?php if (!empty($quiz['AssociationQuestion'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Body') ?></th>
		<th><?php __('Shuffle') ?></th>
		<th><?php __('Max Associations') ?></th>
		<th><?php __('Min Associations') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($quiz['AssociationQuestion'] as $associationQuestion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $associationQuestion['id'];?></td>
			<td><?php echo $associationQuestion['body'];?></td>
			<td><?php echo $associationQuestion['shuffle'];?></td>
			<td><?php echo $associationQuestion['max_associations'];?></td>
			<td><?php echo $associationQuestion['min_associations'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'association_questions', 'action'=>'view', $associationQuestion['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'association_questions', 'action'=>'edit', $associationQuestion['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'association_questions', 'action'=>'delete', $associationQuestion['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $associationQuestion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(sprintf(__('New %s', true), __('Association Question', true)), array('controller'=> 'association_questions', 'action'=>'add', 'quiz' => $quiz['Quiz']['id']));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Choice Questions', true));?></h3>
	<?php if (!empty($quiz['ChoiceQuestion'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Body') ?></th>
		<th><?php __('Shuffle') ?></th>
		<th><?php __('Max Choices') ?></th>
		<th><?php __('Min Choices') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($quiz['ChoiceQuestion'] as $choiceQuestion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $choiceQuestion['id'];?></td>
			<td><?php echo $choiceQuestion['body'];?></td>
			<td><?php echo $choiceQuestion['shuffle'];?></td>
			<td><?php echo $choiceQuestion['max_choices'];?></td>
			<td><?php echo $choiceQuestion['min_choices'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'choice_questions', 'action'=>'view', $choiceQuestion['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'choice_questions', 'action'=>'edit', $choiceQuestion['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'choice_questions', 'action'=>'delete', $choiceQuestion['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $choiceQuestion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(sprintf(__('New %s', true), __('Choice Question', true)), array('controller'=> 'choice_questions', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Cloze Questions', true));?></h3>
	<?php if (!empty($quiz['ClozeQuestion'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Title') ?></th>
		<th><?php __('Body') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($quiz['ClozeQuestion'] as $clozeQuestion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $clozeQuestion['id'];?></td>
			<td><?php echo $clozeQuestion['title'];?></td>
			<td><?php echo $clozeQuestion['body'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'cloze_questions', 'action'=>'view', $clozeQuestion['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'cloze_questions', 'action'=>'edit', $clozeQuestion['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'cloze_questions', 'action'=>'delete', $clozeQuestion['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $clozeQuestion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(sprintf(__('New %s', true), __('Cloze Question', true)), array('controller'=> 'cloze_questions', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Matching Questions', true));?></h3>
	<?php if (!empty($quiz['MatchingQuestion'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Body') ?></th>
		<th><?php __('Shuffle') ?></th>
		<th><?php __('Max Associations') ?></th>
		<th><?php __('Min Associations') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($quiz['MatchingQuestion'] as $matchingQuestion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $matchingQuestion['id'];?></td>
			<td><?php echo $matchingQuestion['body'];?></td>
			<td><?php echo $matchingQuestion['shuffle'];?></td>
			<td><?php echo $matchingQuestion['max_associations'];?></td>
			<td><?php echo $matchingQuestion['min_associations'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'matching_questions', 'action'=>'view', $matchingQuestion['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'matching_questions', 'action'=>'edit', $matchingQuestion['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'matching_questions', 'action'=>'delete', $matchingQuestion['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $matchingQuestion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(sprintf(__('New %s', true), __('Matching Question', true)), array('controller'=> 'matching_questions', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<?php if (!empty($quiz['OrderingQuestion'])):?>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Ordering Questions', true));?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Body') ?></th>
		<th><?php __('Shuffle') ?></th>
		<th><?php __('Max Choices') ?></th>
		<th><?php __('Min Choices') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($quiz['OrderingQuestion'] as $orderingQuestion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $orderingQuestion['id'];?></td>
			<td><?php echo $orderingQuestion['body'];?></td>
			<td><?php echo $orderingQuestion['shuffle'];?></td>
			<td><?php echo $orderingQuestion['max_choices'];?></td>
			<td><?php echo $orderingQuestion['min_choices'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'ordering_questions', 'action'=>'view', $orderingQuestion['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'ordering_questions', 'action'=>'edit', $orderingQuestion['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'ordering_questions', 'action'=>'delete', $orderingQuestion['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orderingQuestion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(sprintf(__('New %s', true), __('Ordering Question', true)), array('controller'=> 'ordering_questions', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<?php endif; ?>

<?php if (!empty($quiz['TextQuestion'])):?>
<div class="related">
	<h3><?php echo __('Text Questions', true);?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Title') ?></th>
		<th><?php __('Body') ?></th>
		<th><?php __('Format') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($quiz['TextQuestion'] as $textQuestion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $textQuestion['id'];?></td>
			<td><?php echo $textQuestion['title'];?></td>
			<td><?php echo $textQuestion['body'];?></td>
			<td><?php echo $textQuestion['format'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'text_questions', 'action'=>'view', $textQuestion['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'text_questions', 'action'=>'edit', $textQuestion['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'text_questions', 'action'=>'delete', $textQuestion['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $textQuestion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(sprintf(__('New %s', true), __('Text Question', true)), array('controller'=> 'text_questions', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<?php endif; ?>
