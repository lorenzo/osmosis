<div id="locker">
<h1><?php printf(__d('locker',"%s's Locker", true), $member['full_name']);?></h1>
<?php
	echo $this->element('folder_path', compact('path', 'member'));
	echo $this->element('folder_contents', compact('parentFolder'));
	echo $this->element('folder_actions', compact('parentFolder'));
?>
</div>
<?php
	$javascript->link('jquery/plugins/jquery.dimensions', false);
	$javascript->link('jquery/plugins/jquery.hoverIntent', false);
	$javascript->link('jquery/plugins/jquery.cluetip', false);
	$javascript->link('jquery/plugins/jquery.jeditable', false);
	$javascript->link('jquery/plugins/jquery.jeditable.autogrow', false);
	$javascript->link('jquery/plugins/jquery.autogrow', false);
	$javascript->link('jquery/plugins/jquery.lockerItem', false);
	$javascript->link('jquery/plugins/jquery.blockUI', false);
	$javascript->link('jquery/plugins/jquery.ui.core', false);
	$javascript->link('jquery/plugins/jquery.ui.draggable', false);
	$javascript->link('jquery/plugins/jquery.ui.droppable', false);
	$html->css('jquery.cluetip', null, null, false);
?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var settings = {
			editable	: <?php echo ($session->read('Auth.Member.id') == $parentFolder['LockerFolder']['member_id']) ? "true" : "false" ?>,
 			updating	: <?php echo "'" . __d('locker',"Updating...", true) . "'"; ?>,
			cancel		: <?php echo "'" . __d('locker',"Cancel", true) . "'"; ?>,
			ok			: <?php echo "'" . __d('locker',"OK", true) . "'"; ?>,
			urlDocuments : <?php
				echo "'" . $html->url(
					array(
						'controller'	=> 'documents',
						'action'		=> 'edit',
						'ext'			=> 'json'
					)
				) . "'";
			?>,
			urlFolders : <?php
				echo "'" . $html->url(
					array(
						'controller'	=> 'folders',
						'action'		=> 'edit',
						'ext'			=> 'json'
					)
				) . "'";
			?>,
			urlMove : <?php
				echo "'" . $html->url(
					array(
						'controller'	=> 'folders',
						'action'		=> 'move',
						'ext'			=> 'json'
					)
				) . "'";
			?>
		}
		$('#locker #locker-contents ul li a').lockerItem(settings);
	});
</script>