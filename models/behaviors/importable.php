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


class ImportableBehavior extends ModelBehavior {
	var $errors = array();
	
	function setup(&$Model, $settings = array()) {
		if (!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = array(
				'maxLength' => 2000,
				'delimiter' => ';',
				'enclosure' => '"',
				'hasHeader' => true 
			);
		}
		if (!is_array($settings)) {
			$settings = array();
		}
		$this->settings[$Model->alias] = array_merge($this->settings[$Model->alias], $settings);
	}
	
	function _getCSVLine(&$Model,$fp) {
		return fgetcsv(
			$fp,
			$this->settings[$Model->alias]['maxLength'],
			$this->settings[$Model->alias]['delimiter'],
			$this->settings[$Model->alias]['enclosure']
		);
	}
	
	function _getHeader(&$Model,$handle) {
		if ($this->settings[$Model->alias]['hasHeader'] === true) {
        	$header = $this->_getCSVLine($Model,$handle);
        } else {
        	$header = array_keys($Model->schema());
        }
        return $header;
	}
	
	function importCSV(&$Model,$file,$returnSaved = false) {
	
		if (!file_exists($file))
			return false;
		
        $handle = fopen($file, "r");
        $header = $this->_getHeader($Model,$handle);
        
        $db =& ConnectionManager::getDataSource($Model->useDbConfig);
        $db->begin($Model);
        
        $saved = array();
        $i = 0;
        while (($row = $this->_getCSVLine($Model,$handle)) !== false) {
                $data = array();

                foreach ($header as $k => $col) {
                        // get the data field from Model.field
                        if (strpos($col,'.') !== false) {
                                list($model,$field) = explode('.',$col);
                                $data[$model][$field]= (isset($row[$k])) ? $row[$k] : '';
                        }
                        else {
                                $data[$Model->alias][$col]= (isset($row[$k])) ? $row[$k] : '';
                        }
                }
                $Model->create();
                
                $Model->id = isset($data[$Model->alias][$Model->primaryKey]) ? $data[$Model->alias][$Model->primaryKey] : false;
               
                //beforeImport callback
                if (method_exists($Model,'beforeImport'))
                	$data = $Model->beforeImport($data);
                	
                $error = false;
                $Model->set($data);
                if (!$Model->validates()) {
                        $this->errors[$Model->alias][$i]['validation'] = $Model->validationErrors;
                        $error = true;
                }

                // save the row
                if (!$error && !$Model->saveAll($data,array('validate' => false,'atomic' => false)))
                         $this->errors[$Model->alias][$i]['save'] = sprintf(__('%s for Row %d failed to save.',true),$Model->alias,$i);

				if ($returnSaved)
					$saved[] = $data;
                $i++;
        }
        
        fclose($handle);
       	$success = empty($this->errors);
       	
       	if (!$success) {
       		$db->rollback($Model);
       		return false;
       	}
       	
       	$db->commit($Model);
       	
       	if ($returnSaved) {
       		return $saved;
       	}
       	
       	return true;
   }
}
?>
