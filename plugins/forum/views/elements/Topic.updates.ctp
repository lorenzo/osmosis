<?php

$members = Set::extract('/Member', $events);
$member_links = $repeated = array();
foreach ($members as $i => $member) {	
	if (in_array($member['Member']['id'],$repeated)) {
		continue;
	}
		
	$member = $member['Member'];
	$repeated[] = $member['id'];
	$member_links[] = $html->link($member['full_name'], array('controller' => 'members', 'action' => 'view', $member['id']));
	if (count($member_links) == 6) {
		$member_links[] = __d('forum','others...', true);
		break;
	}
}
$member_links = array_unique($member_links);

$action = $events[0]['ModelLog']['created'] ? __d('forum',' has created',true) : __('has modified',true);
if (count($member_links) > 1)
	$action = __d('forum','have modified',true);

$topic = $events[0]['ModelLog']['data']['Topic'];
$member_links = $text->toList($member_links, __d('forum','and', true));
echo String::insert(
	__d('forum','<li>:member_links :action the topic <em>:topic_title</em>.</li>', true),
	array(
		'member_links' => $member_links,
		'action'			=> $action,
		'topic_title' => $html->link(
			$topic['name'],
			array(
				'plugin'		=> 'forum',
				'controller'	=> 'topics',
				'action'		=> 'view',
				$topic['id'],
				'course_id'		=> $events[0]['ModelLog']['course_id']
			)
		)
	)
);