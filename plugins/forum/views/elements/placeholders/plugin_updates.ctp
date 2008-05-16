<div id="forum-updates">
<strong class="title"><?php __('Forum'); ?></strong>
<?php
foreach ($data as $modelName => $log) :
?>
<ul id="forum">
	<?php
	foreach ($log as $id => $events) :
		echo $this->renderElement($modelName . '.updates', array('events' => $events, 'plugin' => 'forum'));
	endforeach;
	?>
</ul>
<?php
endforeach;
// debug($data);
?>
</div>