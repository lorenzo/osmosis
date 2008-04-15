<?php
 	echo $form->create('Quiz', array('action' => 'add_question/' . $question_type));
	echo $form->input('id');
//	echo $form->input('question_type', array('value' => $question_type, 'type' => 'hidden'));
	echo sprintf('<h1>%s</h1>', __('Available Questions', true));
	echo $this->renderElement($questionType . '.' . 'association_list');
	echo $form->end(__('Associate', true));
?>