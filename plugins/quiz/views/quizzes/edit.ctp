<div class="quiz">
<?php echo $form->create('Quiz');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Edit %s %s', true), __('Quiz', true), $form->value('name'));?></legend>
	<?php
		echo $form->input('id');
		echo $form->input(
				'question_types',
				array(
					'type' => 'select',
					'label' => __('Add Question', true),
					'options' => $question_types, 'empty' => true
				)
		);
		/*echo $form->input('AssociationQuestion');
		echo $form->input('ChoiceQuestion');
		echo $form->input('ClozeQuestion');
		echo $form->input('MatchingQuestion');
		echo $form->input('OrderingQuestion');
		echo $form->input('TextQuestion');*/
	?>
	</fieldset>
<?php echo $form->end(__('Add Question', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Quiz.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Quiz.id'))); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Quizzes', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Association Questions', true)), array('controller'=> 'association_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Association Question', true)), array('controller'=> 'association_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
