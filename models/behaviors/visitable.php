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
class VisitableBehavior extends ModelBehavior {
	var $field;
	var $__settings;
	
	function setup(&$Model, $settings = array()) {
		$this->__settings[$Model->alias]['field'] = Inflector::underscore($Model->alias) . '_visit_count';
		if (isset($settings['field'])) {
			$this->__settings[$Model->alias]['field'] = $settings['field'];
		}
	}
	
	function beforeFind(&$Model, $query) {
		if (!isset($query['count_view'])) return true;
		$id = $query['conditions'][$Model->alias . '.' . $Model->primaryKey];
		$this->__settings[$Model->alias][$id] = true;
		return true;
	}
	
	function afterFind(&$Model, $data) {
		if (count($data)!=1) return true;
		$data = $data[0];
		if (!isset($data[$Model->alias][$Model->primaryKey])) return true;
		$id = $data[$Model->alias][$Model->primaryKey];
		if (!isset($this->__settings[$Model->alias][$id])) return true;
		$theModel = new $Model->name;
		$theModel->recursive = -1;
		$theModel->updateAll(
			array($this->__settings[$Model->alias]['field'] => $this->__settings[$Model->alias]['field'] . ' + 1'),
			array($Model->alias . '.' . $Model->primaryKey => $id)
		);
		unset($this->__settings[$Model->alias][$id]);
		return true;
	}
}
?>
