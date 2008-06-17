<li class="discussion_responses">
<?php
$discussion_id = Set::extract('/ModelLog/data/Discussion/id[:first]', $events);
$member_links = array();
foreach ($events as $i => $event) {
	$member = $event['Member'];
	$link = $html->link($member['full_name'], array('controller' => 'members', 'action' => 'view', $member['id']));
	$respond_link = $html->link(
		__('response', true),
		array(
			'plugin' => 'forum',
			'controller' => 'discussions',
			'action' => 'view',
			'discussion_id' => $discussion_id[0]
		)
	);
	$read_response = String::insert(
		__('read :pronoun :response', true),
		array(
			'pronoun' => $member['sex']=='M' ? __('his', true) : ($member['sex']=='F' ? __('her', true) : __('the', true)),
			'response' => $respond_link
		)
	);
	$member_links[] = $link . ', ' . $read_response;
	if ($i>=6) {
		$member_links[] = __('and others...', true);
		break;
	}
}
$member_links = array_unique($member_links);
$member_links = $html->nestedList($member_links, null, array('class' => 'users'));
$discussion = $events[0]['ModelLog']['data']['Discussion'];
echo String::insert(
	__('The following classmates wrote a response on the discussion <em>:discussion_name</em>:<br /> :link_list', true),
	array(
		'link_list' => $member_links,
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