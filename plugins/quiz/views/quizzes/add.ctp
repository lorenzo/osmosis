<div class="quiz">
<?php echo $form->create('Quiz');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('Quiz', true));?></legend>
	<?php
		echo $form->input('name');
		/*echo $form->input('AssociationQuestion');
		echo $form->input('ChoiceQuestion');
		echo $form->input('ClozeQuestion');
		echo $form->input('MatchingQuestion');
		echo $form->input('OrderingQuestion');
		echo $form->input('TextQuestion');*/
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Quizzes', true)), array('action'=>'index'));?></li>
	</ul>
</div>
