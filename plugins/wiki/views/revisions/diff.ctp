<?php $html->css('diff',null,null,false) ?>
<div class="revisions diff">
<h1><?php echo $entry['Entry']['title']?></h1>

<?php echo $diff ?>
<h2><?php echo sprintf(__('Revision as of %s, modified by %s',true),
	$time->format('H:i, d M Y',$revision['Revision']['created']),
	$revision['Member']['username']
); 
?></h2>
<div class="wiki-content">
	<?php echo $wiki->format($revision['Revision']['content']); ?>
</div>
</div>