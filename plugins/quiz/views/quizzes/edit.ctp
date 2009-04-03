<h1><?php echo sprintf(__('Edit %s %s', true), __('Quiz', true), $form->value('Quiz.name'));?></h1>
<div class="question-list">
	<?php
		echo $form->create('Quiz', array('action' => 'add_question'));
		echo $this->element('question_drop_list', array('quiz_id' => $this->data['Quiz']['id']));
	?>
	<div id="questions">
		<div class="list">
			<?php
				$haveQuestions = false;
				foreach ($question_list as $type => $questions) {
					if (empty($questions)) {
						$link = '';
						$message = __('There are no questions of this type available', true);
						if ($question_type!='all') {
							$link = '<br />' . $html->link(
								__('create one', true),
								array(
									'controller'=>Inflector::pluralize($question_type),
									'action' => 'add',
									'quiz' => $this->data['Quiz']['id']
								)
							);
						} else {
							$message = __('There are no questions available', true);
						}
						continue;
					}
					$haveQuestions = true;
					echo $this->element('listing/'.Inflector::underscore($type), array('questions' => $questions));
				}
				
				if (!$haveQuestions)
					printf('<p class="empty">%s%s</p>', $message, $link);
			?>
		</div>
		<?php
		echo $form->submit(__('Add to quiz', true));
		echo $form->end();
		?>
	</div>
</div>
<div class="quiz-preview">
	<div class="content">
		<h2>&mdash; <?php echo $form->value('Quiz.name') ?> &mdash;</h2>
		<?php
			unset($this->data['Quiz']);
			echo '<ol class="quiz-question-list">';
			$total = count($this->data['Question']);
			foreach ($this->data['Question'] as $index => $question) {
				echo
				'<li>',
				'<h3>' ,
					__(Inflector::humanize(Inflector::underscore($question['type'])), true) ,
				'</h3>' ,
				$html->link(__('remove',true),
						array('action' => 'remove_question',$question['QuizQuestion']['id']),
						array('class' => 'quiz-question-action question-remove'));
				if ($index < $total) {
					echo $html->link(__('move down',true),
						array('action' => 'move_question',$question['QuizQuestion']['id'],'down'),
						array('class' => 'quiz-question-action question-move-down'));
				}
				if ($index > 0) {
					echo $html->link(__('move up',true),
						array('action' => 'move_question',$question['QuizQuestion']['id'],'up'),
						array('class' => 'quiz-question-action question-move-up'));
				}
				 echo $this->element('previewing/'.Inflector::underscore($question['type']), array('question' => $question)) ,
				'&nbsp;',
				'</li>';
			}
			echo '</ol>';
		?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#questions .list ul li a.question-preview-link').click(function() {
		var link = $(this);
		if (!link.hasClass('content-loaded'))  {
			$.ajax({
				url : this.href,
				success : function(data,status) {
					link.parents('li')
						.find('div.question-list-content')
							.html(data)
							.show('fast');
					link.addClass('content-loaded');
				},
				beforeSend : function() {
					link.parent().addClass('loading');
				},
				complete : function() {
					link.parent().removeClass('loading');
				}
			});
		}else{
			link.parents('li').find('div.question-list-content').toggle('fast');
		}
		return false;
	})
});
</script>