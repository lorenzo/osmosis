<div class="choiceChoice">
<?php echo $form->create('ChoiceChoice');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('ChoiceChoice', true));?></legend>
	<?php
		echo $form->input('choice_question_id');
		echo $form->input('text');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('ChoiceChoices', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Choice Questions', true)), array('controller'=> 'choice_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Choice Question', true)), array('controller'=> 'choice_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
