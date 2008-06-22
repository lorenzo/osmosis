<strong><?php echo $question['TextQuestion']['title'] ?></strong>
<span class="question-body">
	<?php echo $filter->filter($question['TextQuestion']['body']); ?>
</span>