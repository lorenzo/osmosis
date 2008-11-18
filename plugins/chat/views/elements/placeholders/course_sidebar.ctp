<div id="chat" class="boxed">
	<strong class="title"><?php __d('chat','Chat'); ?></strong>
</div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		OsmosisChat.init(
			{
				me			: <?php echo "'" . __d('chat','me', true) . "'"; ?>,
				minimize	: <?php echo "'" . __d('chat','minimize', true) . "'"; ?>,
				close		: <?php echo "'" . __d('chat','close', true) . "'"; ?>
			}		
		);
	});
</script>
