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
class RevisionsController extends WikiAppController {
	var $name = 'Revisions';
	var $helpers = array('Html','Time','Wiki');
	var $components = array('Diff');
	
	function _setActiveCourse() {
		if (!isset($this->params['named']['course_id']) && isset($this->params['named']['wiki_id'])) {
			$this->activeCourse = $this->Revision->Entry->Wiki->field('course_id',array('id' => $this->params['named']['wiki_id']));
		} else
			parent::_setActiveCourse();
	}
	
	function history($entry_id) {
		$this->Revision->recursive = 0;
		$this->Revision->Entry->recursive = 0;
		$this->set('entry',$this->Revision->Entry->read(null,$entry_id));
		$this->paginate['order'] = 'Revision.created DESC';
		$this->set('revisions', $this->paginate(array('entry_id'=>$entry_id)));
	}
	
	function diff($entry_id, $revision_id = null) {
		$this->Revision->Entry->recursive = 0;
		$entry = $this->Revision->Entry->read(null, $entry_id);
		
		$this->Revision->recursive = -1;
		$order = 'created DESC';
		if ($revision_id) {
			$conditions = array('entry_id' => $entry_id, 'Revision.id <=' => $revision_id);
			$limit = 2;
			$revisions = $this->Revision->find('all', compact('conditions', 'limit', 'order'));
			$content1 = $revisions[0]['Revision']['content'];
			$rev1 = $revisions[0]['Revision']['revision'];
			$content2 = $revisions[1]['Revision']['content'];
			$rev2 = $revisions[1]['Revision']['revision'];
		} else {
			$conditions = array('entry_id' => $entry_id);
			$limit = 1;
			$revision = $this->Revision->find('first', compact('conditions', 'limit', 'order'));
			$content1 = $entry['Entry']['content'];
			$rev1 = null;
			$content2 = $revision['Revision']['content'];
			$rev2 = $revision['Revision']['revision'];
		}
		
		$diff = $this->Diff->formatted_diff($content2, $content1);
		$this->set(compact('entry', 'diff', 'content1', 'content2', 'rev1', 'rev2', 'entry'));
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('wiki','Invalid Revision',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('revision', $this->Revision->read(null, $id));
	}
}
?>
