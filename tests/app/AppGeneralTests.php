<?
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
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

		$this->get('http://localhost/projects/sweet-test/login');
		$this->setField('name', 'ajcates');
		$this->setField('password', 'aldo20');
		//$this->setField('password', 'fail');
		$this->click('Login');
		$this->assertTitle('Sweet-Test - Sweet-Test');
		//$this->showHeaders();
	}
	
	

	function taerDown() {
		
	}
	
	function AppGeneralTests() {
		$this->WebTestCase('AppGeneralTests');		
	}
	
	function testHomePage() {
		//$this->assertTrue();
		$this->get('http://localhost/projects/sweet-test/');
		$this->assertResponse(200);
	}
	
	function testUsersPage() {
		//$this->assertTrue();
		$this->get('http://localhost/projects/sweet-test/users');
		//$this->assertResponse(200);
		$this->assertTitle('Sweet-Test - Users');
		
		$this->click('dubman');
		
		//$this->showSource();
		
		$this->assertFieldById('name_input', 'dubman');
		$this->assertFieldById('email_input', 'check@checkout.com');
		
		$ranName = randomName(6, 10);
		$this->setField('lastName', $ranName);
		
		$this->click('Edit User');
		
		$this->assertText('Successfully Edited ' . $ranName);
		
		
		$this->click('Create');
		
		$uName = randomName();
		$ulastName = randomName();
		$this->setField('name', $uName);
		$this->setField('email', 'test@example.com');
		$this->setField('firstName', 'McTest');
		$this->setField('lastName', $ulastName);
		$this->setField('password', 'aldo20');
		$this->setField('passwordCheck', 'aldo20');
		
		$this->click('Create User');
		
		$this->assertText('Successfully Created ' . $ulastName);
		$this->assertText($uName);
		
	}
	
}

