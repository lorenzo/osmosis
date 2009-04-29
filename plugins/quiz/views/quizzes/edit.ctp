<?php
$javascript->link(array(
	'jquery/plugins/jquery.ui.core',
	'jquery/plugins/jquery.ui.sortable',
	'jquery/plugins/jquery.form',
	'jquery/plugins/jquery.jeditable',
	'jquery/plugins/jquery.jeditable.tinymce'
	),false);
?>
<h1><?php echo sprintf(__('Edit %s %s', true), __('Quiz', true), $form->value('Quiz.name'));?></h1>
<?php echo $this->element('quiz_question_list'); ?>
<div class="quiz-preview">
	<div class="content">
		<h2>&mdash; <?php echo $form->value('Quiz.name') ?> &mdash;</h2>
		<?php
			unset($this->data['Quiz']);
			$total = count($this->data['Question']);
			echo '<ol class="quiz-question-list">';
			foreach ($this->data['Question'] as $index => $question) {
				$number = $index + 1;
				echo '<li class="quiz-question"  id="'.$question['QuizQuestion']['id'].'">',
				'<div class="quiz-question-header" id="qheader-'.$question['QuizQuestion']['id'].'">',
					$question['QuizQuestion']['header'],
				'</div>',
				"<div class='quiz-question-number'>
					$number.
				</div>",
				'<h3 class="question-header">',
					__(Inflector::humanize(Inflector::underscore($question['type'])), true) ,
				'</h3>',
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
				echo $html->link(__('edit header',true),
						array('action' => 'edit_question_header',$question['QuizQuestion']['id']),
						array('class' => 'quiz-question-action question-edit-header'));
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

	function fixThings(question) {
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
						.children('a.question-move-down').show()
					.end()
				.end()
			.end()
				.children('li').each(function(i){
					$(this).find('.quiz-question-number').html((i + 1) + '.');
				});
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
					link.prevAll('.question-header').addClass('loading');
				},
				complete : function() {
					link.prevAll('.question-header').removeClass('loading');
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
					link.prevAll('.question-header').addClass('loading');
				},
				complete : function() {
					link.prevAll('.question-header').removeClass('loading');
				}
		});
		return false;
	}

	function editHeader() {
		var link = $(this);
		var container = link.parent('li').children('.quiz-question-header');
		container.click();
		return false;
	}

	$('#QuizEditForm.search').ajaxForm({
		target: '#questions',
		url: '<?php echo $html->url(array('action' => 'available_questions') + $this->params['pass'] + $this->params['named']); ?>',
		beforeSubmit : function() {
			$('#questions .list').addClass('loading');
		}
	});
	$('#questions .paging a').live('click',function() {
		$.ajax({
			url : this.href,
			success : function(data,status) {
				$('#questions').html(data);
			},
			beforeSend : function() {
				$('#questions .list').addClass('loading');
			}
		});
		return false;
	});
	$('#questions .list ul li a.question-preview-link').live('click',questionPreview);
	$('ol.quiz-question-list a.question-remove').live('click',removeQuestion);
	$('ol.quiz-question-list a.question-move-up, ol.quiz-question-list a.question-move-down').live('click',moveQuestion);
	$('ol.quiz-question-list a.question-edit-header').live('click',editHeader);
	$(".quiz-question-list").sortable({
		handle:'h3',
		placeholder: 'quiz-question-placeholder quiz-question',
		opacity: 0.5,
		axis: 'y',
		cursor: 'move',
		start: function (event,element) {
			var newOrder = $(".quiz-question-list").sortable('toArray');
			var item = $(element.item);
			var position = $.inArray(item.attr('id'),newOrder) + 1;
			item.data('position',position);
		},
		update: function (event,element) {
			var newOrder = $(".quiz-question-list").sortable('toArray');
			var item = $(element.item);
			var position = $.inArray(item.attr('id'),newOrder) + 1;
			$.ajax({
				url : setPositionURL + '/' + item.attr('id') + '/to/' + position + '.json',
				dataType : 'json',
				success : function(data,status) {
					if (jsonSucces(data)) {
						fixThings(item);
						item.data('position',position);
					}
				},
				beforeSend : function() {
					item.children('.question-header').addClass('loading');
				},
				complete : function() {
					item.children('.question-header').removeClass('loading');
				}
			});

		}
	}).find('li .question-header').addClass('movable');
	$(".quiz-question-header").each(function(){
		var url = $(this).parent('li').children('a.question-edit-header').attr('href');
		$(this).editable(url,{
			type : 'mce',
			name: 'data[QuizQuestion][header]',
			submit : '<?php __('Save'); ?>',
			indicator : '<?php __('Saving... please wait');?>',
			tooltip : '<?php __('Click to edit') ?>',
			width : '90%',
			placeholder : '',
			height : '100px'
		});
	});

});
</script>
<?php echo $this->element('ui/editor',array('options' => array('mode' => 'none'))); ?>