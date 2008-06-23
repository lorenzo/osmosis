<li>
<?php
$members = Set::extract('/Member', $events);
$member_links = array();
foreach ($members as $i => $member) {
	$member = $member['Member'];
	$member_links[] = $html->link($member['full_name'], array('controller' => 'members', 'action' => 'view', $member['id']));
	if ($i>=6) {
		$member_links[] = __('others...', true);
		break;
	}
}
$member_links = array_unique($member_links);
$member_links = $text->toList($member_links, __('and', true));
$discussion = $events[0]['ModelLog']['data']['Discussion'];

echo String::insert(
	__(':member_links :action the discussion <em>:discussion_name</em>.', true),
	array(
		'member_links' => $member_links,
		'action'			=> $events[0]['ModelLog']['created'] ? 'created' : 'modified',
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