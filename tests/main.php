<?
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
require_once(__DIR__ . '/simpletest/autorun.php');

class AllTests extends TestSuite {

	function __construct() {
        
		$this->TestSuite('AllTests');
        
        //echo __DIR__ . '/sweet-framework/SweetFrameworkTestCase.php';
        
		$this->addFile(__DIR__ . '/sweet-framework/SweetFrameworkTestCase.php');
		$this->addFile(__DIR__ . '/sweet-framework/UriTest.php');
		
		$this->addFile(__DIR__ . '/app/AppGeneralTests.php'); //Checks genrel web pages to make sure they exist.
		$this->addFile(__DIR__ . '/app/models/UserTest.php');
		//$this->addFile(__DIR__ . '/app/Head_IndexModelTest.php');
		
	}
}