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
	<?php echo $html->link(__('current version',true),array(
		'controller'=>'entries',
		'action'=>'view',
		$revision['Entry']['slug'],
		'wiki_id' => $revision['Entry']['wiki_id']
		))?> 
	<?php echo $html->link(__('restore',true),array(
		'controller'=>'entries',
		'action'=>'restore',
		$revision['Revision']['entry_id'],
		$revision['Revision']['revision'],
		'wiki_id' => $revision['Entry']['wiki_id']
		))?> 
	</p>
	<div class="wiki-content">
		<?php echo $filter->filter($wiki->format($revision['Revision']['content'])); ?>
	</div>
</div>