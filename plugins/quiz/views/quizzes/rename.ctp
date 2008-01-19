<div class="quiz">
<?php echo $form->create('Quiz');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Rename %s', true), __('Quiz', true));?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Rename');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Quizzes', true)), array('action'=>'index'));?></li>
	</ul>
</div>
