<?php $html->css('diff',null,null,false) ?>
<table class='diff'>
<col class='diff-marker' />
<col class='diff-content' />
<col class='diff-marker' />
<col class='diff-content' />
<tr>
	<td colspan='2' class='diff-otitle'>Old</td>
	<td colspan='2' class='diff-ntitle'>New</td>
</tr>
<?php echo $diff ?>
</table>