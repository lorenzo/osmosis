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
class Entry extends AppModel {

	var $name = 'Entry';
	var $useTable = 'wiki_entries';
	
	/**
	 * Validation Rules for Fields
	 *
	 * @var array
	 **/
	var $validate = array(
		'wiki_id' => array(
			'required' => array(
				'rule'			=> array('custom', '/.+/'),
				'required'		=> true,
				'allowEmpty'	=> false,
				'on'			=> 'create'
			)
		),
		'member_id' => array(
			'required' => array(
				'rule'			=> array('custom', '/.+/'),
				'required'		=> true,
				'allowEmpty'	=> false,
				'on'			=> 'create'
			)
		),
		'title' => array(
			'required' => array(
				'rule'			=> array('custom', '/.+/'),
				'required'		=> true,
				'allowEmpty'	=> false,
				'on'			=> 'create'
			)
		),
		'content' => array(
			'required' => array(
				'rule'			=> array('custom', '/.+/'),
				'required'		=> true,
				'allowEmpty'	=> false,
				'on'			=> 'create'
			)
		),
	);

	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/
	var $belongsTo = array(
		// Entry BelongsTo Wiki
		'Wiki' => array(
			'className' => 'wiki.Wiki',
			'foreignKey' => 'wiki_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		),
		// Entry BelongsTo Member (Author)
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		)
	);

	/**
	 * HasMany (N-1) relation descriptors
	 *
	 * @var array
	 **/
	var $hasMany = array(
		// Entry HasMany Revision (one each time it is modified)
		'Revision' => array(
			'className' => 'wiki.Revision',
			'foreignKey' => 'entry_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'dependent' => true,
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	/**
	 * Model contructor. Initializes the validation error messages with i18n
	 *
	 * @see Model::__construct
	 */
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'title.required', __('Please set a title',true)
		);
		$this->setErrorMessage(
			'content.required', __('Please write a content for this entry',true)
		);
		parent::__construct($id,$table,$ds);
	}

	/**
	 * Attached behaviors
	 *
	 * @var array
	 **/
	var $actsAs = array(
		'Transaction',
		'Sluggable' => array('label' => 'title', 'slug' => 'slug', 'overwrite' => false, 'separator' => '_','translation' => 'utf-8'),
		'Loggable'
	);

	function save($data,$validate = true,$fields = array()) {
		$update = false;
		$this->begin();
		if (isset($data['Entry']['id'])) {
			$this->recursive = -1;
			$entry = $this->read(null,$data['Entry']['id']);
			if (!empty($entry)) {
				$update = true;
				if($entry['Entry']['content'] == $data['Entry']['content']) {
					return false;
				}
				$data['Entry']['revision'] = $entry['Entry']['revision'] + 1;
				unset($data['Entry']['wiki_id']);
				unset($data['Entry']['title']);
			}
		}
		$this->create();
		if (($result = parent::save($data,$validate,$fields))) {
			$saved = true;
			if($update) {
				$revision['Revision'] = $entry['Entry'];
				unset($revision['Revision']['id']);
				$revision['Revision']['entry_id'] = $entry['Entry']['id'];
				$revision['Revision']['created'] = $entry['Entry']['updated'];
				$this->Revision->create();
				$saved = $this->Revision->save($revision);
			}
			if ($saved) {
				$this->commit();
				return $result;
			} 
		}
		$this->rollback();
		return false;
	}

	/**
	 * Creates a new revision with the contents of a previous one
	 *
	 * @param string $id revision id
	 * @param string $revision_number number of revision to restore, if null the most recent is used
	 * @return boolean true if the operation was successful
	 */
	function restore($id,$revision_number = null) {
		$this->recurive = -1;
		$entry = $this->read(null,$id);
		if (!$entry || $entry['Entry']['revision'] == 1 || $entry['Entry']['revision'] == $revision_number) {
			return false;
		}
		if (!$revision_number)
			$revision_number = $entry['Entry']['revision'] - 1;
		$this->Revision->recursive = -1;
		$revision = $this->Revision->find(array('entry_id'=>$id,'revision'=>$revision_number));
		if (!$revision) {
			return false;
		}
		$new_entry['Entry'] = $revision['Revision'];
		$new_entry['Entry']['id'] = $id;
		unset($new_entry['Entry']['created']);
		return $this->save($new_entry);
	}
	
	/**
	 * Returns an slugged string based on the Sluggable behavior settings
	 *
	 * @param string $string 
	 * @return string
	 */
	function generateSlug($string) {
		return $this->slug($string,$this->alias);
	}

	/**
	 * Returns true if an entry has been created with a slug that matches $slug an $locators conditions
	 *
	 * @param string $slug the slug to be searched for
	 * @param array $locators an array containing the key wiki_id or course_id
	 * @return boolean
	 */
	function created($slug,$locators = array()) {
		$conditions = array('slug' => $slug);
		if (isset($locators['wiki_id']))
			$conditions['wiki_id'] = $locators['wiki_id'];
			
		if (isset($locators['course_id']))
			$conditions['course_id'] = $locators['course_id'];
		$count = $this->find('count',array('conditions' => $conditions));
		return $count === 1;
	}

}
?>