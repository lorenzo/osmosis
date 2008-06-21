<div class="rollupConsideration">
<?php echo $form->create('RollupConsideration');?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('RollupConsideration');?></legend>
	<?php
		echo $form->input('sco_id');
		echo $form->input('requiredForSatisfied');
		echo $form->input('requiredForNotSatisfied');
		echo $form->input('requiredForComplete');
		echo $form->input('requiredForIncomplete');
		echo $form->input('measureSatisfactionIfActive');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true).' '.__('RollupConsiderations', true), array('action'=>'index'));?></li>
	</ul>
</div>