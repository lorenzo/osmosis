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
					'url' => array('controller' => 'scos', 'action' => 'view', ':id', ':href'),
					'ifPresent' => 'href'
				)
			)
		);
	?>
</div>

