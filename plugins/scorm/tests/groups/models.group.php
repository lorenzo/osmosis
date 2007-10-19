<?php class AllScormModelsGroupTest extends GroupTest {

	var $label = 'All Scorm models';

	function AllScormModelsGroupTest() {
		TestManager::addTestCasesFromDirectory($this, APP.DS.'plugins'.DS.'scorm'. DS . 'tests' . DS . 'cases' . DS . 'models');
	}
}
?>