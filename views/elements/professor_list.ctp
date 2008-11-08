<ul class="professors-list">
	<?php
		if (empty($professors)) {
			echo '<li>' . __('There are no professors for this course', true) . '</li>';
		}
		foreach ($professors as $i => $professor):
			$professor = $professor['Member'];
	?>
		<li>
			<div id="hcard-<?php echo Inflector::slug($professor['full_name'])?>" class="vcard">
				<?php
					echo  $html->link(
						'<span class="given-name">' . $professor['full_name'] . '</span>',
						array('controller' => 'members', 'action' => 'view','plugin' => '',$professor['id']),
						array('class' => 'url fn n'),
						null, false
					);
				?><br />
				<?php
					echo $html->link(
						$professor['email'],
						'mailto:' . $professor['email'],
						array('class' => 'email')
					);
				?>
				<?php
					if (!empty($professor['phone'])):
				?>
				<div class="tel"><?php echo $professor['phone']; ?></div>
				<?php
					endif;
				?>
			</div>
		</li>
	<?php
		endforeach;
	?>
</ul>