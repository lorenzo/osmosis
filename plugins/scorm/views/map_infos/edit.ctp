<div class="mapInfo">
<?php echo $form->create('MapInfo');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('MapInfo');?></legend>
	<?php

Warning: Invalid argument supplied for foreach() in /home/joaquin/sitios/cake1.2.x/cake/console/libs/templates/views/form.ctp on line 33

Warning: Invalid argument supplied for foreach() in /home/joaquin/sitios/cake1.2.x/cake/console/libs/templates/views/form.ctp on line 40
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('MapInfo.')), null, __('Are you sure you want to delete', true).' #' . $form->value('MapInfo.')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('MapInfos', true), array('action'=>'index'));?></li>

Warning: Invalid argument supplied for foreach() in /home/joaquin/sitios/cake1.2.x/cake/console/libs/templates/views/form.ctp on line 57
	</ul>
</div>