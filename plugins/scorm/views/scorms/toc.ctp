<div id="scorm_toc">
	<h2><?php echo $scorm['Scorm']['name']?></h2>
	<p>
		<?php echo $scorm['Scorm']['description']?>
	</p>
	<?php
		echo $tree->show(
			'Sco/title',
			$scos,
			array(
				'link' => array(
					'url' => array('controller' => 'scos', 'action' => 'view', 'plugin' => $this->plugin, ':id', ':href'),
					'ifPresent' => 'href'
				)
			),
			array(
				'target' => 'viewport',
				'id' => 'sco-',
				'class' => array('sco-', ':id'),
				'onclick' => 'return ScormControl.updateUI(this)'
			)
		);
	?>
</div>

