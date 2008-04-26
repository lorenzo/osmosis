<div class="choiceQuestion choices">
<?php echo $form->create('ChoiceQuestion');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Create a Choice Question', true));?></legend>
		<div class="information">
			<p class="description">
				<?php
					__('This type of question has many options (with one or more correct answers) and requests the student to select the correct answer.');
				?>
			</p>
			<?php
				echo $form->input('body');
				echo '<div class="checkbox">' . $form->input('shuffle', array('label' => __('Always shuffle the order of the choices.', true))). '</div>';
				echo $form->input(
					'max_choices',
					array(
						'after' => '<span class="help">Maximum number of choices that the student is allowed to select. Leave empty to have no restriction.</span>'
					)
				);
				echo $form->input(
					'min_choices',
					array(
						'after' => '<span class="help">Minimum number of choices that the student is required to select. Leave empty to have no restriction.</span>'
					)
				);
			?>
		</div>
		<fieldset class="question-choices">
			<legend><?php echo sprintf(__('Choices', true));?></legend>
			<?php
				echo $form->error('num_correct');
				for ($i=0;$i<$totalChoices;$i++) :
					$class = '';
					if ($i%2==0) {
						$class = ' altrow';
					}
			?>
				<div class="choice<?php echo $class?>">
			<?php
				echo '<div class="text">';
				echo $form->input('ChoiceChoice.'.$i.'.text', array('rows' => 2));
				echo '</div>';
				echo '<div class="position">';
				echo $form->input('ChoiceChoice.'.$i.'.position', array('label' => __('Fixed position',true)));
				echo $form->input('ChoiceChoice.'.$i.'.correct', array('label' => __('Correct answer',true), 'type' => 'checkbox'));
				echo '</div>';
			?>
				</div>
			<?php
				endfor;
				echo $form->input('Quiz.0.id');
				echo $form->submit(__('Add New Choice',true),array('name' => 'data[UI][addChoice]','value' => 1));
			?>
		</fieldset>
	</fieldset>
<?php echo $form->end(__('Create Question',true));?>
</div>