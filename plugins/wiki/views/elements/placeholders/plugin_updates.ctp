<div id="wiki-updates">
	<strong class="title"><?php 
	echo $html->link(
		__('Wiki',true),array(
			'plugin' => 'wiki', 
			'controller' => 'wikis',
			'action' => 'view',
			'course_id' => $path
			)
		); ?></strong>
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