<?php $html->css('diff',null,null,false) ?>
<div class="revisions diff">
<h1><?php echo $entry['Entry']['title']?></h1>
<table class='diff'>
<col class='diff-marker' />
<col class='diff-content' />
<col class='diff-marker' />
<col class='diff-content' />
<tr>
	<td colspan='2' class='diff-otitle'>
	<?php echo sprintf(__('Revision as of %s, modified by %s',true),
		$time->format('H:i, d M Y',$revision['Revision']['created']),
		$revision['Member']['username']
	); 
	?>
	</td>
	<td colspan='2' class='diff-ntitle'>
		<?php echo sprintf(__('Current revision (%s), last modified by %s',true),
			$time->format('H:i, d M Y',$entry['Entry']['updated']),
			$entry['Member']['username']
		); 
		?>
	</td>
</tr>
<?php echo $diff ?>
</table>

<h2><?php echo sprintf(__('Revision as of %s, modified by %s',true),
	$time->format('H:i, d M Y',$revision['Revision']['created']),
	$revision['Member']['username']
); 
?></h2>
<div class="wiki-content">
	<?php echo $wiki->format($revision['Revision']['content']); ?>
</div>
</div>