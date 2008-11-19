
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
		$member_links[] = __d('wiki','others...', true);
		break;
	}
}
$member_links = array_unique($member_links);

$action = $events[0]['ModelLog']['created'] ? __d('wiki',' has created',true) : __('has modified',true);
if (count($member_links) > 1)
	$action = __d('wiki','have modified',true);
	
$member_links = $text->toList($member_links, __d('wiki','and', true));
$entry = $events[0]['ModelLog']['data']['Entry'];

	
echo String::insert(
	__d('wiki','<li>:member_links :action the page <em>:entry_title</em>.</li>', true),
	array(
		'member_links' => $member_links,
		'action'			=> $action,
		'entry_title' => $html->link(
			$entry['title'],
			array(
				'plugin'		=> 'wiki',
				'controller'	=> 'entries',
				'action'		=> 'view',
				$entry['slug'],
				'course_id'		=> $events[0]['ModelLog']['course_id']
			)
		)
	)
);
?>