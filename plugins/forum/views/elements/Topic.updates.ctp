<?php
$count = count($events);
foreach ($events as $i => $event) {
	$member = $event['Member'];
	$topic = $event['ModelLog']['data']['Topic'];
?>
<li>
	<?php
		echo String::insert(
			__(':member_name :action the Topic: :topic_name', true),
			array(
				'member_name'	=> $html->link(
					$member['full_name'],
					array('controller' => 'members', 'action' => 'view', $member['id'])
				),
				'action'		=> $event['ModelLog']['created'] ? __('created', true) : __('modified', true),
				'topic_name'	=> $html->link(
					$topic['name'],
					array(
						'plugin'		=> 'forum',
						'controller'	=> 'topics',
						'action'		=> 'view',
						'topic_id'		=> $topic['id']
					)
				)
			)
		);
	?>
</li>
<?php
	
}
?>