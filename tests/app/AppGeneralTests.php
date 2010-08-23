<?
error_reporting(1);
ini_set('display_errors', 2);
require_once(__DIR__ . '/../simpletest/autorun.php');
require_once(__DIR__ . '/../simpletest/web_tester.php');

//SimpleTest::prefer(new TextReporter());
if(!function_exists('randomName')) {
	function randomName($minLength = 10, $maxLength=15) {
		return substr(str_shuffle(implode('', array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z')))), 0, rand($minLength, $maxLength));
	}
}

class AppGeneralTests extends WebTestCase {





	function setUp() {
		//$this->setCookie('crad-token', '908_1e8ef2d6a3515306e82ee29b2590c7bc0e9165089a41e0d4c7eb7ef9c3fe0bd76615d021e3d1a317f196dc7c8cfdc98390f0811ff6cd95a883997a2be91e2ce9');
		
		
		//$this->
		
		$this->get('http://ajcates-macbook.local/egghead/crad-db/login');
		$this->setField('name', 'ajcates');
		$this->setField('password', 'aldo20');
		$this->click('Login');
		$this->assertTitle('CRAD-DB - Dashboard');
	}
	
	

	function taerDown() {
		
	}
	
	function AppGenTests() {
		$this->WebTestCase('SweetFrameworkTest');
	}
	
	function testHomePage() {
		$this->assertTrue($this->get('http://ajcates-macbook.local/egghead/crad-db/'));
		
	}
	
	function testLoginPage() {
		
		$this->assertTrue($this->get('http://ajcates-macbook.local/egghead/crad-db/login'));
	}
	
	function testLookups() {
		$this->get('http://ajcates-macbook.local/egghead/crad-db/lookups/items/Loft');
		
		$this->assertTitle('CRAD-DB - Lookups - Loft');
		$this->assertText('Lookups - Loft');
		$this->assertText('10.5');
		$this->assertText('18.5');
		
		
		$this->get('http://ajcates-macbook.local/egghead/crad-db/lookups/items/Models');
		
		$this->assertTitle('CRAD-DB - Lookups - Models');
		$this->assertText('Lookups - Models');
		
		$this->assertText('HiBore XLS');
		$this->assertText('Cleveland');
		
		
		//$this->assertTitle('CRAD-DB - Lookups - Loft');
	}
	
	function testLookupEdit() {
		$this->get('http://ajcates-macbook.local/egghead/crad-db/lookups/edit/Models/24');
		
		
		$randomName = randomName();
		
		
		$this->setField('Model', $randomName);
		
		$this->click('Submit');
		//$this->get('http://ajcates-macbook.local/egghead/crad-db/lookups/items/Models');
		
		
		$this->assertText($randomName);
	
	}
	
	function testLookupCreate() {
		//
		$randomName = rand(0, 5000);
		$this->get('http://ajcates-macbook.local/egghead/crad-db/lookups/create/Grip_Weight');
		$this->setField('Grip_Weight', $randomName);
		$this->click('Create');
		
	}
	
}

