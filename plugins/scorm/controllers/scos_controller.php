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
class ScosController extends ScormAppController {

	var $name = 'Scos';
	var $helpers = array('Html','Javascript');
	var $uses = array('Scorm.Sco', 'Scorm.Scorm', 'Scorm.ScormAttendeeTracking');

	function api($id) {
		$trackings = $this->ScormAttendeeTracking->findAll(
			array(
				'student_id' => $this->Auth->user('id'),
				'sco_id' => $id
			)
		);
		$t = array();
		foreach($trackings as $tracking) {
			$t[$tracking['ScormAttendeeTracking']['datamodel_element']] = 
				$tracking['ScormAttendeeTracking']['value'];
		}
		$trackings = $t;
		$user = $this->Auth->user();
		$user = $user['Member'];
		$this->set(compact('trackings','user'));
		$this->set('sco_id', $id);
	}

	function view($id = null) {
		$params = $this->params['pass']; 
		unset($params[0]);
		$path = implode(DS , $params);
		if (!$id) {
			$this->Session->setFlash('Invalid Sco.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$scorm_id = $this->Sco->field('scorm_id', array('id' => $id));
		$path = $this->Scorm->field('path', array('id' => $scorm_id)) . $path;
		if (isset($this->params['url']['ext']) && $this->params['url']['ext'] != 'html') {
			$extension = $this->params['url']['ext'];
			if (strpos($path,$extension,strlen($path) - strlen($extension)) === false) {
				$path .= '.'.$extension;
			}
				
		} else {
			$extension = str_replace('.', '', strrchr($this->params['url']['url'], '.'));
		}
			
		$this->set('extension', $extension);
		$this->set('path', $path);
		$this->view = 'Scorm.Scorm';
	}
	
	function completed($id) {
		$scorm_id = $this->Sco->field('scorm_id', array('id' => $id));
		$conditions = array('Sco.scorm_id' => $scorm_id);
		$recursive = -1;
		$fields = array('Sco.id');
		$scos = $this->Sco->find('all',compact('conditions','fields','recursive'));
		$this->Sco->bindModel(array('hasMany' => array('Locker.ScormAttendeeTracking')));
		
		
		$completed = $this->ScormAttendeeTracking->find('all',array(
				'conditions' => array(
					'sco_id' => Set::extract($scos,'{n}.Sco.id'),
					'datamodel_element' => 'cmi__completion_status',
					'value'	=> 'completed',
					'student_id' => $this->Auth->user('id')
				),
				'recursive' => -1,
				'fields'	=> 'sco_id'
			)
		);
		$completed = Set::extract($completed,'{n}.ScormAttendeeTracking.sco_id');
		$this->set(compact('completed'));
		
	}

	function __selectLayout() {
		Configure::write('debug',0);
		$this->layout = 'default';
	}

}
?>
