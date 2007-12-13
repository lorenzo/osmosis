<div class="orderingQuestion">
<?php echo $form->create('OrderingQuestion');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Edit %s', true), __('OrderingQuestion', true));?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('body');
		echo $form->input('shuffle');
		echo $form->input('max_choices');
		echo $form->input('min_choices');
		 echo $form->input('Quiz');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('OrderingQuestion.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('OrderingQuestion.id'))); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('OrderingQuestions', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Ordering Choices', true)), array('controller'=> 'ordering_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Ordering Choice', true)), array('controller'=> 'ordering_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
