<?php
class Scorm extends ScormAppModel {
	var $name = 'Scorm';
	var $validate = array(
		'name'		=> array(
							'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
						),
		'description' => array(
							'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
						),
		'course_id' => array(
							'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
						)
	);
	
	/*
	 * Returns if there is a imsmanifest.xml file in a folder
	 * @param $path String directory where imsmanifest.xml will be looked for
	 * @return true if imsmanifest.xml file exist in $path, false otherwise
	 */
	function manifestExists($path) {
		uses('File');
		$manifest = new File($path.DS.'imsmanifest.xml');
		return $manifest->exists();
	}
	
	/*
	 * Returns an array with a representation of the xml manifest. 
	 * The array follows the array achitechture specified by cakephp to save data to a model
	 * @param $path string the path where the imsmanifest.xml is.
	 * @return array representation of imsmanifest.xml
	 */
	function parseManifest($path) {
		uses('xml');
		$manifest = new XML();
		$manifest->__parser = xml_parser_create();
		xml_set_object($manifest->__parser, $manifest);
		xml_parser_set_option($manifest->__parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($manifest->__parser, XML_OPTION_SKIP_WHITE, 1);
		$manifest->load($path.DS.'imsmanifest.xml');
		$data = array();
		$m = $manifest->first();
		$data['Scorm']['version'] = $this->getSchemaVersion($m);
		$data['Scorm']['identifier'] = $this->getNodeIdentifier($m);
		$data['Organization'] = $this->extractOrganizations($m);
		$data['Scorm']['Resources'] = $this->extractResources($m);
		//debug($data);

	}
	
	/*
	 * Returns the identifier attribute of a node
	 * @param $node XMLNode
	 * @return string identifier attribute of $node
	 */
	function getNodeIdentifier(XMLNode $node) {
		return $node->attributes['identifier'];
	}
	
	/*
	 * Returns the value of the schemaversion tag inside metadata
	 * @param $node XMLNode parent node with metadata child
	 * @return string value of schemaversion node
	 */
	function getSchemaVersion($node) {
		$metadata = $node->children('metadata');
		if(count($metadata)) {
			$metadata = $metadata[0];
			$version = $metadata->children('schemaversion');
			return $version[0]->value;
		}
		return null;
	}
	
	/*
	 * Returns array with a representation of the resources of a manifest
	 * @param $manifest XMLNode manifest node
	 * @return array representation of the resources of a manifest
	 */
	function extractResources($manifest) {
		$nodes = $manifest->children('resources');
		$resources = array();
		foreach($nodes as $node) {
			foreach ($node->children('resource') as $resource) {
                    $resources[$resource->attributes['identifier']] = $resource->attributes;
			}
		}
		return $resources;
	}
	
	/*
	 * Returns array with a representation of the organizations of a manifest
	 * @param $manifest XMLNode manifest node
	 * @return array representation of the organizations of a manifest
	 */
	function extractOrganizations($manifest) {
		$nodes = $manifest->children('organizations');
		$organizations = array();
		$i = 0;
		foreach($nodes as $node) {
			if($node->hasChildren()) {
				$organization[$i]['default'] = $node->attributes['default'];
			}
			foreach ($node->children('organization') as $organization) {
                    $organizations[$organization->attributes['identifier']] = $organization->attributes;
                    if($title =  $organization->children('title')) {
                    	$organizations[$organization->attributes['identifier']]['title'] = $title[0]->value;
                    }
                    $organizations[$organization->attributes['identifier']]['Sequencing'] = $this->extractSequencing($organization);
                    $organizations[$organization->attributes['identifier']]['Item'] = $this->extractItems($organization);
			}
			$i++;
		}
		return $organizations;
	}
	
	/*
	 * Unfinished
	 */
	function extractSequencing(XMLNode $parent) {
		$data = array();
		$seq = $parent->children('imsss:sequencing');
		if(!empty($seq)) {
			$seq = $seq[0];
			$control = $seq->children('imsss:controlMode');
			if(!empty($control)) {
				$data['Control'] = $control[0]->attributes;
			}
			$data['SequencingRules'] = $this->extractSeqRules($seq);
			$limit = $seq->children('limitConditions');
			$aux = $seq->children('auxiliaryResources');
			$rollup = $seq->children('rollupRules');
			$objectives = $seq->children('objectives');
			$randomization = $seq->children('randomizationControls');
			$delivery = $seq->children('deliveryControls');
			$considerations = $seq->children('adlseq:rollupConsiderations');
			$choice = $seq->children('adlseq:constrainedChoiceConsiderations');
		}
		return $data;
	}
	
	function extractSeqRules(XMLNode $seq) {
		$rules = array();
		$seqRules = $seq->children('imsss:sequencingRules');
		if(!empty($seqRules)) {
			$seqRules = $seqRules[0];
			$pre = $seqRules->children('imsss:preConditionRule');
			if(!empty($pre)) {
				$rules['Pre'] = $this->extractRulesData($pre[0]);
			}
			$post = $seqRules->children('imsss:postConditionRule');
			if(!empty($post)) {
				$rules['Post'] = $this->extractRulesData($post[0]);
			}
			$exit = $seqRules->children('imsss:exitConditionRule');
			if(!empty($exit)) {
				$rules['Exit'] = $this->extractRulesData($exit[0]);
			}
		}
		return $rules;
	}
	
	function extractRulesData(XMLNode $node) {
		$conditions = $node->children('imsss:ruleConditions');
		$conditions = $conditions[0];
		$data = array();
		$data['Condition'] = $conditions->attributes;
		$i = 0;
		foreach($conditions->children as $condition) {
			$data['Condition'][$i] = $condition->attributes;
			$i++; 
		}
		$action = $node->children('imsss:ruleAction');
		$data['Action'] = $action[0]->attributes;
		return $data;
	}
	
	/*
	 * Returns array with a representation of the items of a node
	 * @param $parent XMLNode parent node with item child nodes
	 * @return array representation of node's items
	 */
	function extractItems($parent) {
		$items = array();
		$nodes = $parent->children('item');
		foreach($nodes as $item) {
			$items[$item->attributes['identifier']] = $item->attributes;
			$title = $item->children('title');
			$identifier = $this->getNodeIdentifier($item);
			$items[$identifier]['title'] =  $title[0]->value;
			$items[$identifier]['time_limit_action'] = $this->getItemData($item,'timeLimitAction');
			$items[$identifier]['data_from_lms'] = $this->getItemData($item,'dataFromLMS');
			$items[$identifier]['completion_threshold'] = $this->getItemData($item,'completionThreshold');
			$items[$identifier]['Sequencing'] = $this->extractSequencing($item);
			$items[$identifier]['Item'] = $this->extractItems($item);
		}
		return $items;
	}
	
	/*
	 * Returns value of $tagname inside parent $node
	 * @param $parent XMLNode parent node with $tagname child node
	 * @return string value of $tagName
	 */
	function getItemData($node,$tagName) {
		$data = $node->children($tagName);
		if(count($data)) {
			return $data[0]->value;
		}
		return null;
	}
}