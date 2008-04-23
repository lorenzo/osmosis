<div class="matchingQuestion choices">
<?php echo $form->create('MatchingQuestion');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Create a Matching Question', true));?></legend>
		<div class="information">
			<p class="description">
				<?php
					__('This type of question has two sets of options: each element &mdash; question &mdash; in the first, has one correct answer in the other. This question requests the student to select a correct answer for each question.');
				?>
			</p>
			<?php
				echo $form->input('body');
				echo '<div class="checkbox">' . $form->input('shuffle', array('label' => __('Always shuffle the order of the choices.', true))). '</div>';
				echo $form->input(
					'max_associations',
					array(
						'after' => '<span class="help">Maximum number of associations that the student is allowed to create. Leave empty to have no restriction.</span>'
					)
				);
				echo $form->input(
					'min_associations',
					array(
						'after' => '<span class="help">Minimum number of associations that the student is required to create. Leave empty to have no restriction.</span>'
					)
				);
			?>
		</div>
		<fieldset class="question-choices matching">
			<legend><?php echo sprintf(__('Choices', true));?></legend>
			<div class="choice question set">
				<strong><?php __('Questions'); ?></strong>
				<ol>
				<?php
					for ($i=0;$i<$totalQuestions;$i++) :
				?>
						<li>
							<?php echo $form->input('SourceChoice.'.$i.'.text', array('rows' => 2, 'div' => false,  'label' => false)); ?>
							<span class="correct">
								<?php
									echo $form->input(
										'SourceChoice.' . $i . '.correct',
										array('label' => array('text' => __('Correct Answer', true), 'class' => 'help'), 'size' => '1', 'div' => false)
									);
									
								?>
							</span>
						</li>
				<?php
					endfor;
				?>
				</ol>
				<?php
					echo $form->submit(__('Add Question',true),array('name' => 'data[UI][addQuestion]','value' => 1));
				?>
			</div>
			<div class="choice answer set">
				<strong><?php __('Answers'); ?></strong>
				<ol>
				<?php
					for ($i=0;$i<$totalAnswers;$i++) :
						echo '<li>' . $form->input('TargetChoice.'.$i.'.text', array('rows' => 2, 'div' => false, 'label' => false)) . '</li>';
					endfor;
				?>
				</ol>
				<?php
					echo $form->submit(__('Add Answer',true),array('name' => 'data[UI][addAnswer]','value' => 1));
				?>
			</div>
			<?php
				echo $form->input('Quiz.0.id');
			?>
		</fieldset>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('MatchingQuestions', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Matching Choices', true)), array('controller'=> 'matching_choices', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Matching Choice', true)), array('controller'=> 'matching_choices', 'action'=>'add')); ?> </li>
	</ul>
</div>
