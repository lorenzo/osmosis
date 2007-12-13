<div class="matchingChoice">
<?php echo $form->create('MatchingChoice');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Edit %s', true), __('MatchingChoice', true));?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('matching_question_id');
		echo $form->input('text');
		echo $form->input('source');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('MatchingChoice.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('MatchingChoice.id'))); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('MatchingChoices', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Matching Questions', true)), array('controller'=> 'matching_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Matching Question', true)), array('controller'=> 'matching_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
