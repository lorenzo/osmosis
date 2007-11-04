<div id="scorm_ui">
	<?php
		echo $javascript->link('plugins/scorm/api', false);
		echo $javascript->link('plugins/scorm/controls', false);
		echo $javascript->link('jquery/jquery', false);
		echo $javascript->link('jquery/plugins/treeview/jquery.treeview', false);
		echo $html->css('scorm', null, null, true);
		echo $html->css('../js/jquery/plugins/treeview/jquery.treeview', null, null, true);
		echo $javascript->codeBlock('var scorm_id = "' . $scorm['Scorm']['id'] . '";');
		echo $javascript->codeBlock('var sco_number = null;');
		echo $javascript->codeBlock('$(document).ready(function(){ $("#scorm_toc ul").treeview(); });');
		echo $this->renderElement('scorms/scorm_toc', array('cache' => '1 day', 'scorm' => $scorm,"foo". $scorm['Scorm']['id'] =>'foo'));
	?>
	<div id="scorm_controls">
		<?php
			echo $html->link(
				__('&laquo; Previous', true), '/',
				array(
					'id' => 'scorm_control_previous',
					'target' => 'viewport',
					'style' => 'display:none'
				), false, false
			);
			echo " | " .$html->link(__('Exit Scorm', true), array('action' => 'index')) . " | ";
			echo $html->link(
				__('Next &raquo;', true), '/',
				array(
					'id' => 'scorm_control_next',
					'target' => 'viewport',
					'style' => 'display:none'
				), false, false
			);
		?>
	</div>
	<iframe id="viewport" name="viewport" <?php echo isset($start_path) ? "src='$start_path'" : ''; ?> />
</div>
