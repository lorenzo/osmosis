<div class="matchingQuestion">
<?php echo $form->create('MatchingQuestion');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Edit %s', true), __('MatchingQuestion', true));?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('body');
		echo $form->input('shuffle');
		echo $form->input('max_associations');
		echo $form->input('min_associations');
		 echo $form->input('Quiz');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('MatchingQuestion.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('MatchingQuestion.id'))); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('MatchingQuestions', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Matching Choices', true)), array('controller'=> 'matching_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Matching Choice', true)), array('controller'=> 'matching_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
