<?php
class ScormSchema extends CakeSchema {
	var $name = 'Scorm';

	var $scorm_attendee_trackings = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false, 'key' => 'index'),
			'student_id' => array('type'=>'integer', 'null' => false),
			'datamodel_element' => array('type'=>'string', 'null' => false),
			'value' => array('type'=>'string', 'null' => false),
			'created' => array('type'=>'datetime', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'scorm_id' => array('column' => array('sco_id', 'student_id', 'datamodel_element'), 'unique' => 1))
		);
	var $scorm_choice_considerations = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'preventActivation' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'constrainChoice' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_conditions = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'referencedObjective' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'measureThreshold' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 7),
			'operator' => array('type'=>'string', 'null' => true, 'default' => 'noOp', 'length' => 4),
			'ruleCondition' => array('type'=>'string', 'null' => false, 'length' => 27),
			'rule_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_control_modes = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'choiceExit' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'choice' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'flow' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'forwardOnly' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'useCurrentAttemptObjectiveInfo' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'useCurrentAttemptProgressInfo' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_delivery_controls = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'tracked' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'completionSetByContent' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'objectiveSetByContent' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_map_infos = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'objective_id' => array('type'=>'integer', 'null' => false),
			'targetObjectiveID' => array('type'=>'string', 'null' => false),
			'readSatisfiedStatus' => array('type'=>'string', 'null' => true, 'default' => 'true', 'length' => 5),
			'readNormalizedMeasure' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'writeSatisfiedStatus' => array('type'=>'string', 'null' => true, 'default' => 'false', 'length' => 5),
			'writeNormalizedMeasure' => array('type'=>'string', 'null' => true, 'default' => 'false', 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_objectives = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'satisfiedByMeasure' => array('type'=>'string', 'null' => true, 'default' => 'false', 'length' => 5),
			'minNormalizedMeasure' => array('type'=>'string', 'null' => false, 'default' => '1.0', 'length' => 3),
			'objectiveID' => array('type'=>'string', 'null' => false),
			'primary' => array('type'=>'boolean', 'null' => false, 'default' => '0'),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_randomizations = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'randomizationTiming' => array('type'=>'string', 'null' => true, 'default' => 'never', 'length' => 16),
			'selectCount' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'reorderChildren' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'selectionTiming' => array('type'=>'string', 'null' => true, 'default' => 'never', 'length' => 16),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_rollup_considerations = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'requiredForSatisfied' => array('type'=>'string', 'null' => false, 'default' => 'always', 'length' => 15),
			'requiredForNotSatisfied' => array('type'=>'string', 'null' => false, 'default' => 'always', 'length' => 15),
			'requiredForComplete' => array('type'=>'string', 'null' => false, 'default' => 'always', 'length' => 15),
			'requiredForIncomplete' => array('type'=>'string', 'null' => false, 'default' => 'always', 'length' => 15),
			'measureSatisfactionIfActive' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_rollups = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'rollupObjectiveSatisfied' => array('type'=>'string', 'null' => true, 'default' => 'true', 'length' => 5),
			'rollupProgressCompletion' => array('type'=>'string', 'null' => true, 'default' => 'true', 'length' => 5),
			'objectiveMeasureWeight' => array('type'=>'string', 'null' => true, 'default' => '1.0000', 'length' => 20),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_rules = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'type' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 4),
			'conditionCombination' => array('type'=>'string', 'null' => true, 'default' => 'all', 'length' => 3),
			'action' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 20),
			'minimumPercent' => array('type'=>'string', 'null' => true, 'default' => '0.0000', 'length' => 6),
			'minimumCount' => array('type'=>'string', 'null' => true, 'default' => '0', 'length' => 5),
			'rollup_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_sco_presentations = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'hideKey' => array('type'=>'string', 'null' => false, 'length' => 10),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_scorms = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => false),
			'name' => array('type'=>'string', 'null' => false),
			'file_name' => array('type'=>'string', 'null' => false),
			'description' => array('type'=>'text', 'null' => false),
			'version' => array('type'=>'string', 'null' => false, 'length' => 9),
			'created' => array('type'=>'datetime', 'null' => false),
			'modified' => array('type'=>'datetime', 'null' => false),
			'hash' => array('type'=>'string', 'null' => false, 'length' => 35),
			'path' => array('type'=>'text', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $scorm_scos = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'scorm_id' => array('type'=>'integer', 'null' => false),
			'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'manifest' => array('type'=>'string', 'null' => false),
			'organization' => array('type'=>'string', 'null' => false),
			'identifier' => array('type'=>'string', 'null' => false),
			'href' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'title' => array('type'=>'string', 'null' => false),
			'completionThreshold' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 3),
			'parameters' => array('type'=>'text', 'null' => true, 'default' => NULL),
			'isvisible' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'attemptAbsoluteDurationLimit' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 6),
			'dataFromLMS' => array('type'=>'text', 'null' => true, 'default' => NULL),
			'attemptLimit' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 10),
			'scormType' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 6),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
}
?>
