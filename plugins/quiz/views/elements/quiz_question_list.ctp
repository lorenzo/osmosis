<?php
$paginator->options(array('url' => $this->params['pass'] + $this->params['named']));
if (!$isAjax) :
?>
<div class="question-list">
	<?php
		$paginator->options(array('url' => $this->params['pass']));
		echo $this->element('question_drop_list', array('quiz_id' => $this->data['Quiz']['id']));
	?>
	<div class="question-list-search">
	<?php
		echo $form->create('Quiz',array('class' => 'search'));
		echo $form->input('Search.body',array(
				'default' => empty($this->params['named']['body']) ? '' : $this->params['named']['body'],
			)
		);
		echo $form->input('Search.tags',array(
				'default' => empty($this->params['named']['tags']) ? '' : $this->params['named']['tags'],
				'label' => __('Tagged',true)
			)
		);
		echo $form->end(array(
				'label' => __('Search',true),
			)
		);
	?>
	</div>
	<div id="questions">
<?php endif; ?>
		<?php echo $form->create('Quiz', array('action' => 'add_question')); ?>
		<div class="list">
			<?php
			if (empty($question_list)) {
				$link = '';
				if ($question_type!='all') {
					$message = __('There are no questions available', true);
					$link = '<br />' . $html->link(
						__('create one', true),
						array(
							'controller'=>Inflector::pluralize($question_type),
							'action' => 'add',
							'quiz' => $this->data['Quiz']['id']
						)
					);
				} else {
					$message = __('There are no questions of this type available', true);
				}
				printf('<p class="empty">%s%s</p>', $message, $link);
			}
			echo '<ul>';
			foreach ($question_list as $questionIndex => $question) {
				echo $this->element('listing/'.Inflector::underscore($question['Question']['type']),compact('question','questionIndex'));
			}
			echo '</ul>';
			?>
		</div>
		<div class="pagination-counter">
			<?php
				echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% questions out of %count%', true)));
			?>
		</div>
		<div class="paging">
			<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
		| 	<?php echo $paginator->numbers();?>
			<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
		</div>
		<?php
		echo $form->submit(__('Add to quiz', true));
		echo $form->end();
		?>
<?php if (!$isAjax) : ?>
	</div>
</div>
<?php endif; ?>