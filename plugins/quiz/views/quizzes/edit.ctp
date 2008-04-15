<h1><?php echo sprintf(__('Edit %s %s', true), __('Quiz', true), $form->value('name'));?></h1>
<?php __('Add a question to this quiz'); ?>
<ul>
	<?php
		foreach ($question_types as $question_type_key => $question_type) {
	?>
	<li>
		<?php
			echo $html->link(
				__('Associate an existing ' . $question_type, true),
				array(
					'action' => 'add_question',
					$question_type_key,
					$form->value('Quiz.id')
				)
			);
			echo ' ' . __('or', true) . ' ';
			echo $html->link(
				'create a new one',
				array(
					'controller' => Inflector::pluralize($question_type_key),
					'action' => 'add',
					'quiz_id' => $form->value('Quiz.id')
				),
				array('title' => __('Create a new ' . $question_type, true))
			);
		?> 
	</li>
	<?php			
		}
	?>
</ul>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Quiz.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Quiz.id'))); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Quizzes', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Association Questions', true)), array('controller'=> 'association_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Association Question', true)), array('controller'=> 'association_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
