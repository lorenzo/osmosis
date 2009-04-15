<response>
<?php 
$status = 1;
if (isset($error)) {
	echo $xml->elem('error',array(),$error);
	$status = 2;
}
echo $xml->elem('status',array(),$status);
?>
</response>