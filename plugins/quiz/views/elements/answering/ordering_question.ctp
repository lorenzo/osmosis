<div class=" question orderingQuestion answering">
	<?php echo $question['OrderingQuestion']['body'] ?>
	<ul>
	<?php foreach ($question['OrderingChoice'] as $i => $choice) : ?>
		<li class="orderingChoice">
			<?php echo $form->input('OrderingQuestion.'.$question['OrderingQuestion']['id'].'.'.$choice['id'],array('label' => false)); ?>
			<div><?php echo $choice['text']?></div>
		</li>
	<?php endforeach; ?>
	</ul>
</div>