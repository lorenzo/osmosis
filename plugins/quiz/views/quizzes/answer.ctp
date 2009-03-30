<div class="quiz">
<h1><?php echo $quiz['Quiz']['name']?> &mdash; </h1>

<?php echo $form->create('Quiz',array('url' => array('action' => 'answer', $quiz['Quiz']['id'] ))) ?>

<?php $quizData = $quiz['Quiz']; unset($quiz['Quiz']);?>
<ol>
<?php foreach ($quiz['Question'] as $i => $question) :?>
	<?php
			$type = $question['type'];
			echo '<h2>' . __(Inflector::humanize(Inflector::underscore($type)), true) . '</h2>';
			echo '<li>' . $this->element('answering/'.Inflector::underscore($type), array('question' => $question)) . '&nbsp;</li>';
	?>
<?php endforeach;?>
</ol>
<?php echo $this->element('ui/editor');?>
<?php echo $form->end('Submit'); ?>
</div>

