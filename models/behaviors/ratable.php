<?php
/**
 * Model behavior to support rating of model records
 *
 */
class RatableBehavior extends ModelBehavior {


	/**
	 * Initiate behavior for the model using specified settings. Available settings:
	 * ratingField => The field name that holds record rating defaults to rating
	 * maxRating => The maximum rating, defaults to 5
	 * userModel => The Model associated with the person that rates the record
	 * countTable => The database table that holds who rated which record, for example "posts_rated"
	 * foreignKey => The foreign key to the ratable model in countTable
	 * associationForeignKey => The foreign key to the userModel in countTable
	 * @param object $model  Model using the behavior
	 * @param array $settings settings to override for model.
	 * @access public
	 */
	function setup(&$model, $settings = array()) {
		$default = array(
			'ratingField'	=> 'rating',
			'maxRating'		=> 5,
			'userModel'		=> 'User',
			'countTable'	=> $model->useTable.'_rated',
			'foreignKey'	=> Inflector::variable($model->name).'_id',
			'associationForeignKey' => 'user_id',
			'withModel'		=> 'Rated'.$model->alias,
			);

		if (!isset($this->settings[$model->alias])) {
			$this->settings[$model->alias] = $default;
		}

		$this->settings[$model->alias] = Set::merge($this->settings[$model->alias], ife(is_array($settings), $settings, array()));
	}
	
	/**
	 * If rating field is set in model data along with the user_id, the new rating for the model is calculated
	 *
	 * @param Model $model the reference to the ratable model
	 * @return void
	 */
	
	function beforeSave(&$model) {
		$ratingField = $this->settings[$model->alias]['ratingField'];
		if (!isset($model->data[$model->alias][$ratingField]) || 
			empty($model->data[$model->alias][$ratingField]) ||
			!isset($model->data[$model->alias][$this->settings[$model->alias]['associationForeignKey']]) ||
			empty($model->data[$model->alias][$this->settings[$model->alias]['associationForeignKey']]) 
			) {
			unset($model->data[$model->alias][$ratingField]);
			return;
		}
		
		$currentRating = $currentCount = 0;
		
		$assoc = array('Rating'.$this->settings[$model->alias]['userModel'] => array(
			'className' => $this->settings[$model->alias]['userModel'],
			'joinTable' => $this->settings[$model->alias]['countTable'],
			'foreignKey' => $this->settings[$model->alias]['foreignKey'],
			'associationForeignKey' => $this->settings[$model->alias]['associationForeignKey'],
			'with' => $this->settings[$model->alias]['withModel']
			)
		);
		
		$model->bindModel(array('hasAndBelongsToMany' => $assoc),false);

		if ($model->exists()) {
			
			$alreadyRated = $currentCount = $model->{$this->settings[$model->alias]['withModel']}->find('count',array(
				'conditions' => array(
					$this->settings[$model->alias]['foreignKey'] => $model->id,
					$this->settings[$model->alias]['associationForeignKey'] => $model->data[$model->alias][$this->settings[$model->alias]['associationForeignKey']]
					)
				)
			);
			
			if($alreadyRated) {
				unset($model->data[$model->alias][$ratingField]);
				return;
			}
			
			$currentCount = $model->{$this->settings[$model->alias]['withModel']}->find('count',array(
				'conditions' => array($this->settings[$model->alias]['foreignKey'] => $model->id)
				)
			);
		
			$current = $model->find('first',array(
				'conditions' => array($model->alias.'.id' => $model->id),
				'fields' => $ratingField,
				'recursive' => -1
				)
			);
			$currentRating = $current[$model->alias][$ratingField];
		}
			
		$currentCount++;
		$model->data[$model->alias][$ratingField] = min(
			$this->settings[$model->alias]['maxRating'],
			($currentRating * max(($currentCount - 1),1) + $model->data[$model->alias][$ratingField]) / $currentCount);
	}
	
	/**
	 * Saves a new record in the countTable to indicate that a user has rated a record
	 *
	 * @param Model $model the reference to the ratable model
	 * @return void
	 */
	
	function afterSave(&$model) {
		$ratingField = $this->settings[$model->alias]['ratingField'];
		if (!isset($model->data[$model->alias][$ratingField]) || 
			empty($model->data[$model->alias][$ratingField]) ||
			!isset($model->data[$model->alias][$this->settings[$model->alias]['associationForeignKey']]) ||
			empty($model->data[$model->alias][$this->settings[$model->alias]['associationForeignKey']]) 
			) {
			$this->_unbind($model);
			return;
		}
		$model->{$this->settings[$model->alias]['withModel']}->save( array(
			$this->settings[$model->alias]['withModel'] =>
			array(
				$this->settings[$model->alias]['foreignKey'] => $model->id,
				$this->settings[$model->alias]['associationForeignKey'] => $model->data[$model->alias][$this->settings[$model->alias]['associationForeignKey']]
			)
			)
		);
		$this->_unbind($model);
	}
	
	function _unbind(&$model) {
		$model->unbindModel(array('hasAndBelongsToMany' => array( 'Rating'.$this->settings[$model->alias]['userModel'])),false);
	}

}

?>
