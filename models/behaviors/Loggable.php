<?php
class LoggableBehavior extends ModelBehavior {
	
	function afterSave(&$model, $created) {
		$course_id = Configure::read('ActiveCourse.id');
		$member_id = Configure::read('ActiveUser.Member.id');
		$modelLog = ClassRegistry::getObject('ModelLog');
		$modelLog->create();
		$modelLog->save(
			array(
				'member_id'	=> $member_id,
				'model'		=> $model->alias,
				'entity_id' => $model->id,
				'course_id' => $course_id,
				'created'	=> $created,
				'time'		=> time()
			)
		);
	}
}
?>