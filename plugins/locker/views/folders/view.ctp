<div id="locker">
<h1><?php printf(__("%s's Locker", true), $member['Member']['full_name']);?></h1>
<?php
	$folder_id = $parentFolder['LockerFolder']['id'];
	echo $this->element('folder_path', compact('path', 'member'));
	echo $this->element('folder_contents', compact('parentFolder'));
	echo $this->element('folder_actions', compact('folder_id'));
?>
</div>
<?php
	$javascript->link('jquery/plugins/jquery.dimensions', false);
	$javascript->link('jquery/plugins/jquery.cluetip', false);
	$html->css('jquery.cluetip', null, null, false);
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#locker #locker-contents ul li a').cluetip({
					sticky: true,
					local : true
				});
	});
</script>
<div id="name">
	cosa
</div>