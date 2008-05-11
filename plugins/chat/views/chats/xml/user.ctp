<response>
<?php
echo $xml->elem('status',array(),$status);
if (!empty($user)) :
?>
<user>
<?php
	echo $xml->elem('name',array(),$user['Member']['full_name']);
	echo $xml->elem('username',array(),$user['Member']['username']);
?>
</user>
<?php
endif;
?>
</response>