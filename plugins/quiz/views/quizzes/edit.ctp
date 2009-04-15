<?php $javascript->link(array('jquery/plugins/jquery.ui.core','jquery/plugins/jquery.ui.sortable'),false); ?>
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
				"<li id='".$question['QuizQuestion']['id']."'",
				'<h3>' ,
					__(Inflector::humanize(Inflector::underscore($question['type'])), true) ,
				'</h3>' ,
				$html->link(__('remove',true),
						array('action' => 'remove_question',$question['QuizQuestion']['id']),
						array('class' => 'quiz-question-action question-remove'));
						
				$hidden = ($index < ($total - 1) && $total > 1) ? '' : ' hidden';
					echo $html->link(__('move down',true),
						array('action' => 'move_question',$question['QuizQuestion']['id'],'down'),
						array('class' => 'quiz-question-action question-move-down'. $hidden));
						
				$hidden = ($index > 0) ? '' : ' hidden';
					echo $html->link(__('move up',true),
						array('action' => 'move_question',$question['QuizQuestion']['id'],'up'),
						array('class' => 'quiz-question-action question-move-up' .$hidden));
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
	var setPositionURL = '<?php echo $html->url(array('controller' => 'quizzes','action' => 'move_question')); ?>';
	function jsonSucces(json) {
		return ('flash' in json) &&
			('params' in json.flash) &&
			('class' in json.flash.params) &&
			(json.flash.params.class == 'success');
	}

	function fixMoveButtons(question) {
		question
			.parent()
				.children('li:first-child')
						.children('a.question-move-up').hide()
					.end()
						.children('a.question-move-down').show()
					.end()
					.next()
						.children('a.question-move-up').show()
					.end()
						.children('a.question-move-down').show()
					.end()
				.end()
			.end()
				.children('li:last-child')
						.children('a.question-move-up').show()
					.end()
						.children('a.question-move-down').hide()
					.end()
					.prev()
						.children('a.question-move-down').show();
	}
	function questionPreview() {
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
	}
	
	function removeQuestion() {
		var link = $(this);
		$.ajax({
				url : this.href + '.json',
				dataType : 'json',
				success : function(data,status) {
					if (jsonSucces(data)) {
							link.parent().hide('slow',function(){
								$(this).remove();
							});
					}
				},
				beforeSend : function() {
					link.prevAll(':header').addClass('loading');
				},
				complete : function() {
					link.prevAll(':header').removeClass('loading');
				}
		});
		return false;
	}

	function moveQuestion(event) {
		var link = $(this);
		$.ajax({
				url : this.href + '.json',
				dataType : 'json',
				success : function(data,status) {
					if (jsonSucces(data)) {
						var question = link.parent('li').hide('slow',function() {
							var previous = question.prev('li');
							var next = question.next('li');

							if ($(event.target).is('a.question-move-up'))
								previous.before(question);
							else
								next.after(question);

							fixMoveButtons(question);

							question.show('slow',function() {
								question.css('display','list-item');
							});
						});
					}
				},
				beforeSend : function() {
					link.prevAll(':header').addClass('loading');
				},
				complete : function() {
					link.prevAll(':header').removeClass('loading');
				}
		});
		return false;
	}
	$('#questions .list ul li a.question-preview-link').click(questionPreview);
	$('ol.quiz-question-list a.question-remove').live('click',removeQuestion);
	$('ol.quiz-question-list a.question-move-up, ol.quiz-question-list a.question-move-down').live('click',moveQuestion);
	$(".quiz-question-list").sortable({
		handle:'h3',
		placeholder: 'quiz-question-placeholder',
		opacity: 0.5,
		axis: 'y',
		cursor: 'move',
		update: function (event,element) {
			var newOrder = $(".quiz-question-list").sortable('toArray');
			var item = $(element.item);
			var position = $.inArray(item.attr('id'),newOrder) + 1;
			$.ajax({
				url : setPositionURL + '/' + item.attr('id') + '/to/' + position + '.json',
				dataType : 'json',
				success : function(data,status) {
					if (jsonSucces(data)) {
						fixMoveButtons(item);
					}
				},
				beforeSend : function() {
					item.children(':first-child :header').addClass('loading');
				},
				complete : function() {
					item.children(':first-child :header').removeClass('loading');
				}
			});

		}
	});
});
</script>