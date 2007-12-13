<div class="associationQuestion">
<h2><?php  __('AssociationQuestion');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $associationQuestion['AssociationQuestion']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Body') ?></dt>
		<dd>
			<?php echo $associationQuestion['AssociationQuestion']['body'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Shuffle') ?></dt>
		<dd class="altrow">
			<?php echo $associationQuestion['AssociationQuestion']['shuffle'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Max Associations') ?></dt>
		<dd>
			<?php echo $associationQuestion['AssociationQuestion']['max_associations'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Min Associations') ?></dt>
		<dd class="altrow">
			<?php echo $associationQuestion['AssociationQuestion']['min_associations'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('AssociationQuestion', true)), array('action'=>'edit', $associationQuestion['AssociationQuestion']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('AssociationQuestion', true)), array('action'=>'delete', $associationQuestion['AssociationQuestion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $associationQuestion['AssociationQuestion']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('AssociationQuestions', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('AssociationQuestion', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Association Choices', true)), array('controller'=> 'association_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Association Choice', true)), array('controller'=> 'association_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Association Choices', true));?></h3>
	<?php if (!empty($associationQuestion['AssociationChoice'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Association Question Id') ?></th>
		<th><?php __('Text') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($associationQuestion['AssociationChoice'] as $associationChoice):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $associationChoice['id'];?></td>
			<td><?php echo $associationChoice['association_question_id'];?></td>
			<td><?php echo $associationChoice['text'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'association_choices', 'action'=>'view', $associationChoice['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'association_choices', 'action'=>'edit', $associationChoice['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'association_choices', 'action'=>'delete', $associationChoice['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $associationChoice['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(sprintf(__('New %s', true), __('Association Choice', true)), array('controller'=> 'association_choices', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Quizzes', true));?></h3>
	<?php if (!empty($associationQuestion['Quiz'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Name') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($associationQuestion['Quiz'] as $quiz):
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
