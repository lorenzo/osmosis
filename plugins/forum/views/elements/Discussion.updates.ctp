<li>
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
		$member_links[] = __('others...', true);
		break;
	}
}
$member_links = array_unique($member_links);

$action = $events[0]['ModelLog']['created'] ? __(' has created',true) : __('has modified',true);
if (count($member_links) > 1)
	$action = __('have modified',true);

$discussion = $events[0]['ModelLog']['data']['Discussion'];
$member_links = $text->toList($member_links, __('and', true));

echo String::insert(
	__(':member_links :action the discussion <em>:discussion_name</em>.', true),
	array(
		'member_links' => $member_links,
		'action'			=> $events[0]['ModelLog']['created'] ? __('created', true) : __('modified', true),
		'discussion_name' => $html->link(
			$discussion['title'],
			array(
				'plugin'		=> 'forum',
				'controller'	=> 'discussions',
				'action'		=> 'view',
				'discussion_id'	=> $discussion['id'],
				'course_id'		=> $events[0]['ModelLog']['course_id']
			)
		)
	)
);
?>
</li>