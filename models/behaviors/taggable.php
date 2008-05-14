<?php
/**
 * Model behavior to support tagging of model records
 *
 */
class TaggableBehavior extends ModelBehavior {


	/**
	 * Initiate behavior for the model using specified settings. Available settings:
	 * @param object $model  Model using the behavior
	 * @param array $settings settings to override for model.
	 * @access public
	 */
	function setup(&$model, $settings = array()) {
		$default = array(
			'joinTable' => $model->useTable.'_tags',
			'foreignKey' => Inflector::variable($model->name).'_id',
			'associationForeignKey' => 'tag_id',
			'conditions' => '',
			'fields'	=> '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'unique' => false,
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => '',
			'with' => 'Tagged'.$model->alias,
			'useDbConfig' => $model->useDbConfig
			);

		if (!isset($this->settings[$model->alias])) {
			$this->settings[$model->alias] = $default;
		}

		$this->settings[$model->alias] = Set::merge($this->settings[$model->alias], ife(is_array($settings), $settings, array()));
		$assoc = array('Tag' => array(
			'className' => 'Tag',
			'joinTable' => $this->settings[$model->alias]['joinTable'],
			'foreignKey' => $this->settings[$model->alias]['foreignKey'],
			'associationForeignKey' => $this->settings[$model->alias]['associationForeignKey'],
			'conditions' => $this->settings[$model->alias]['conditions'],
			'fields'	=> $this->settings[$model->alias]['fields'],
			'order'	=> $this->settings[$model->alias]['order'],
			'limit' => $this->settings[$model->alias]['limit'],
			'offset' => $this->settings[$model->alias]['offset'],
			'unique' => $this->settings[$model->alias]['unique'],
			'finderQuery' => $this->settings[$model->alias]['finderQuery'],
			'deleteQuery' => $this->settings[$model->alias]['deleteQuery'],
			'insertQuery' => $this->settings[$model->alias]['insertQuery'],
			'with' => $this->settings[$model->alias]['with']
			)
		);
		$model->bindModel(array('hasAndBelongsToMany' => $assoc),false);
		$model->Tag->useDbConfig = $this->settings[$model->alias]['useDbConfig'];
	}
	
	/**
	 * Looks for the field "tags" in the model data, parses it and save the tag relations
	 * It expects the tag string to be seprated by comma (,)
	 * If a new tag string is required to be associated it is firts saved on the Tag Model
	 * @param object $model  Model using the behavior
	 * @access public
	 */
	function afterSave(&$model) {
		if (!isset($model->data[$model->alias]['tags']{0}))
			return true;
		
		$tags = array_unique(String::tokenize($model->data[$model->alias]['tags']));
		$existing = $model->Tag->find('all',array(
			'conditions' => array('Tag.name' => $tags),
			'recursive'	=> -1
			)
		);
		$existingTagNames = Set::extract('/Tag/name',$existing);
		$missing = array_diff($tags,$existingTagNames);

		$alreadyAssigned = array();
		
		if (!empty($model->id)) {
			$alreadyAssigned = $model->{$this->settings[$model->alias]['with']}->find('all',
			array('conditions' => array(
					$this->settings[$model->alias]['foreignKey'] => $model->id
					)
				)
			);
		}
		
		$tag_ids = array_diff(Set::extract('/Tag/id',$existing),Set::extract('/Tag/id',$alreadyAssigned));
		
		if (!empty($missing)) {
			foreach ($missing as $tag) {
				$model->Tag->create();
				if ($model->Tag->save(array('name' => $tag)))
				 $tag_ids[] = $model->Tag->id;
			}
		}

		foreach ($tag_ids as $tag) {
			$data = array(
				$this->settings[$model->alias]['foreignKey'] => $model->id,
				$this->settings[$model->alias]['associationForeignKey'] => $tag
			);
			if (isset($model->data[$model->alias]['tagging_user']) && !empty($model->data[$model->alias]['tagging_user'])
				&& $model->{$this->settings[$model->alias]['with']}->hasField('member_id')
			) {
				$data['member_id'] = $model->data[$model->alias]['tagging_user'];
			}
				
			$model->{$this->settings[$model->alias]['with']}->create();
			$model->{$this->settings[$model->alias]['with']}->save($data);
		}
		return true;
	}

}

?>