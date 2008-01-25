<div class="revisions history">
<h2><?php echo sprintf(__('Revision history of %s',true),'"'.$entry['Entry']['title'].'"');?></h2>
<ul>
<?php
$i = 0;
foreach ($revisions as $revision):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class ?>>
	<span class="note"><?php echo __('Revision', true) . ' ' . $revision['Revision']['revision']?> &mdash; </span>
	<?php
		echo $html->link(
			$time->format('H:i, d M Y',$revision['Revision']['created']),
			array('action'=>'view',$revision['Revision']['id'])
		);
	?> &mdash; 
	<?php echo $revision['Member']['username']?> 
	(<?php echo $html->link(__('restore',true),array('controller'=>'entries','action'=>'restore',$entry['Entry']['id'],$revision['Revision']['revision']))?>) 
	(<?php echo $html->link(__('compare',true),array('action'=>'diff',$entry['Entry']['id'],$revision['Revision']['id']))?>)
	</li>
<?php endforeach; ?>
</ul>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
