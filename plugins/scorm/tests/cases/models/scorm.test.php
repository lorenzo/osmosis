<?php 

loadModel('scorm.Scorm');

class CourseTestCase extends CakeTestCase {
	var $TestObject = null;
	function setUp() {
		$this->TestObject = new Scorm();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
		//$this->TestObject->loadInfo(true);
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
	function testValidation1() {
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'name'				=> 'Error.empty',
			'description'		=> 'Error.empty',
			'course_id' 		=> 'Error.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testManifestExists() {
		$this->assertTrue($this->TestObject->manifestExists(TMP.'tests'));
		$this->assertFalse($this->TestObject->manifestExists(TMP.'fake'));
	}
	
	function testParseManifest() {
		$this->TestObject->parseManifest(TMP.'tests');
	}
	
	function testGetSchemaVersion() {
		$manifest = new XMLNode('manifest');
		$metadata = new XMLNode('metadata');
		$schema = new XMLNode('schema', null, 'ADL SCORM');
		$schemaversion = new XMLNode('schemaversion', null, '2004 3rd Edition');
		$metadata->append($schemaversion);
		$metadata->append($schema);
		$manifest->append($metadata);
		$this->assertEqual(
			$this->TestObject->getSchemaVersion($manifest),
			'2004 3rd Edition'
		);
	}

	function testExtractResources() {
		$resources = new XMLNode('resources');
		$resource1 = new XMLNode('resource', array(
				'identifier' => 'RESOURCE1',
				'adlcp:scormType' => 'sco',
				'type' => 'webcontent',
				'href' => 'localitem1.html'
			)
		);
		$resources->append($resource1);
		$resource2 = new XMLNode('resource', array(
				'identifier' => 'RESOURCE2',
				'adlcp:scormType' => 'sco',
				'type' => 'webcontent',
				'href' => 'localitem2.html'
			)
		);
		$resources->append($resource2);
		$resource3 = new XMLNode('resource', array(
				'identifier' => 'RESOURCE3',
				'adlcp:scormType' => 'sco',
				'type' => 'webcontent',
				'href' => 'localitem3.html'
			)
		);
		$file = new XMLNode('file', array('href' => 'localitem3.html')); //Ignored
		$resource3->append($file);
		$resources->append($resource3);
		
		$manifest = new XMLNode('manifest');
		$manifest->append($resources);
		
		
		$this->assertEqual(
			$this->TestObject->extractResources($manifest),
			array (
			    'RESOURCE1' => array (
			            'identifier' => 'RESOURCE1',
			            'adlcp:scormType' => 'sco',
			            'type' => 'webcontent',
			            'href' => 'localitem1.html',
		        ),
			    'RESOURCE2' => array (
			            'identifier' => 'RESOURCE2',
			            'adlcp:scormType' => 'sco',
			            'type' => 'webcontent',
			            'href' => 'localitem2.html'
		        ),
			    'RESOURCE3' => array (
			            'identifier' => 'RESOURCE3',
			            'adlcp:scormType' => 'sco',
			            'type' => 'webcontent',
			            'href' => 'localitem3.html'
		        )

			)
		);
	}
}
?>