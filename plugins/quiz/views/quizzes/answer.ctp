<div class="quiz">
<h1><?php echo $quiz['Quiz']['name']?> &mdash; </h1>

<?php echo $form->create('Quiz',array('url' => array('action' => 'answer', $quiz['Quiz']['id'] ))) ?>

<?php $quizData = $quiz['Quiz']; unset($quiz['Quiz']) ?>
<?php foreach ($quiz as $type => $questions) :?>
	<?php
		if (empty($questions)) continue;
		
		echo '<h2>' . __(Inflector::humanize(Inflector::tableize($type)), true) . '</h2>';
		echo '<ol>';
		foreach ($questions as $i => $question) {
			$question = array($type => $question);
			echo '<li>' . $this->element('answering/'.Inflector::underscore($type), array('question' => $question)) . '&nbsp;</li>';
		}
		echo '</ol>';
	?>
<?php endforeach;?>
<?php echo $this->element('ui/editor');?>
<?php echo $form->end('Sumit'); ?>
</div>

