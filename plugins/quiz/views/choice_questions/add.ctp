<div class="choiceQuestion">
<?php echo $form->create('ChoiceQuestion');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('Choice Question', true));?></legend>
	<?php
		echo $form->input('body');
	?>
	<fieldset>
		<legend><?php echo sprintf(__('Add %s', true), __('Choices', true));?></legend>		
		<?php for ($i=0;$i<$totalChoices;$i++) :?>
		<?php echo $form->input('ChoiceChoice.'.$i.'.text'); ?>
		<?php echo $form->input('ChoiceChoice.'.$i.'.position', array('label' => __('Fixed position number:',true))); ?>
		<?php endfor;?>
		
		<?php echo $form->submit(__('Add New Choice',true),array('name' => 'data[UI][addChoice]','value' => 1)); ?>
	</fieldset>
	<?php
		echo $form->input('shuffle');
		echo $form->input('max_choices');
		echo $form->input('min_choices');
		echo $form->input('Quiz.id',array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $form->end(__('Create Question',true));?>
</div>
