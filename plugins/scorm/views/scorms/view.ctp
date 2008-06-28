<div id="scorm_ui">
	<?php
		$dynamicjs->link('scorm/scos/api/' . $show_sco['id'], false, 'api');
		$javascript->link('/scorm/js/controls', false);
		$javascript->link('jquery/plugins/treeview/jquery.treeview', false);
		$javascript->link('jquery/plugins/jquery.flydom', false);
		$javascript->link('jquery/plugins/jquery.blockUI', false);
		$javascript->link('jquery/plugins/jquery.easing', false);
		$javascript->link('jquery/plugins/jquery.scrollTo', false);
		$html->css('/scorm/css/scorm', null, null, false);
		$html->css('/scorm/css/jquery.treeview', null, null, false);
		echo $javascript->codeBlock('var scorm_id = "' . $scorm['Scorm']['id'] . '";');
		echo $javascript->codeBlock('$(document).ready(function(){ $("#scorm_toc ul").treeview(); });');
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
	<?php
		echo $this->element('scorms/scorm_toc', array('scorm' => $scorm,"foo". $scorm['Scorm']['id'] =>'foo'));
	?>
	<div id="viewport_container">
		<iframe id="viewport" name="viewport" <?php
			if (!empty($show_sco))
				echo "src=''";
		?>></iframe>
	</div>
	<?php
		if (!empty($show_sco)) {
			$loading = __('Loading', true);
			$sco_id = $show_sco['id'];
			$link = $html->url(
				array(
					'plugin'		=> 'scorm',
					'controller'	=> 'scos',
					'action'		=> 'view',
					$sco_id,
					$show_sco['href']
				)
			);
			$js = <<<ejs
	$(document).ready(function() {
		var link = $('a[href=$link]');
		ScormControl.updateUI(link[0], '$loading');
		ScormControl.storeDataCallback();
		ScormControl.getCompleted($sco_id);
	});
ejs;
			echo $javascript->codeBlock($js);
		}
	?>
</div>