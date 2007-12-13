<div class="associationChoice">
<?php echo $form->create('AssociationChoice');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('AssociationChoice', true));?></legend>
	<?php
		echo $form->input('association_question_id');
		echo $form->input('text');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('AssociationChoices', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Association Questions', true)), array('controller'=> 'association_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Association Question', true)), array('controller'=> 'association_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
