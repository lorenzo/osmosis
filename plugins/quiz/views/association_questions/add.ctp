<div class="associationQuestion">
<?php echo $form->create('AssociationQuestion');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('AssociationQuestion', true));?></legend>
	<?php
		echo $form->input('body');
		echo $form->input('shuffle');
		echo $form->input('max_associations');
		echo $form->input('min_associations');
		echo $form->hidden('Quiz.Quiz][', array('value' => 'jdojo'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('AssociationQuestions', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Association Choices', true)), array('controller'=> 'association_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Association Choice', true)), array('controller'=> 'association_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
