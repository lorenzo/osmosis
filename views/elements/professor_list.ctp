<ul class="professors-list">
	<?php
		foreach ($professors as $i => $professor):
	?>
		<li>
			<div id="hcard-<?php echo Inflector::slug($professor['full_name'])?>" class="vcard">
				<?php
					echo  $html->link(
						'<span class="given-name">' . $professor['full_name'] . '</span>',
						array('controller' => 'members', 'action' => 'view', $professor['id']),
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