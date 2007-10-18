<?php
	echo $this->renderElement('scorms/scorm_toc', array('cache' => '1 day', 'scorm' => $scorm,"foo". $scorm['Scorm']['id'] =>'foo'));
?>
<div id="scorm_viewport">
	<iframe id="viewport" name="viewport" <?php echo isset($start_path) ? "src='$start_path'" : ''; ?> />
</div>
