<?php
class CourseFixture extends CakeTestFixture {
    var $name = 'Course';
    var $import = 'Course';
    var $records = array(
    	array(
    		'id'=>1,
    		'department_id'=>1,
    		'owner_id'=>2,
    		'code'=>'ci1121',
    		'name'=>'computacion',
    		'description'=>'pa que aprendas'
		),
    	array(
    		'id'=>2,
    		'department_id'=>1,
    		'owner_id'=>2,
    		'code'=>'ci1112',
    		'name'=>'computacion2',
    		'description'=>'pa que aprendas'
		),
    	array(
    		'id'=>3,
    		'department_id'=>2,
    		'owner_id'=>3,
    		'code'=>'ci1211',
    		'name'=>'computacion3',
    		'description'=>'pa que aprendas'
		)
    );
} 
?>