<div class="quiz">
<h1><?php echo $quiz['Quiz']['name']?> &mdash; </h1>

<?php $quizData = $quiz['Quiz']; unset($quiz['Quiz']) ?>
<?php foreach ($quiz as $type => $questions) :?>
	<?php
		if (empty($questions)) continue;
		
		echo '<h2 style="clear:both">' . __(Inflector::humanize(Inflector::tableize($type)), true) . '</h2>';
		echo '<ol>';
		foreach ($questions as $i => $question) {
			$question = array($type => $question);
			echo '<li style="clear:both">' . $this->element('previewing/'.Inflector::underscore($type), array('question' => $question)) . '&nbsp;</li>';
		}
		echo '</ol>';
	?>
<?php endforeach;?>
</div>

