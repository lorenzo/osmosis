<div class="randomization">
<?php echo $form->create('Randomization');?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('Randomization');?></legend>
	<?php
		echo $form->input('sco_id');
		echo $form->input('randomizationTiming');
		echo $form->input('selectCount');
		echo $form->input('reorderChildren');
		echo $form->input('selectionTiming');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true).' '.__('Randomizations', true), array('action'=>'index'));?></li>
	</ul>
</div>