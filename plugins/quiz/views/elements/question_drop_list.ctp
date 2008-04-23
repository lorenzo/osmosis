<div class="droplist">
	<ul>
		<?php
			$link_list = array();
			$question_types['all'] = __('All', true);
			foreach ($question_types as $question_type_key => $question_type_name) :
				$i = sizeof($link_list)+1;
				$url = array(
					'controller' => 'quizzes',
					'action' => 'edit',
					$this->data['Quiz']['id'],
					'question_type' =>  $question_type_key
				);
				if ($question_type_key == $question_type) {
					$question_type_key  = $question_type;
					$question_type_name = $question_name;
					$i = 0;
				}
			
				if ($question_type_key == 'all') {
					unset($url['question_type']);
				}
				$link = $html->link($question_type_name, $url);
				$class = '';
				if ($i==0) {
					$link = '<span>' . $question_type_name . '</span>';
					$class = ' class="first"';
				}
				$link_list[$i] = sprintf('<li%s>%s</li>', $class, $link);
			endforeach;
			ksort($link_list);
			echo implode($link_list, '');
		?>
	</ul>
</div>
<p class="add">
	<?php
		if ($question_type!='all') {
			echo '&mdash; ' . $html->link(__('create one', true), array('controller'=>Inflector::pluralize($question_type), 'action' => 'add', 'quiz' => $quiz_id));
		}
	?>
	&nbsp;
</p>