<div class="events view">
<h2><?php  __d('agenda','Event');?></h2>
<h3><?php echo $event['Event']['headline']; ?></h3>
<?php if ($event['Event']['all_day']) :?>
	<h4><?php __d('agenda','All Day')?></h4>
<?php endif;?>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d('agenda','Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $time->format('D, d-m-Y',$event['Event']['date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d('agenda','Location'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['location']; ?>
			&nbsp;
		</dd>
	</dl>
	<p><?php echo $event['Event']['detail']; ?></p>
</div>
