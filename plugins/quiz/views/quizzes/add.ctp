<div class="quiz">
<?php echo $form->create('Quiz');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('Quiz', true));?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Quizzes', true)), array('action'=>'index'));?></li>
	</ul>
</div>
