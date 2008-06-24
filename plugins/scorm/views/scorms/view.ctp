<div id="scorm_ui">
	<?php
		$dynamicjs->link('scorm/scos/api/' . $show_sco['id'], false, 'api');
		$javascript->link('plugins/scorm/controls', false);
		$javascript->link('jquery/jquery', false);
		$javascript->link('jquery/plugins/treeview/jquery.treeview', false);
		$javascript->link('jquery/plugins/jquery.flydom', false);
		$javascript->link('jquery/plugins/jquery.blockUI', false);
		echo $html->css('scorm', null, null, true);
		echo $html->css('../js/jquery/plugins/treeview/jquery.treeview', null, null, true);
		echo $javascript->codeBlock('var scorm_id = "' . $scorm['Scorm']['id'] . '";');
		echo $javascript->codeBlock('var sco_id = "yokjojojo";');
		echo $javascript->codeBlock('$(document).ready(function(){ $("#scorm_toc ul").treeview(); });');
		echo $this->element('scorms/scorm_toc', array('cache' => '1 day', 'scorm' => $scorm,"foo". $scorm['Scorm']['id'] =>'foo'));
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
	<iframe id="viewport" name="viewport" <?php
		if (!empty($show_sco))
			echo "src=''";
	?>></iframe>
	<?php
		if (!empty($show_sco)) {
			echo $javascript->codeBlock(
				'$(document).ready(function(){'. "\n" .
				'	var link = $("a[href='.$html->url('/scorm/scos/view/' . $show_sco['id'] . '/' . $show_sco['href']).']");' . "\n" .
				'	debug(link);ScormControl.updateUI(link[0]);' . "\n" .
				'});'
			);
		}
	?>
</div>
