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
	var $helpers = array('Html', 'Form', 'Cache' );
	var $uses = array('Scorm.Sco', 'Scorm.Scorm', 'Scorm.ScormAttendeeTracking');
	var $cacheAction = array('view/' => '1 hour');
	
	function beforeFilter() {
		if (isset($this->RequestHandler) && $this->action == 'view')
			unset($this->RequestHandler);
		parent::beforeFilter();
	}
	
	function index() {
		$this->Sco->recursive = 0;
		$this->set('scos', $this->paginate());
	}
	
	function api($id) {
		Configure::write('debug',0);
		$trackings = $this->ScormAttendeeTracking->findAll(
			array(
				'student_id' => $this->Session->read('Member.id'),
				'sco_id' => $id
			)
		);
		$t = array();
		foreach($trackings as $tracking) {
			$t[$tracking['ScormAttendeeTracking']['datamodel_element']] = 
				$tracking['ScormAttendeeTracking']['value'];
		}
		$trackings = $t;
		$this->set(compact('trackings'));
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
		$extension = str_replace('.', '', strrchr($this->params['url']['url'], '.'));
		$path = isset($this->params['url']['ext']) ? $path . '.' . $extension : $path;
		$this->set('extension', $extension);
		$this->set('path', $path);
		$this->view = 'Media';
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Sco->create();
			if ($this->Sco->save($this->data)) {
				$this->Session->setFlash(__('The Sco has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Sco could not be saved. Please, try again.',true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Sco',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Sco->save($this->data)) {
				$this->Session->setFlash(__('The Sco saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Sco could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Sco->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Sco',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Sco->del($id)) {
			$this->Session->setFlash(__('Sco #'.$id.' deleted'),true);
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
