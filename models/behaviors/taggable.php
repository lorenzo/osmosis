<?php
/**
 * Model behavior to support tagging of model records
 *
 */
class TaggableBehavior extends ModelBehavior {
	/**
	 * Contain settings indexed by model name.
	 *
	 * @var array
	 * @access private
	 */
	private $__settings = array();


	/**
	 * Initiate behavior for the model using specified settings. Available settings:
	 * @param object $model  Model using the behavior
	 * @param array $settings Settings to override for model.
	 * @access public
	 */
	function setup(&$model, $settings = array()) {
		$default = array(
			'joinTable' => $model->useTable.'_tags',
			'foreignKey' => 'tag_id',
			'associationForeignKey' => Inflector::variable($model->name).'_id',
			'conditions' => '',
			'fields'	=> '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'unique' => true,
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => '',
			'with' => 'Tagged'.$model->alias,
			'useDbConfig' => $model->useDbConfig	
			);

		if (!isset($this->__settings[$model->alias])) {
			$this->__settings[$model->alias] = $default;
		}

		$this->__settings[$model->alias] = Set::merge($this->__settings[$model->alias], ife(is_array($settings), $settings, array()));
		$assoc = array('Tag' => array(
			'className' => 'Tag',
			'joinTable' => $this->__settings[$model->alias]['joinTable'],
			'foreignKey' => $this->__settings[$model->alias]['foreignKey'],
			'associationForeignKey' => $this->__settings[$model->alias]['associationForeignKey'],
			'conditions' => $this->__settings[$model->alias]['conditions'],
			'fields'	=> $this->__settings[$model->alias]['fields'],
			'order'	=> $this->__settings[$model->alias]['order'],
			'limit' => $this->__settings[$model->alias]['limit'],
			'offset' => $this->__settings[$model->alias]['offset'],
			'unique' => $this->__settings[$model->alias]['unique'],
			'finderQuery' => $this->__settings[$model->alias]['finderQuery'],
			'deleteQuery' => $this->__settings[$model->alias]['deleteQuery'],
			'insertQuery' => $this->__settings[$model->alias]['insertQuery'],
			'with' => $this->__settings[$model->alias]['with']
			)
		);
		$model->bindModel(array('hasAndBelongsToMany' => $assoc));
		$model->Tag->useDbConfig = $this->__settings[$model->alias]['useDbConfig'];
	}
	
	/**
	 * Looks for the field "tags" in the model data, parses it and save the tag relations
	 * It expects the tag string to be seprated by comma (,)
	 * If a new tag string is required to be associated it is firts saved on the Tag Model
	 * @param object $model  Model using the behavior
	 * @access public
	 */
	function beforeSave(&$model) {
		if (!isset($model->data[$model->alias]['tags']{0}))
			return true;
		
		$tags = array_unique(String::tokenize($model->data[$model->alias]['tags']));
		$stored = $model->Tag->find('all',array(
			'conditions' => array('Tag.name' => $tags),
			'recursive'	=> -1
			)
		);
		$storedTagNames = Set::extract('/Tag/name',$stored);
		$missing = array_diff($tags,$storedTagNames);
		$tag_ids = Set::extract('/Tag/id',$stored);
		if (!empty($missing)) {
			foreach ($missing as $tag) {
				$model->Tag->create();
				if ($model->Tag->save(array('name' => $tag)))
				 $tag_ids[] = $model->Tag->id;
			}
		}
		$model->data['Tag']['Tag'] = $tag_ids;
		return true;
	}

}

?>