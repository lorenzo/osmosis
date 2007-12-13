<div class="choiceChoice">
<h2><?php  __('ChoiceChoice');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $choiceChoice['ChoiceChoice']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('ChoiceQuestion') ?></dt>
		<dd>
			<?php echo $html->link(__($choiceChoice['ChoiceQuestion']['id'], true), array('controller'=> 'choice_questions', 'action'=>'view', $choiceChoice['ChoiceQuestion']['id'])); ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Text') ?></dt>
		<dd class="altrow">
			<?php echo $choiceChoice['ChoiceChoice']['text'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('ChoiceChoice', true)), array('action'=>'edit', $choiceChoice['ChoiceChoice']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('ChoiceChoice', true)), array('action'=>'delete', $choiceChoice['ChoiceChoice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $choiceChoice['ChoiceChoice']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('ChoiceChoices', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('ChoiceChoice', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Choice Questions', true)), array('controller'=> 'choice_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Choice Question', true)), array('controller'=> 'choice_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
