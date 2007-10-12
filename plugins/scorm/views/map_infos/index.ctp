<div class="mapInfos">
<h2><?php __('MapInfos');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>

Warning: Invalid argument supplied for foreach() in /home/joaquin/sitios/cake1.2.x/cake/console/libs/templates/views/index.ctp on line 31
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($mapInfos as $mapInfo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>

Warning: Invalid argument supplied for foreach() in /home/joaquin/sitios/cake1.2.x/cake/console/libs/templates/views/index.ctp on line 47
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $mapInfo['MapInfo'][''])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $mapInfo['MapInfo'][''])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $mapInfo['MapInfo']['']), null, __('Are you sure you want to delete', true).' #' . $mapInfo['MapInfo']['']); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New', true).' '.__('MapInfo', true), array('action'=>'add')); ?></li>

Warning: Invalid argument supplied for foreach() in /home/joaquin/sitios/cake1.2.x/cake/console/libs/templates/views/index.ctp on line 86
	</ul>
</div>