<div class="boxed dashboard-element">
	<strong class="title"><?php echo $html->link(__('Wiki',true),array(
		'plugin' => 'wiki', 'controller' => 'wikis', 'action' => 'view', 'course_id' => $course['Course']['id'])); ?>
	</strong>
	<?php
	if (!empty($data)) :
	?>
		<ul>
		<?php
			$data = $data['Entry'];
			foreach ($data as $entry_id => $entry) :
		?>
			<li>
				<?php
					echo $html->link($entry[0]['ModelLog']['data']['Entry']['title'],array(
						'plugin' => 'wiki',
						'controller' => 'entries',
						'action' => 'view',
						$entry[0]['ModelLog']['data']['Entry']['slug'],
						'course_id' => $course['Course']['id']
					));
				?> &mdash;
				<?php 
				$last = Set::extract($entry,'{n}.ModelLog.time');
				$last = array_pop($last);
				__(sprintf('Last modified %s',$time->timeAgoInWords($last))); 
				?>
			</li>
		<?php
			endforeach;
		?>
		</ul>
	<?php
	else :
		echo '<p>' . __('No wiki updates yet, be the firts one!', true) . '</p>';
	endif;
	?>
</div>