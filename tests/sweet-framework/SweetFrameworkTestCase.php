<?
error_reporting(1);
ini_set('display_errors', 2);
require_once(__DIR__ . '/../simpletest/autorun.php');

class SweetFrameworkTestCase extends UnitTestCase {
	
	//public $app;
	
	public $app;
	
	function setUp() {
		static $count = 0;
		$this->assertNull($this->app);
		
		
		$this->app = new SweetFramework();
		//Need to clear the static copy
		
		$this->assertTrue(is_a($this->app, 'SweetFramework'));
		D::log('Called SweetFramework ' . $count++);
	}
	
	function SweetFrameworkTestCase() {
		//D::log('Called');
		$this->UnitTestCase('SweetFrameworkTest');
		define('LOC', __DIR__ . '/../../');
		date_default_timezone_set('America/Los_Angeles');
		require(LOC . 'sweet-framework/libs/SweetFramework.php');
	}
	
	function tearDown() {
		unset($this->app);
		$this->app = null;
	}
	
	function testClassName() {
		//$this->app->lib('Uri');
		
		//$this->app->libs->Uri->)
		$className1 = SweetFramework::className('Hello.php');
		$this->assertEqual($className1, 'Hello');
		
		$className2 = SweetFramework::className('Something/else/What.php');
		$this->assertEqual($className2, 'What');
	}
	
	function testFileLoad() {
		$this->assertTrue(SweetFramework::loadFile('', '/sweet-framework/helpers/functional.php'));
		$this->assertTrue(SweetFramework::loadFile('', '/sweet-framework/helpers/misc.php'));
	}
	
	function testFileTypeLoad() {
		$this->assertTrue(SweetFramework::loadFileType('helper', 'functional'));
		
		$this->assertTrue(SweetFramework::loadFileType('helper', 'misc'));
		
		$this->assertTrue(SweetFramework::loadFileType('lib', 'databases/Query'));
		
		$this->assertTrue(SweetFramework::loadFileType('config', 'SweetFramework'));
	}
	
	function testLoadClass() {
		/* @FAIL becuase they need the app settings and stuff. :(
		
		$query = SweetFramework::loadClass('lib', 'databases/Query');
		$this->assertTrue(is_a($query, 'Query'));
		
		$session = SweetFramework::loadClass('lib', 'Session');
		$this->assertTrue(is_a($session, 'Session'));
		
		$session = SweetFramework::loadClass('lib', 'Uri');
		$this->assertTrue(is_a($session, 'Uri'));
		*/
		
		$session = SweetFramework::loadClass('lib', 'App');
		$this->assertTrue(is_a($session, 'App'));
		
		$session = SweetFramework::loadClass('lib', 'growl');
		$this->assertTrue(is_a($session, 'growl'));
	}
	
}

