<?php
class MapInfo extends ScormAppModel {

	var $name = 'MapInfo';
	var $validate = null;
	var $primaryKey = 'id';
	var $table = 'map_infos';
	function __construct() {
		$this->validate = array(
			'targetObjectiveID' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => __('scormplugin.mapinfo.targetobjectiveid.empty', true),
					'required' => true,
				)
			),
			'readSatisfiedStatus' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.mapinfo.readsatisfiedstatus.boolean', true),
					'required' => false
				)
			),
			'readNormalizedMeasure' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.mapinfo.readnormalizedmeasure.boolean', true),
					'required' => false)
				),
			'writeSatisfiedStatus' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.mapinfo.writesatisfiedstatus.boolean', true),
					'required' => false
					)
				),
			'writeNormalizedMeasure' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.mapinfo.writenormalizedmeasure.boolean', true),
					'required' => false
					)
				)
		);
	}
}
?>