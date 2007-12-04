<?php
/* SVN FILE: $Id: db_acl.php 6077 2007-11-25 16:01:49Z gwoo $ */
/*DbAcl schema generated on: 2007-11-24 15:11:13 : 1195945453*/
/**
 * This is Acl Schema file
 *
 * Use it to configure database for ACL
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app.config.sql
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 6077 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2007-11-25 12:01:49 -0400 (Sun, 25 Nov 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/*
 *
 * Using the Schema command line utility
 * cake schema run create DbAcl
 *
 */
class DbAclSchema extends CakeSchema {

	var $name = 'DbAcl';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $acos = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'extra' => 'auto_increment'),
			'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'model' => array('type'=>'string', 'null' => true),
			'foreign_key' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'alias' => array('type'=>'string', 'null' => true),
			'lft' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'rght' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);

	var $aros = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'extra' => 'auto_increment'),
			'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'model' => array('type'=>'string', 'null' => true),
			'foreign_key' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'alias' => array('type'=>'string', 'null' => true),
			'lft' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'rght' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);

	var $aros_acos = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'extra' => 'auto_increment'),
			'aro_id' => array('type'=>'integer', 'null' => false, 'length' => 10, 'key' => 'index'),
			'aco_id' => array('type'=>'integer', 'null' => false, 'length' => 10),
			'_create' => array('type'=>'string', 'null' => false, 'default' => '0', 'length' => 2),
			'_read' => array('type'=>'string', 'null' => false, 'default' => '0', 'length' => 2),
			'_update' => array('type'=>'string', 'null' => false, 'default' => '0', 'length' => 2),
			'_delete' => array('type'=>'string', 'null' => false, 'default' => '0', 'length' => 2),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'ARO_ACO_KEY' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1))
		);

}
?>