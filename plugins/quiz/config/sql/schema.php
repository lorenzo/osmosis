<?php
class QuizSchema extends CakeSchema {
	var $name = 'Quiz';

	var $quiz_quizzes = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_choice_choices = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'choice_question_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'text' => array('type'=>'text', 'null' => false),
			'position' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 3),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_choice_questions = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'body' => array('type'=>'text', 'null' => false),
			'shuffle' => array('type'=>'boolean', 'null' => false),
			'max_choices' => array('type'=>'integer', 'null' => false),
			'min_choices' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_choice_questions_answers = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'member_id' => array('type'=>'integer', 'null' => false),
			'choice_questions_quiz_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'created' => array('type'=>'datetime', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_choice_choices_answers = 	array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'choice_questions_answer_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'choice_choice_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_matching_questions = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'body' => array('type'=>'text', 'null' => false),
			'shuffle' => array('type'=>'boolean', 'null' => false),
			'max_associations' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 3),
			'min_associations' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 3),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_matching_questions_answers = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'member_id' => array('type'=>'integer', 'null' => false),
			'matching_questions_quiz_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'created' => array('type'=>'datetime', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_matching_choices_answers = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'quiz_matching_choices_answers' => array('type'=>'string', 'null' => false, 'length' => 36),
			'source_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'target_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_ordering_questions = 	array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'body' => array('type'=>'text', 'null' => false),
			'shuffle' => array('type'=>'boolean', 'null' => false),
			'max_choices' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 4),
			'min_choices' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 4),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_ordering_questions_answers = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'member_id' => array('type'=>'integer', 'null' => false),
			'ordering_questions_quiz_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'created' => array('type'=>'datetime', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_ordering_choices_answers = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'ordering_questions_answer_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'ordering_choice_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'position' => array('type'=>'integer', 'null' => false, 'length' => 4),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_text_questions = 	array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'title' => array('type'=>'string', 'null' => false),
			'body' => array('type'=>'text', 'null' => false),
			'format' => array('type'=>'string', 'null' => false, 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_text_questions_answers = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'member_id' => array('type'=>'integer', 'null' => false),
			'text_question_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'answer' => array('type'=>'text', 'null' => false),
			'created' => array('type'=>'datetime', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_matching_questions_quizzes = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'matching_question_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'quiz_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_ordering_questions_quizzes = 	array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'ordering_question_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'quiz_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_choice_questions_quizzes = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'choice_question_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'quiz_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_text_questions_quizzes = 	array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'text_question_id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'index'),
			'quiz_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'text_question_id' => array('column' => array('text_question_id', 'quiz_id'), 'unique' => 1))
			);
	var $quiz_matching_choices = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'text' => array('type'=>'text', 'null' => false),
			'matching_question_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'target_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $quiz_ordering_choices = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'ordering_question_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'text' => array('type'=>'text', 'null' => false),
			'position' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 3),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
}
?>
