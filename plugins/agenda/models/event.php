<?php
class Event extends AgendaAppModel {
	var $name = 'Event';
	var $useTable = 'agenda_events';
	var $validate = array(
		'date' => array(
			'valid' => array(
				'rule' => array('custom','/.+/'),'allowEmpty' => false, 'on' => 'create'
				)
			),
		'location' => array(
			'valid' =>  array(
				'rule' => array('custom','/.+/'),'required' => false,'allowEmpty' => true
				)
			),
		'all_day' => array(
			'valid' =>  array(
				'rule' => array('custom','/[0-1]/'),'required' => false,'allowEmpty' => true
				)
			),
		'headline' => array(
			'valid' =>  array(
				'rule' => array('custom','/.+/'),'allowEmpty' => false
				)
			),
		'detail' => array(
			'valid' =>  array(
				'rule' => array('custom','/.+/'),'required' => false,'allowEmpty' => true
				)
			),
		);
	
	var $actsAs = array('Taggable');
	var $belongsTo = array(
		'Course' => array('className' => 'Course','fields' => array('id','code','name')),
		'Member' => array('className' => 'Member','fields' => array('id','username','full_name'))
	);
	
	
	function thisMonth($options) {
		if (!(isset($options['month']) && !empty($options['month']) && is_numeric($options['month']) && Validation::between($options['month'],1,12)))
			$options['month'] = date('n');
			
		if (!(isset($options['year']) && !empty($options['year']) && is_numeric($options['year']) && $options['year'] > 2000))
			$options['year'] = date('Y');
			
		$start = mktime(0, 0, 0, $options['month'], 1, $options['year']);
		$end = mktime(0, 0, 0, $options['month'] + 1, 1, $options['year']);
		$month = $options['month'];
		$year = $options['year'];
		$conditions = array('conditions' => array(
				'date' => "BETWEEN ".date('Y-m-d',$start).' AND '.date('Y-m-d',$end)
			)
		);
		$options = am($conditions,$options);
		return array($month,$year,$this->find('all',$options));
	}

}
?>