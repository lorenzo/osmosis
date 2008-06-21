<div class="scoPresentation">
<?php echo $form->create('ScoPresentation');?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('ScoPresentation');?></legend>
	<?php
		echo $form->input('hideKey');
		echo $form->input('sco_id');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true).' '.__('ScoPresentations', true), array('action'=>'index'));?></li>
	</ul>
</div>