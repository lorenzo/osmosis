<div class="choiceQuestion">
<?php echo $form->create('ChoiceQuestion');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Edit %s', true), __('ChoiceQuestion', true));?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('body', array('label' => __('body', true)));
		echo $form->input('shuffle', array('label' => __('shuffle', true)));
		echo $form->input('max_choices', array('label' => __('max_choices', true)));
		echo $form->input('min_choices', array('label' => __('min_choices', true)));
		 echo $form->input('Quiz', array('label' => __('Quiz', true)));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('ChoiceQuestion.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('ChoiceQuestion.id'))); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('ChoiceQuestions', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Choice Choices', true)), array('controller'=> 'choice_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Choice Choice', true)), array('controller'=> 'choice_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
