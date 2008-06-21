<div class="controlMode">
<?php echo $form->create('ControlMode');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('ControlMode');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('sco_id');
		echo $form->input('choiceExit');
		echo $form->input('choice');
		echo $form->input('flow');
		echo $form->input('forwardOnly');
		echo $form->input('useCurrentAttemptObjectiveInfo');
		echo $form->input('useCurrentAttemptProgressInfo');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('ControlMode.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('ControlMode.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('ControlModes', true), array('action'=>'index'));?></li>
	</ul>
</div>