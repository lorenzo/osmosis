<div class="associationQuestion">
<?php echo $form->create('AssociationQuestion');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Edit %s', true), __('AssociationQuestion', true));?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('body');
		echo $form->input('shuffle');
		echo $form->input('max_associations');
		echo $form->input('min_associations');
		 echo $form->input('Quiz');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('AssociationQuestion.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('AssociationQuestion.id'))); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('AssociationQuestions', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Association Choices', true)), array('controller'=> 'association_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Association Choice', true)), array('controller'=> 'association_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
