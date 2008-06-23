<div class=" question orderingQuestion">
	<?php echo $question['OrderingQuestion']['body'] ?>
	<ul>
	<?php foreach ($question['OrderingQuestion']['OrderingChoice'] as $i => $choice) : ?>
		<li class="orderingChoice">
			<div class="choice"><strong style="font-size:1.1em"><?php echo $choice['text']?></strong></div>
			<?php echo $form->input('OrderingQuestion.'.$question['OrderingQuestion']['id'].'.'.$choice['id'].'.position'); ?>
		</li>
	<?php endforeach; ?>
	</ul>
</div>