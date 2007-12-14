<div class="revisions view">
	<h1><?php echo $revision['Revision']['title']?></h1>
	<p>
		<?php echo sprintf(__('Revision as of %s, modified by %s',true),
			$time->format('H:i, d M Y',$revision['Revision']['created']),
			$revision['Member']['username']
		); 
		?>
	</p>
	<p>
	<?php echo $html->link(__('current version',true),array('controller'=>'entries','action'=>'view',$revision['Revision']['entry_id']))?> 
	<?php echo $html->link(__('restore',true),array('controller'=>'entries','action'=>'restore',$revision['Revision']['entry_id'],$revision['Revision']['revision']))?> 
	</p>
	<div class="wiki-content">
		<?php echo $wiki->format($revision['Revision']['content']); ?>
	</div>
</div>