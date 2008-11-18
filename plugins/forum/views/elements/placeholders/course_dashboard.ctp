<div class="boxed dashboard-element">
	<strong class="title"><?php echo $html->link(__d('forum','Forum',true),array(
		'plugin' => 'forum', 'controller' => 'topics', 'action' => 'index', 'course_id' => $course['Course']['id'])); ?>
	</strong>
	<?php
	if (!empty($data)) :
	?>
		<ul>
		<?php
			foreach ($data as $model => $info) :
				if ($model == 'Response') :
					foreach ($info as $response) :
						$discussions = Set::extract('/ModelLog/data/Discussion/id[:first]',$response);
						foreach ($discussions as $id) :
							$all = Set::extract('/ModelLog/data/Discussion[id='.$id.']',$response);
							$link = $html->link($all[0]['Discussion']['title'],array(
								'plugin' => 'forum',
								'controller' => 'discussions',
								'action' 	=> 'view',
								 'discussion_id' => $id,
								'course_id' => $course['Course']['id']
								));
		?>
							<li><?php sprintf(__d('forum','%s new responses in discussion %s'),count($all),$link)?></li>
		<?php
						endforeach;
					endforeach;
				elseif ($model == 'Discussion') :
					foreach ($info as $id => $discussion) :
						$link = $html->link($discussion[0]['ModelLog']['data']['Discussion']['title'],array(
							'plugin' => 'forum',
							'controller' => 'discussions',
							'action' 	=> 'view',
							 'discussion_id' => $id,
							'course_id' => $course['Course']['id']
						));
						$last = Set::extract($discussion,'{n}.ModelLog.time');
						$last = array_pop($last);
		?>
						<li><?php sprintf(__d('forum','%s last modified %s'),$link,$time->timeAgoInWords($last))?></li>
		<?php
					endforeach;
				elseif ($model == 'Topic') :
					foreach ($info as $id => $topic) :
						$link = $html->link($topic[0]['ModelLog']['data']['Topic']['name'],array(
							'plugin' => 'forum',
							'controller' => 'topics',
							'action' 	=> 'view',
							 'topic_id' => $id,
							'course_id' => $course['Course']['id']
						));
						$last = Set::extract($topic,'{n}.ModelLog.time');
						$last = array_pop($last);
		?>
						<li><?php sprintf(__d('forum','%s last modified %s'),$link,$time->timeAgoInWords($last))?></li>
		<?php
					endforeach;
				endif;
			endforeach;
		?>
		</ul>
	<?php
	else :
		echo '<p>' . __d('forum','No forum updates yet, be the firts one!', true) . '</p>';
	endif;
	?>
</div>
