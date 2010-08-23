<?
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
require_once(__DIR__ . '/../../simpletest/autorun.php');
//require_once(__DIR__ . '/../simpletest/web_tester.php');

//SimpleTest::prefer(new TextReporter());

if(!function_exists('randomName')) {
	function randomName($minLength = 10, $maxLength=15) {
		return substr(str_shuffle(implode('', array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z')))), 0, rand($minLength, $maxLength));
	}
}

class UserTest extends UnitTestCase {
	
	
	public $app;
	
	function setUp() {
		static $count = 0;
		$this->assertNull($this->app);
		
		$this->app = new SweetFramework();
		
		$this->assertTrue(is_a($this->app, 'SweetFramework'));
		D::log('Called SweetFramework ' . $count++);
		
		$this->assertTrue($this->app->loadApp('app', '/'));
		
		$this->assertTrue($this->app->model('User'));
		
		$this->assertTrue(is_a($this->app->models->User, 'User'));
		
	}

	function tearDown() {
		unset($this->app);
		$this->app = null;
	}
	
	function UserTest() {
		$this->UnitTestCase('UserTest');
		
		if(!defined('LOC')) {
			define('LOC', __DIR__ . '/../../../');
			date_default_timezone_set('America/Los_Angeles');
			require(LOC . 'sweet-framework/libs/SweetFramework.php');
		}
	}
	
	function testLogin() {
		
		//D::growl( . 'is logged in');
		
		//$isLoggedin = ;
	//	
		
		$loggedIn = $this->app->models->User->login('ajcates', 'aldo20');
		
		$this->assertTrue($loggedIn);
		
		$this->assertTrue($this->app->models->User->loggedIn());
		
		//D::growl($loggedIn . 'login()');
	}
	
	function testFind() {
		$user = $this->app->models->User->find(array('name' => 'ajcates'))->one();
		
		$this->assertEqual(get_class($user), 'SweetRow');
		$this->assertEqual($user->lastName, 'Cates');
		$this->assertEqual($user->email, 'aj@ajcates.com');
		
	}
	
	function testCreate() {
		$newUserName = '_RandomTest_' . randomName();
		$created = $this->app->models->User->create(array(
			'name' => $newUserName,
			'email' => 'ajcates@eggheadventures.com',
			'password' => 'aldo20',
			'lastName' => 'Tester',
			'firstName' => 'createUser'
		));
		
		$user = $this->app->models->User->find(array('name' => $newUserName))->one();
		
		$this->assertEqual(get_class($user), 'SweetRow');
		$this->assertEqual($user->lastName, 'Tester');
		$this->assertEqual($user->email, 'ajcates@eggheadventures.com');
	}
	
	function testCreateUser() {
		$newUserName = '_RandomTest_' . randomName();
		$created = $this->app->models->User->createUser(array(
			'name' => $newUserName,
			'email' => 'ajcates@eggheadventures.com',
			'password' => 'aldo20',
			'lastName' => 'Tester',
			'firstName' => 'createUser'
		));
		
		$user = $this->app->models->User->find(array('name' => $newUserName))->one();
		
		$this->assertEqual(get_class($user), 'SweetRow');
		$this->assertEqual($user->lastName, 'Tester');
		$this->assertEqual($user->email, 'ajcates@eggheadventures.com');
		
		
		//D::growl($user->salt);
		
		$this->assertTrue((bool)$user->salt);
		
//		$this->app->models->User->
		
		$loggedIn = $this->app->models->User->login($newUserName, 'aldo20');
		
		$this->assertTrue($loggedIn);
		
		$this->assertTrue($this->app->models->User->loggedIn());
	}
	
	function testUpdate() {
		$ranName = randomName();
		$saved = $this->app->models->User->find(array('name' => 'dubman'))->updateUser(array('lastName' => $ranName))->save();
		
		$this->assertTrue($saved);
		
		$updated = $this->app->models->User->find(array('lastName' => $ranName))->one();
	
		$this->assertEqual($updated->email, 'check@checkout.com');
		$this->assertEqual(get_class($updated), 'SweetRow');
	}


	
	function testGenFuncs() {
		$salt = $this->app->models->User->generateSalt();
		$this->assertTrue(!empty($salt));
		//$this->assertTrue(!empty($this->app->models->User->hashPassword('blah', 'blah')));
		
		$hashPash = $this->app->models->User->hashPassword('blah', 'blah');
		$this->assertTrue(!empty($hashPash));
		
	}
	
	
}








