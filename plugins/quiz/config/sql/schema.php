<?php
class QuizSchema extends CakeSchema {
	var $name = 'Quiz';
	
	var $quiz_choice_choices = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'choice_question_id' =>  array('type' => 'integer', 'null' => false),
		'text' => array('type'=>'text', 'null' => false),
		'position' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 3,'null' => true, 'default' => NULL,),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_choice_choices_answers = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'choice_questions_answer_id' => array('type' => 'integer', 'null' => false),
		'choice_choice_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_choice_questions = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'shuffle' => array('type' => 'boolean', 'null' => false),
		'max_choices' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'min_choices' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_choice_questions_answers = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'member_id' => array('type' => 'integer', 'null' => false),
		'questions_quiz_id' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_matching_choices = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'text' => array('type' => 'text', 'null' => false),
		'matching_question_id' => array('type' => 'integer', 'null' => false),
		'target_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_matching_choices_answers = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'matching_questions_answer_id' => array('type' => 'integer', 'null' => false),
		'source_id' => array('type' => 'integer', 'null' => false),
		'target_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_matching_questions = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'shuffle' => array('type' => 'boolean', 'null' => false),
		'max_associations' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 3),
		'min_associations' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 3),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_matching_questions_answers = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'member_id' => array('type' => 'integer', 'null' => false),
		'questions_quiz_id' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_ordering_choices = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'ordering_question_id' => array('type' => 'integer', 'null' => false),
		'text' => array('type' => 'text', 'null' => false),
		'position' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 3),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_ordering_choices_answers = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'ordering_questions_answer_id' => array('type' => 'integer', 'null' => false),
		'ordering_choice_id' => array('type' => 'integer', 'null' => false),
		'position' => array('type' => 'integer', 'null' => false, 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_ordering_questions = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'shuffle' => array('type' => 'boolean', 'null' => false),
		'max_choices' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'min_choices' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_ordering_questions_answers = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'member_id' => array('type' => 'integer', 'null' => false),
		'questions_quiz_id' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_questions = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'type' => array('type' => 'string', 'null' => false, 'length' => 20),
		'body' => array('type' => 'text', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_questions_quizzes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'question_id' => array('type' => 'integer', 'null' => false),
		'quiz_id' => array('type' => 'integer', 'null' => false),
		'position' => array('type' => 'integer', 'null' => false, 'length' => 4),
		'header' => array('type' => 'text', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_questions_tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'question_id' => array('type' => 'integer', 'null' => false),
		'tag_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_quizzes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false),
		'course_id' => array('type' => 'integer', 'null' => false),
		'member_id' => array('type' => 'integer', 'null' => false),
		'published' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_text_questions = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false),
		'format' => array('type' => 'string', 'null' => false, 'length' => 5),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $quiz_text_questions_answers = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'member_id' => array('type' => 'integer', 'null' => false),
		'questions_quiz_id' => array('type' => 'integer', 'null' => false),
		'answer' => array('type' => 'text', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>