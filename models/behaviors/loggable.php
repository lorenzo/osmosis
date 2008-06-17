<?php
/* SVN FILE: $Id$ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */
class LoggableBehavior extends ModelBehavior {
	
	function afterSave(&$model, $created) {
		$course_id = Configure::read('ActiveCourse.id');
		if (!$course_id) {
			$course_id = $model->getParentCourse();
		}
		$member_id = Configure::read('ActiveUser.Member.id');
		$data = array(
			'member_id'	=> $member_id,
			'model'		=> $model->alias,
			'entity_id' => $model->id,
			'course_id' => $course_id,
			'created'	=> $created,
			'time'		=> time()
		);
		if (!$course_id) {
			$error = "Could not log a model Modification (Parent Course not found).\n";
			$error.= "Please implement $model->alias::getParentCourse or correctly set ActiveCourse.id configuration on POST.\n";
			$error.= "Data received:\n" . var_export($data, true);
			$this->log($error);
			return;
		}
		$modelLog = ClassRegistry::getObject('ModelLog');
		$modelLog->create();
		$modelLog->save($data);
	}
}
?>
