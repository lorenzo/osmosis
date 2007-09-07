<?php
class PluginFixture extends CakeTestFixture {
    var $name = 'Plugin';
    var $fields;
    var $import = array('model'=>'Plugin');
    var $records = array(
    	array('id'=>1,'name'=>'plugin1','active'=>1),
    	array('id'=>2,'name'=>'plugin2','active'=>0),
    	array('id'=>3,'name'=>'plugin3','active'=>1),
    );
} 
?>