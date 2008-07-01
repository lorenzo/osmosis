<div class="scorm index">
	<div class="content-title">
		<h2><?php  __('Lessons');?></h2>
		<?php if (in_array($Osmosis['currentRole'],a('Professor','Admin'))) :?>
		<ul class="reverse actions">
			<li class="add">
				<?php
					echo $html->link(
						__('add lesson', true),
						array(
							'action'	=> 'add',
							'course_id'	=> $this->params['named']['course_id']
						)
					);
				?>
			</li>
		</ul>
		<?php endif;?>
	</div>
<div id="recent-lessons">
	<h3><?php __('Lessons Taken Recently');?></h3>
	<?php
		if (!empty($recent)) :
	?>
		<ul>
	<?php
			foreach ($recent as $i => $scorm) {
				$visited = $scorm[0]['created'];
				$scorm = $scorm['Scorm'];
			?>
			<li>
				<?php
					echo $html->link(
						$scorm['name'],
						array('controller' => 'scorms', 'action'=>'view', $scorm['id'])
					);
					echo '<div class="recent-time">'.$time->niceShort($visited).'</div>';
				?>
			</li>
			<?php
			}
	?>
		</ul>
	<?php
		else :
	?>
		<p><?php __('You have not taken any lesson yet'); ?></p>
	<?php			
		endif;
	?>
</div>
	<div class="lesson-list">
		<h3><?php __('Available lessons')?></h3>
<?php if (!empty($scorms)):?>
		<ul>
		<?php foreach ($scorms as $scorm): ?>
			<li class="lesson">
				<h4>
					<?php
						echo $html->link(
							$scorm['Scorm']['name'],
							array('controller'=> 'scorms', 'action'=>'view', $scorm['Scorm']['id'])
						);
					?>
				</h4>
				<?php
					if (!empty($scorm['Scorm']['description'])) :
				?>
					<p class="description"><?php echo $filter->filter($scorm['Scorm']['description']);?></p>
				<?php
					endif;
				?>
				<ul class="reverse actions">
					<li class="info">
						<?php
							echo
								$html->link(
								__('Take this lesson', true),
								array('controller'=> 'scorms', 'action'=>'view', $scorm['Scorm']['id'])
								
							);
						?>
					</li>
					<?php if (in_array($Osmosis['currentRole'],a('Professor','Admin'))) :?>
					<li class="edit">
						<?php
							echo
								$html->link(
								__('Edit', true),
								array('controller'=> 'scorms', 'action'=>'edit', $scorm['Scorm']['id'])
								
							);
						?>
					</li>
					<li class="delete">
						<?php
							echo
								$html->link(
								__('Delete', true),
								array('controller'=> 'scorms', 'action'=>'delete', $scorm['Scorm']['id']),
								null,
								__('This wil also delete any student tracking information on this lessons',true)
							);
						?>
					</li>
					<?php endif;?>	
				</ul>
			</li>
		<?php endforeach; ?>
		</ul>
<?php else: ?>
	<p><?php __('No lessons yet') ?></p>
<?php endif; ?>
	</div>
</div>
