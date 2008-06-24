<div id="wiki-updates">
<strong class="title"><?php __('Wiki'); ?></strong>
<?php
foreach ($data as $modelName => $entity) :
?>
<ul id="wiki">
	<?php
		foreach ($entity as $i => $events) :
			echo $this->element('updates', array('events' => $events, 'plugin' => 'wiki'));
		endforeach;
	?>
</ul>
<?php
endforeach;
?>
</div>