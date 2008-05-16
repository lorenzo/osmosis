<?php
$count = count($events);
foreach ($events as $i => $event) {
	$members = Set::extract('/Member', $event);
	debug($members);
	$member = $event['Member'];
	$model = $event['Topic'];
?>
<li>
	<?php
	echo String::insert(
		__(':member_name :action the Topic: :topic_name', true),
		array(
			'member_name' => $html->link($member['full_name'], array('controller' => 'members', 'action' => 'view', $member['id'])),
			'action' => $event['ModelLog']['created'] ? __('created', true) : __('modified', true),
			'topic_name' => $html->link(
				$model['name'],
				array('plugin' => 'forum', 'controller' => 'topics', 'action' => 'view', $model['id'], 'course_id' => $event['ModelLog']['course_id'])
			)
		)
	);
	?>
</li>
<?php
	
}
?>