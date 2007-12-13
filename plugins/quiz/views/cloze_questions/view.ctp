<div class="clozeQuestion">
<h2><?php  __('ClozeQuestion');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $clozeQuestion['ClozeQuestion']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Title') ?></dt>
		<dd>
			<?php echo $clozeQuestion['ClozeQuestion']['title'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Body') ?></dt>
		<dd class="altrow">
			<?php echo $clozeQuestion['ClozeQuestion']['body'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('ClozeQuestion', true)), array('action'=>'edit', $clozeQuestion['ClozeQuestion']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('ClozeQuestion', true)), array('action'=>'delete', $clozeQuestion['ClozeQuestion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $clozeQuestion['ClozeQuestion']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('ClozeQuestions', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('ClozeQuestion', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Quizzes', true)), array('controller'=> 'quizzes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Quiz', true)), array('controller'=> 'quizzes', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo sprintf(__('Related %s', true), __('Quizzes', true));?></h3>
	<?php if (!empty($clozeQuestion['Quiz'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id') ?></th>
		<th><?php __('Name') ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($clozeQuestion['Quiz'] as $quiz):
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
