<?
error_reporting(1);
ini_set('display_errors', 2);
require_once(__DIR__ . '/../simpletest/autorun.php');
//require_once(__DIR__ . '/../simpletest/web_tester.php');

//SimpleTest::prefer(new TextReporter());

if(!function_exists('randomName')) {
	function randomName($minLength = 10, $maxLength=15) {
		return substr(str_shuffle(implode('', array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z')))), 0, rand($minLength, $maxLength));
	}
}

class UriTest extends UnitTestCase {
	
	
	public $app;
	
	function setUp() {
		static $count = 0;
		$this->assertNull($this->app);
		
		$this->app = new SweetFramework();
		
		$this->assertTrue(is_a($this->app, 'SweetFramework'));
		D::log('Called SweetFramework ' . $count++);
		
		$this->assertTrue($this->app->loadApp('app', '/'));
		
		$this->assertTrue($this->app->lib('Uri'));
		
		$this->assertTrue(is_a($this->app->libs->Uri, 'Uri'));
		
	}

	function tearDown() {
		unset($this->app);
		$this->app = null;
	}
	
	function UriTest() {
		$this->UnitTestCase('UriTest');
		
		if(!defined('LOC')) {
			define('LOC', __DIR__ . '/../../');
			date_default_timezone_set('America/Los_Angeles');
			require(LOC . 'sweet-framework/libs/SweetFramework.php');
		}
	}
	
	function testIt() {
		$this->assertTrue(true);
		D::growl($this->app->libs->Uri->getRequest(), 'Request');

		
		//$this->assertTrue(true);
	}
}
