<div class="objective">
<?php echo $form->create('Objective');?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('Objective');?></legend>
	<?php
		echo $form->input('sco_id');
		echo $form->input('satisfiedByMeasure');
		echo $form->input('minNormalizedMeasure');
		echo $form->input('objectiveID');
		echo $form->input('primary');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true).' '.__('Objectives', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Map Infos', true), array('controller'=> 'map_infos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Map Info', true), array('controller'=> 'map_infos', 'action'=>'add')); ?> </li>
	</ul>
</div>