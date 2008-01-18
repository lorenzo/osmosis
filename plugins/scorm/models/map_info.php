<?php
class MapInfo extends ScormAppModel {

	var $name = 'MapInfo';
	var $useTable = 'scorm_scorm_map_infos';
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
