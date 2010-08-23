<title>CRAD-DB – Tests</title>
<?
error_reporting(1);
ini_set('display_errors', 2);
require_once(__DIR__ . '/simpletest/autorun.php');

class AllTests extends TestSuite {

	function __construct() {
        
		$this->TestSuite('AllTests');
        
        //echo __DIR__ . '/sweet-framework/SweetFrameworkTestCase.php';
        
		$this->addFile(__DIR__ . '/sweet-framework/SweetFrameworkTestCase.php');
		$this->addFile(__DIR__ . '/sweet-framework/UriTest.php');
		
		$this->addFile(__DIR__ . '/app/AppGeneralTests.php'); //Checks genrel web pages to make sure they exist.
		$this->addFile(__DIR__ . '/app/UserModelTest.php');
		$this->addFile(__DIR__ . '/app/Head_IndexModelTest.php');
		
	}
}