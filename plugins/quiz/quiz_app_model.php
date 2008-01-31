<?php
class QuizAppModel extends AppModel {
	
	function save($data,$validate=true,$fieldList=array()) {
		if(!$result = parent::save($data,$validate,$fieldList)) {
			return false;
		}else {
			$assocs = $this->getAssociated();
			foreach ($assocs as $key => $type) {
				if(isset($data[$key]) && $type == 'hasAndBelongsToMany' && isset($this->hasAndBelongsToMany[$key]['with'])) {
					$with = $this->hasAndBelongsToMany[$key]['with'];
					$assocData[$key] = $data[$key];
					unset($assocData[$key]['id']);
					$assocData[$key][$this->hasAndBelongsToMany[$key]['foreignKey']] = $this->id;
					$assocData[$key][$this->hasAndBelongsToMany[$key]['associationForeignKey']] = $data[$key]['id'];
					$this->{$with}->save($assocData,$validate,$fieldList);
				}
			}
		}
		return $result;
	}
}
?>
