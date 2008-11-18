<ul class="reverse actions">
	<li class="add">
		<?php
			echo $html->link(
				__d('agenda','Create a new Event', true),
				array('controller' => 'events', 'action' => 'add', 'course_id' => $course['Course']['id'])
			);
		?>
	</li>
</ul>
<div class='_calendar'>
<?php
	$firstdate = mktime(0, 0, 0, $data['month'], 1, $data['year']);
	$lastdate = mktime(0, 0, 0, $data['month']+1, 0, $data['year']); 
	$firstday = date('N',$firstdate);
	$next = 1;
?>

<table class="calendar" cellspacing="0">
<?php echo $html->tableHeaders(array(__d('agenda','Mon',true),__('Tue',true),__('Wed',true),__('Thu',true),__('Fri',true),__('Sat',true),__('Sun',true)));?>

<?php /*** WEEK ONE ***/ ?>
<tr>
<?php for ($i=1; $i<=7; $i++) : ?>
<?php if ($next<=1 && $firstday != $i) : ?>
<td>&nbsp;</td>
<?php else: ?>
<td>
	<?php echo $calendar->day($next,$data['month'],$data['year'],$events);?>
</td>
<?php $next++;?>
<?php endif;?>
<?php endfor; ?>
</tr>

<?php /*** WEEK TWO ***/ ?>
<tr>
<?php for ($i=8; $i<=14; $i++,$next++) : ?>
<td>
	<?php echo $calendar->day($next,$data['month'],$data['year'],$events);?>
</td>
<?php endfor; ?>
</tr>

<?php /*** WEEK THREE ***/ ?>
<tr>
<?php for ($i=15; $i<=21; $i++,$next++) : ?>
<td>
	<?php echo $calendar->day($next,$data['month'],$data['year'],$events);?>
</td>
<?php endfor; ?>
</tr>

<?php /*** WEEK FOUR ***/ ?>
<tr>
<?php for ($i=22; $i<=28; $i++) : ?>
<?php if (strftime("%d",$lastdate) < $next): ?>
<td>&nbsp;</td>
<?php else: ?>
<td>
	<?php echo $calendar->day($next,$data['month'],$data['year'],$events);?>
</td>
<?php $next++;?>
<?php endif; ?>
<?php endfor; ?>
</tr>

<?php /*** WEEK FIVE ***/ ?>
<tr>
<?php for ($i=29; $i<=35; $i++) : ?>
<?php if (strftime("%d",$lastdate) < $next): ?>
<td>&nbsp;</td>
<?php else: ?>
<td>
	<?php echo $calendar->day($next,$data['month'],$data['year'],$events);?>
</td>
<?php $next++;?>
<?php endif; ?>
<?php endfor; ?>
</tr>

<?php /*** WEEK SIX ***/ ?> 
<?php if ($next <= strftime("%d",$lastdate)): /* check if there is a sixth line */?>
<tr>
<?php for ($i=36; $i<=42; $i++): ?>
<?php if (strftime("%d",$lastdate) < $next): ?>
<td>&nbsp;</td>
<?php else: ?>
<td>
	<?php echo $calendar->day($next,$data['month'],$data['year'],$events);?>
</td>
<?php $next++;?>
<?php endif; ?>
<?php endfor; ?>
</tr>
<?php endif;?>
</table>
</div>