<?php if (isset($question['TextQuestion']['title'])) :?>
<strong><?php echo $question['TextQuestion']['title'] ?></strong>
<?php endif ?> 
<span class="question-body">
	<?php echo $filter->filter($question['TextQuestion']['body']); ?>
</span>