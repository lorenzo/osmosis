<div class="scorm index">
	<div class="content-title">
		<h2><?php  __('Lessons');?></h2>
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
	</div>
<div id="recent-lessons">
	<h3><?php __('Lessons Taken Recently');?></h3>
	<?php
		if (!empty($recent)) :
	?>
		<ul>
	<?php
			foreach ($recent as $i => $tracking) {
				$scorm = $tracking['Sco']['Scorm'];
			?>
			<li>
				<?php
					echo $html->link(
						$scorm['name'],
						array('controller' => 'scorms', 'action'=>'view', $scorm['id'])
					);
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
		<h3>Cosa</h3>
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
					<li class="edit">
						<?php
							echo
								$html->link(
								__('Edit', true),
								array('controller'=> 'scorms', 'action'=>'edit', $scorm['Scorm']['id'])
								
							);
						?>
					</li>	
				</ul>
			</li>
		<?php endforeach; ?>
		</ul>
<?php endif; ?>
	</div>
</div>
