<?php
if (!isset($options)) {
	$options = array();
}
echo $javascript->link('tiny_mce/tiny_mce',null,null,false);
$this->_loadHelpers($this->helpers,array('TinyMce'));
$this->TinyMce = $this->helpers['TinyMce'];
?>
<script language="javascript" type="text/javascript">
<?php echo $this->TinyMce->widget($options); ?>
</script>
