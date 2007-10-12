<div class="scoPresentation">
<?php echo $form->create('ScoPresentation');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('ScoPresentation');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('hideKey');
		echo $form->input('sco_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('ScoPresentation.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('ScoPresentation.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('ScoPresentations', true), array('action'=>'index'));?></li>
	</ul>
</div>