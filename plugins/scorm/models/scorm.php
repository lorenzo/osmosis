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
App::import('Core','Xml');
App::import('Core','File');
class Scorm extends ScormAppModel {
	var $name = 'Scorm';
	var $useTable = 'scorm_scorms';
	var $validate = array(
		'name'=> array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'description' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'course_id' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		)
	);
	var $actsAs = array('transaction');
	var $parsed = false;
	var $hasMany = array('Sco' => array('className' => 'Scorm.Sco',
								'foreignKey' => 'scorm_id',
								'dependent' => true));
	/**
	 * Returns whether there is a imsmanifest.xml file in a folder
	 * @param $path String directory where imsmanifest.xml will be looked for
	 * @return true if imsmanifest.xml file exist in $path, false otherwise
	 */
	function manifestExists($path) {
		$manifest = new File($path.DS.'imsmanifest.xml');
		return $manifest->exists();
	}
	
	/**
	 * Fills model data with a representation of the xml manifest. 
	 * The array follows the array achitechture specified by cakephp to save data to a model
	 * @param $path string the path where the imsmanifest.xml is.
	 * @return boolean true if it was parsed false if manifest does not exist
	 */
	function parseManifest($path) {
		if(!$this->parsed) {
	         if(!$this->manifestExists($path)) {
	            return false;
    	    }
    		$manifest = $this->__getXMLParser();
    		$manifest->load($path.DS.'imsmanifest.xml');
    		$m = $manifest->first();
    		$this->data['Scorm']['version'] = $this->getSchemaVersion($m);
    		$this->data['Scorm']['identifier'] = $this->getNodeIdentifier($m);
    		$this->data['Resource'] = $this->extractResources($m);
    		// TODO: Implement <imsss:sequencingCollection>
    		$this->data['Organization'] = $this->extractOrganizations($m);
    		unset($this->data['Resource']);
    		$this->parsed = true;
	    }
	    return true;
	}
	
	/**
	 * Returns a reference to the xml parser.
	 * @return XML parser object.
	 */
	function __getXMLParser() {
		$xml_obj = new Xml();
		return $xml_obj;
	}
	
	/**
	 * Returns the identifier attribute of a node
	 * @param $node XmlNode with identifier attribute.
	 * @return string identifier attribute of $node
	 */
	function getNodeIdentifier(XmlNode $node) {
		return $node->attributes['identifier'];
	}
	
	/**
	 * Returns the value of the schemaversion tag inside metadata
	 * @param $node XmlNode manifest node with metadata child.
	 * @return string value of schemaversion node
	 * 
	 * usage: given the xml
	 * <manifest [...]>
	 * 	<metadata>
	 * 		<schemaversion>2004 3rd Edition</schemaversion>
	 * 	</metadata>
	 * </manifest>
	 * Return the value of the schemaversion element.
	 */
	function getSchemaVersion($node) {
		$metadata = $node->children('metadata');
		unset($metadata->__parent);
		if(count($metadata)) {
			$metadata = $metadata[0];
			$version = $metadata->children('schemaversion');
			$value = $version[0]->children('#text');
			return $value[0]->value;
		}
		return null;
	}
	
	/**
	 * Returns array with a representation of the resources of a manifest.
	 * @param $manifest XmlNode manifest node
	 * @return array representation of the resources of a manifest
	 * 
	 * usage: given the xml
	 * <resources>
	 * 	<resource identifier="RESOURCE1" adlcp:scormType="sco" type="webcontent" href="lesson1.htm">
	 * 		<file href="lesson1.htm"/>
	 * 	</resource>
	 * 	[...]
	 * </resources>
	 * Returns an array containing all <resource> elements data:
	 * array (
	 * 	array (
	 * 		'RESOURCE1' => array (
	 * 			'identifier' => 'RESOURCE1',
	 * 			'adlcp:scormType' => 'sco',
	 * 			'type' => 'webcontent',
	 * 			'href' => 'localitem1.html',
	 * 	), [...]
	 * );
	 */
	function extractResources($manifest) {
		$nodes = $manifest->children('resources');
		$resources = array();
		foreach($nodes as $node) {
			$res = $node->children('resource');
			foreach ($res as $resource) {
				$resources[$resource->attributes['identifier']] = $resource->attributes;
			}
		}
		return $resources;
	}
	
	/**
	 * Returns array with a representation of the organizations of a manifest.
	 * @param $manifest XmlNode manifest node
	 * @return array representation of the organizations of a manifest
	 * @see extractSequencing 
	 * @see getLocationFromMetadata
	 * 
	 * usage: given the xml
	 * <organizations default="DMCE">
	 * 	<organization identifier="DMCE">
	 * 		<title>SCORM 2004 3rd Edition Data Model Content Example 1.1</title>
	 * 		[...]
	 * 	</organization>
	 * 	[...]
	 * </organizations>
	 * Returns an array containing all <organization> elements:
	 * array(
	 * 	'DMCE' => array (
	 * 		'identifier' => 'DMCE'
	 * 		'title' => 'SCORM 2004 3rd Edition Data Model Content Example 1.1'
	 * 		'Item' => array([...]),
	 * 		'Sequencing' => array ([...])
	 * 		'Metadata' => [...]
	 * 	), [...]
	 * );
	 */
	function extractOrganizations($manifest) {
		$nodes = $manifest->children('organizations');
		$organizations = array();
		$i = 0;
		foreach($nodes as $node) {
			if($node->hasChildren()) {
				$organization[$i]['default'] = $node->attributes['default'];
			}
			$orgs = $node->children('organization');
			foreach ($orgs as $organization) {
				$identifier = $organization->attributes['identifier'];
				$organizations[$identifier] = $organization->attributes;
				$organizations[$identifier]['metadata'] = $this->getLocationFromMetadata($organization);
				$organizations[$identifier]['title'] = $this->getChildrenValue($organization,'title');
				$organizations[$identifier]['Sequencing'] = $this->extractSequencing($organization);
				$organizations[$identifier]['Item'] = $this->extractItems($organization);
				
			}
			$i++;
		}
		return $organizations;
	}
	
	/**
	 * Returns array with a representation of the <imsss:sequencing> element.
	 * Note: this function deliberately ignores the <auxiliaryResources> element.
	 * @param $node XmlNode a node with a imsss:sequencing children node
	 * @return array representation of the <imsss:sequencing> node and its element and attributes.
	 * 
	 * usage: given the xml 
	 * <imsss:sequencing ID="pretest">dl
	 * 	<imsss:controlMode .../>
	 * 	<imsss:sequencingRules> [...] </imsss:sequencingRules>
	 * 	<imsss:limitConditions .../>
	 * 	<imsss:rollupRules ...> [...] </imsss:rollupRules>
	 * 	<imsss:objectives> [...] </imsss:objectives>
	 * 	<imsss:randomizationControls ... />
	 * 	<imsss:deliveryControls .../>
	 * 	<adlseq:constrainedChoiceConsiderations .../>
	 * 	<adlseq:rollupConsiderations .../>
	 * </imsss:sequencing>
	 * 
	 * (AuxiliaryResources ignored)
	 * Returns:
	 * array (
	 * 	'Control' => array ( ... ),
	 * 	'SequencingRule' => array ( [...] ),
	 * 	'LimitCondition' => array ( ... ),
	 * 	'RollupRule' => array ([...] ),
	 * 	'Objective' => array ( [...] ),
	 * 	'Randomization' => array ( ... ),
	 * 	'DeliveryControl' => array ( ... ),
	 * 	'Choice' => array ( ... ),
	 * 	'Consideration' => array ( ... ),
	 * )
	 */
	function extractSequencing(XmlNode $parent) {
		$data = array();
		$seq = $parent->children('sequencing');
		if(!empty($seq)) {
			$seq = $seq[0];
			$control = $seq->children('controlMode');
			if(!empty($control)) {
				$data['Control'] = $control[0]->attributes;
			}
			$data['SequencingRule'] = $this->extractSeqRules($seq);
			$limit = $seq->children('limitConditions');
			if(!empty($limit)) {
				$data['LimitCondition'] = $limit[0]->attributes;
			}
			//$aux = $seq->children('auxiliaryResources'); ADL discourages it's use
			$rollup = $seq->children('rollupRules');
			if(!empty($rollup)) {
				$data['RollupRule'] = $this->extractRulesData($rollup,'rollup');
			}
			$objectives = $seq->children('objectives');
			if(!empty($objectives)) {
				$data['Objective'] = $this->extractObjectives($objectives[0]);
			}
			$randomization = $seq->children('randomizationControls');
			if(!empty($randomization)) {
				$data['Randomization'] = $randomization[0]->attributes;
			}
			$delivery = $seq->children('deliveryControls');
			if(!empty($delivery)) {
				$data['DeliveryControl'] = $delivery[0]->attributes;
			}
			$choice = $seq->children('constrainedChoiceConsiderations');
			if(!empty($choice)) {
				$data['Choice'] = $choice[0]->attributes;
			}
			$considerations = $seq->children('rollupConsiderations');
			if(!empty($considerations)) {
				$data['Consideration'] = $considerations[0]->attributes;
			}
		}
		return $data;
	}
	
	/**
	 * Returns array with a representation of the rules inside a <imsss:sequencingRules> element.
	 * @param $seq XmlNode node parent of the <imsss:sequencingRules> element.
	 * @return array representation of the <imsss:sequencingRules> node and its element and attributes.
	 * 
	 * usage: given the xml.
	 * <imsss:sequencingRules>
	 * 	<imsss:preConditionRule> [...] </imsss:preConditionRule>
	 * 	<imsss:postConditionRule> [...] </imsss:postConditionRule>
	 * 	<imsss:exitConditionRule> [...] </imsss:exitConditionRule>
	 * </imsss:sequencingRules>
	 * Return an array containing the representation of the contents of <imsss:sequencingRules>
	 * array (
	 *	'Pre' => array (
	 * 		'Condition' => array ( ... ),
	 * 		'Action' => array ( ... )
	 * 	),
	 * 	'Post' => array (
	 * 		'Condition' => array ( ... ),
	 * 		'Action' => array ( ... )
	 * 	),
	 * 	'Exit' => array (
	 * 		'Condition' => array ( ... ),
	 * 		'Action' => array( ... )
	 * 	)
	 * );
	 */
	function extractSeqRules(XmlNode $seq) {
		$rules = array();
		$seqRules = $seq->children('sequencingRules');
		if(!empty($seqRules)) {
			$seqRules = $seqRules[0];
			$pre = $seqRules->children('preConditionRule');
			if(!empty($pre)) {
				$rules['Pre'] = $this->extractRulesData($pre);
			}
			$post = $seqRules->children('postConditionRule');
			if(!empty($post)) {
				$rules['Post'] = $this->extractRulesData($post);
			}
			$exit = $seqRules->children('exitConditionRule');
			if(!empty($exit)) {
				$rules['Exit'] = $this->extractRulesData($exit);
			}
		}
		return $rules;
	}
	
	/**
	 * Extracts the data of the rules inside <imsss:sequencingRules> elements (pre, post and exit) or 
	 * inside <imsss:rollupRules> element (rollupRule element).
	 * @param $node XmlNode node any of the following elements:
	 * 	<imsss:preConditionRule>
	 * 	<imsss:postConditionRule>
	 * 	<imsss:exitConditionRule> or
	 * 	<imsss:rollupRules>
	 * @return array representation of the node and its element and attributes.
	 * 
	 * usage: given the xml 
	 * 	<imsss:[pre|post|exit]ConditionRule> [...] </imsss:preConditionRule>
	 * OR
	 * 	<imsss:rollupRules> [...] </imsss:rollupRules>
	 * 
	 * Return an array representing the content of the node received (rollupConditions and rollupAction)
	 * array (
	 * 	[rollupRule attributes] // Only in case of RollUpRules element.
	 * 	'Condition' => array ( ... ),
	 * 	'Action' => array ( ... )
	 * );
	 */
	function extractRulesData($nodes,$name='rule') {
		$data = array();
		foreach($nodes as $key => $node) {
    		if ($name == 'rollup') {
    			$data[$key] = $node->attributes;
    			$node = $node->children("{$name}Rule");
    			if ($node==null) return $data;
    			$node = $node[0];
    		}
    		$conditions = $node->children("{$name}Conditions");
    		$conditions = $conditions[0];
    		$data[$key]['Condition'] = $conditions->attributes;
    		$i = 0;
    		foreach($conditions->children as $condition) {
    			$data[$key]['Condition'][$i] = $condition->attributes;
    			$i++; 
    		}
    		$action = $node->children("{$name}Action");
    		$data[$key]['Action'] = $action[0]->attributes;
		}
		return $data;
	}
	
	/**
	 * Returns array with a representation of the contents of the <imsss:objectives> element (primary and objective) 
	 * @param $node XmlNode nore <imsss:objectives>
	 * @return array representation of the <imsss:objectives> node's elements and attributes.
	 * 
	 * usage: given the xml
	 * <imsss:objectives>
	 * 	<imsss:primaryObjective objectiveID = "PRIMARYOBJ" satisfiedByMeasure = "true">
	 * 		[...]
	 * 	</imsss:primaryObjective>
	 * 	<imsss:objective satisfiedByMeasure = "false" objectiveID="obj_module_1">
	 * 		[...]
	 * 	</imsss:objective>
	 * </imsss:objectives>
	 * Return an array containing the representation of the contents of <imsss:objectives>
	 * array (
	 * 	'Primary' => array (
	 * 		'objectiveID' => 'PRIMARYOBJ',
	 * 		'satisfiedByMeasure' => 'true',
	 * 		'minNormalizedMeasure' => '0.6',
	 * 		'mapInfo' => array ( ... )
	 * 	),
	 * 	'Objective' => array (
	 * 		'satisfiedByMeasure' => 'false',
	 * 		'objectiveID' => 'obj_module_1',
	 * 		'mapInfo' => array ( ... )
	 * 	)
	 * );
	 */
	function extractObjectives(XmlNode $node) {
		$objectives = array();
		$primary = $node->children('primaryObjective');
		$objectives['Primary'] = $this->extractObjectiveData($primary[0]);
		foreach($node->children('objective') as $objective) {
			$objectives['Objective'][] =  $this->extractObjectiveData($objective);
		}
		return $objectives;
	}
	
	/**
	 * Returns array with a representation of an <objective> element (primary or objective)
	 * @param $node XmlNode with either a <imsss:primaryObjective> or <imsss:objective>
	 * @return array representation of a node's elements.
	 * 
	 * usage: given the xml.
	 * <imsss:primaryObjective objectiveID = "PRIMARYOBJ" satisfiedByMeasure = "true">
	 * 	<imsss:minNormalizedMeasure>0.6</imsss:minNormalizedMeasure>
	 * 	<imsss:mapInfo ... />
	 * </imsss:primaryObjective>
	 * Return an array containing the representation of the contents of <objective> element.
	 * See ScormModel::extractObjectives
	 */
	function extractObjectiveData(XmlNode $node) {
		$data = $node->attributes;
		$minNormalizedMeasure = $this->getChildrenValue($node,'minNormalizedMeasure');
		if($minNormalizedMeasure != null) 
			$data['minNormalizedMeasure'] = $minNormalizedMeasure;
		$mapInfos = $node->children('mapInfo');
		foreach($mapInfos as $map) {
			$data['mapInfo'][] = $map->attributes;
		}
		return $data;
	}
	
	/**
	 * Returns array with a representation of the items of a node
	 * @param $parent XmlNode parent node with <item> child nodes
	 * @return array representation of node's items.
	 * 
	 * usage: given the xml.
	 * <whatever>
	 * 	<item identifier="WELCOME1" isvisible="false" parameters="?width=500&#038;length=300">
	 * 		<title>Welcome</title>
	 * 		<item> [...] </item>
	 * 		<metadata> [...] </metadata>
	 * 		<adlcp:timeLimitAction>exit,no message</adlcp:timeLimitAction>
	 * 		<adlcp:dataFromLMS>Some SCO Information</adlcp:dataFromLMS>
	 * 		<adlcp:completionThreshold>0.75</adlcp:completionThreshold>
	 * 		<imsss:sequencing> [...] </imsss:sequencing>
	 * 		<adlnav:presentation> [...] </adlnav:presentation>
	 * 	</item>
	 * 	[...]
	 * </whatever>
	 * Returns the array representation of all items and its elements and attributes.
	 * array (
	 * 	'WELCOME1' => array (
	 * 		'identifier' => 'WELCOME1',
	 * 		'isvisible' => 'false',
	 * 		'parameters' => '?width=500&length=300',
	 * 		'title' => 'Welcome',
	 * 		'metadata' => [...],
	 * 		'timeLimitAction' => 'exit,no message',
	 * 		'dataFromLMS' => 'Some SCO Information',
	 * 		'completionThreshold' => '0.75',
	 * 		'Sequencing' => array ( [...] ),
	 * 		'SubItem' => array ( [...] ),
	 * 		'Presentation' => array ( [...] )
	 * 	)
	 * );
	 */
	function extractItems($parent) {
		$items = array();
		$nodes = $parent->children('item');
		foreach($nodes as $item) {
			$identifier = $this->getNodeIdentifier($item);
			$items[$identifier] = $item->attributes;
			$title = $item->children('title');
			if(isset($item->attributes['identifierref'])) {
				$resource = $this->data['Resource'][$item->attributes['identifierref']];
				unset($resource['identifier']);
				if((isset($this->data['Scorm']['base']) || isset($this->data['Scorm']['base']))  || isset($resource['base']) && isset($resource['href'])) {
					@$resource['href'] =
						$this->data['Scorm']['base'] .
						$this->data['Resource']['base'] .
						$resource['base'] .
						$resource['href'];
				}
				$items[$identifier] = am($items[$identifier],$resource);
				$items[$identifier]['scormType'] = (!isset($items[$identifier]['scormType'])) ? 'sco' : $items[$identifier]['scormType'] ;
			}
			$items[$identifier]['title'] =  $title[0]->first()->value;
			$items[$identifier]['metadata'] = $this->getLocationFromMetadata($item);
			$items[$identifier]['timeLimitAction'] = $this->getChildrenValue($item,'timeLimitAction');
			$items[$identifier]['dataFromLMS'] = $this->getChildrenValue($item,'dataFromLMS');
			$items[$identifier]['completionThreshold'] = $this->getChildrenValue($item,'completionThreshold');
			$items[$identifier]['Sequencing'] = $this->extractSequencing($item);
			$items[$identifier]['Presentation'] = $this->extractPresentation($item);
			$items[$identifier]['SubItem'] = $this->extractItems($item);
		}
		return $items;
	}

	/**
	 * Returns value of the $node's $tagname children
	 * @param $parent XmlNode parent node with $tagname child node
	 * @return string value of $tagName.
	 */
	function getChildrenValue($node,$tagName) {
		if ($node == null){
			return null;
		}
		$data = $node->children($tagName);
		if (count($data)) {
			if ($data[0]->hasChildren() && is_a($node = $data[0]->first(),'XmlTextNode'))
				return $node->value;
			return $data[0]->value;
		}
		return null;
	}
	
	/**
	 * Returns array with a representation of the <adlnav:presentation> element and its elements and attributes.
	 * @param $node XmlNode node with a <adlnav:presentation> children.
	 * @return array representation of the <adlnav:presentation> node's elements and attributes.
	 * 
	 * usage: given the xml.
	 * <adlnav:presentation>
	 * 	<adlnav:navigationInterface>
	 * 		<adlnav:hideLMSUI>continue</adlnav:hideLMSUI>
	 * 		<adlnav:hideLMSUI>previous</adlnav:hideLMSUI>
	 * 	</adlnav:navigationInterface>
	 * </adlnav:presentation>
	 * Returns the array:
	 * array (
	 * 	'continue',
	 * 	'previous'
	 * );
	 */
	function extractPresentation(XmlNode $node) {
		$presentation = $node->children('presentation');
		$data = array();
		if(!empty($presentation)) {
			$navigation = $presentation[0]->children('navigationInterface');
			if(!empty($navigation)) {
				foreach($navigation[0]->children as $hideLMS) {
					$data[] = $hideLMS->first()->value;
				}
			}
		}
		return $data;
	}
	
	/**
	 * 
	 */
	function getLocationFromMetadata($parent) {
		$metadata = $parent->children('metadata');
		if ($metadata != null){
			$metadata = $metadata[0];
			return $this->getChildrenValue($metadata,'location');
		}
		return null;
	}
	
	
	function save($data=null,$validate=true,$fields=array()) {
	    if($this->parsed) {
	        $data= Set::merge($data,$this->data); 
	    }
		$this->begin();
		$saved = parent::save($data,$validate,$fields);
		if($saved) {
			$data['Organization'] = (isset($data['Organization'])) ? $data['Organization'] : array();
			foreach($data['Organization'] as $org){
			$scos = Set::extract($org,'Item');
				foreach($scos as $sco) {
					$this->Sco->create();
					$sco['organization'] = $org['identifier'];
					$sco['manifest'] = $data['Scorm']['identifier'];
					$sco['scorm_id'] = $this->getLastInsertId();
					$saved = $this->Sco->save($sco); 
					if(!$saved) 
							break;
				}	
					if(!$saved)
						break;
			}
		}
		if($saved) {
			$this->commit();
		} else {
			$this->rollback();
		}
		return $saved;
	}
}
?>
