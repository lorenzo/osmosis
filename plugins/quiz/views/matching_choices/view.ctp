<div class="matchingChoice">
<h2><?php  __('MatchingChoice');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $matchingChoice['MatchingChoice']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('MatchingQuestion') ?></dt>
		<dd>
			<?php echo $html->link(__($matchingChoice['MatchingQuestion']['id'], true), array('controller'=> 'matching_questions', 'action'=>'view', $matchingChoice['MatchingQuestion']['id'])); ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Text') ?></dt>
		<dd class="altrow">
			<?php echo $matchingChoice['MatchingChoice']['text'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Source') ?></dt>
		<dd>
			<?php echo $matchingChoice['MatchingChoice']['source'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('MatchingChoice', true)), array('action'=>'edit', $matchingChoice['MatchingChoice']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('MatchingChoice', true)), array('action'=>'delete', $matchingChoice['MatchingChoice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $matchingChoice['MatchingChoice']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('MatchingChoices', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('MatchingChoice', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Matching Questions', true)), array('controller'=> 'matching_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Matching Question', true)), array('controller'=> 'matching_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
