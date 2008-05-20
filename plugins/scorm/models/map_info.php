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
class MapInfo extends ScormAppModel {

	var $name = 'MapInfo';
	var $useTable = 'scorm_map_infos';
	var $validate = array(
			'targetObjectiveID' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => 'scormplugin.mapinfo.targetobjectiveid.empty',
					'required' => true,
				)
			),
			'readSatisfiedStatus' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.mapinfo.readsatisfiedstatus.boolean',
					'required' => false
				)
			),
			'readNormalizedMeasure' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.mapinfo.readnormalizedmeasure.boolean',
					'required' => false)
				),
			'writeSatisfiedStatus' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.mapinfo.writesatisfiedstatus.boolean',
					'required' => false
					)
				),
			'writeNormalizedMeasure' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.mapinfo.writenormalizedmeasure.boolean',
					'required' => false
					)
				)
		);

}
?>
