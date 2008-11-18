<div id="forum-updates">
<strong class="title"><?php 
echo $html->link(
	__d('forum','Forum',true),array(
		'plugin' => 'forum', 
		'controller' => 'topics',
		'action' => 'index',
		'course_id' => $path
		)
	); ?></strong>
<?php
foreach ($data as $modelName => $entity) :
?>
<ul id="forum">
	<?php
		foreach ($entity as $i => $events) :
			echo $this->element($modelName . '.updates', array('events' => $events, 'plugin' => 'forum'));
		endforeach;
	?>
</ul>
<?php
endforeach;
?>
</div>