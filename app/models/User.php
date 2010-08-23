<?
class User extends SweetModel {

	var $tableName = 'Users';
	
	var $pk = 'id';
	
	var $fields = array(
		'id' => array('int', 11),
		'name' => array('varchar', 50),
		'email' => array('varchar', 50),
		'password' => array('text'),
		'firstName' => array('varchar', 50),
		'lastName' => array('varchar', 50),
		'salt' => array('text')
	);
	
	var $relationships = array();
	////////
	
//	var $currentUser = null;

/*
	function __construct() {
		$this->lib('Session');
	}
*/

	/**
	 * add function. Takes a key/val of user details then adds it to the db.
	 * 
	 * @access public
	 * @param array $user.
	 * @return void
	 */
/*
	function add($user=null) {
		if(empty($user['fullname']) || empty($user['username']) || $user['password'] !== $user['passwordcheck']) {
			return false;
		}
		unset($user['passwordcheck']);
		$user['password'] = $this->hashPassword($user['password']);
		return $this->libs->Query->insert($user)->into($this->tableName)->results('bool');
	}
*/
	
/*
	private function hashPassword($password) {
		return D::log(sha1($password . $this->lib('Config')->get('site', 'salt')), 'password');
	}
*/
	/**
	login function. Trys to login in the user
	 * 
	 * @access public
	 * @param string $username
	 * @param string $password
	 * @return bool
	 */
/*
	function login($info) {
		D::log($info, 'teh info');
		$this->currentUser = $this->find(array('name' => $info['name']))->one();
		if(empty($this->currentUser) || $this->currentUser->password !== $this->hashPassword($info['password'])) {
			$this->libs->Session->data('loggedIn', false);
			return false;
		}
		$this->libs->Session->data('loggedIn', true);
		$this->libs->Session->data('userId', $this->currentUser->id);
		return true;
	}
*/
	
/*
	function getCurrentUser() {
		if(empty($this->currentUser)) {
			$this->currentUser = $this->find($this->libs->Session->data('userid'))->one();
		}
		return $this->currentUser;
	}
*/
	
	
	/**
	 * loggedIn function. checks to see if the person is currently logged in
	 * 
	 * @access public
	 * @return bool
	 */
/*
	function loggedIn() {
		return (bool) $this->libs->Session->data('loggedIn');
	}
*/
	
	
/*
	function logout() {
		$this->libs->Session->destroy();
	}
*/
	
	
	
	
	
	////// New User Class.
	
	private $currentUser = null;
	
	function __construct() {
		$this->lib(array('Session'));
	}
	
	/**
	 login function. Trys to login in the user
	 * 
	 * @access public
	 * @param string $username
	 * @param string $password
	 * @return bool
	 */
	function login($username, $password) {
		if(empty($username) || empty($password)) {
			return false;
		} 
		$this->currentUser = (object)$this->find(array('name' => $username))->one()->export();
				
		if(empty($this->currentUser) || $this->currentUser->password !== $this->hashPassword($password, $this->currentUser->salt)) {
			$this->libs->Session->data('loggedIn', false);
			return false;
		}
		
		$this->libs->Session->data('loggedIn', true);
		$this->libs->Session->data('userId', $this->currentUser->id);
	//	$this->libs->Session->data('username', $user->username);
	
		return $this->currentUser;
	}
	
	function getCurrentUser() {
		//if statment checking to see if its cached
		if(empty($this->currentUser)) {
			$this->currentUser = $this->find($this->getCurrentUserId())->one();
		}
		//return $this->get($this->libs->Session->data('userId'))->one();
		return $this->currentUser;
	}
	
	function hashPassword($password, $usersalt) {
		return sha1($usersalt . sha1($password)) . sha1($password . $this->lib('Config')->get('site', 'salt'));
	}
	
	function createUser($userInfo) {
		if(!is_array($userInfo)) {
			$userInfo = (array)$userInfo;
		}
		$userInfo['salt'] = $this->generateSalt();
		$userInfo['password'] = $this->hashPassword($userInfo['password'], $userInfo['salt']);
		
		if($user = $this->create($userInfo)) {
			//user succesfully created
			return $user;
		} else {
			return false;
		}
	}
	
	
	
	function updateUser($updateUser) {
		if(!is_array($updateUser)) {
			$updateUser = (array)$updateUser;
		}
		if(!empty($updateUser['password'])) {
			$updateUser['salt'] = $this->generateSalt();
			$updateUser['password'] = $this->hashPassword($updateUser['password'], $updateUser['salt']);
			D::growl($updateUser, 'UPDATE USRSA');
		}
		return $this->update($updateUser);
		
		/*
if($user = $this->create($userInfo)) {
			//user succesfully created
			return $user;
		} else {
			return false;
		}
*/
	}
	
	
	/**
	 * loggedIn function. checks to see if the person is currently logged in
	 * 
	 * @access public
	 * @return bool
	 */
	function loggedIn() {
		return (bool) $this->libs->Session->data('loggedIn');
	}
	
	
	function logout() {
		$this->libs->Session->destroy();
	}
	
	/**
	 * userId function. Gets the currently logged in users id.
	 * 
	 * @access public
	 * @return void
	 */
	function getCurrentUserId() {
		return $this->libs->Session->data('userId');
	}
	
	
	/*
	Orignally Written by [@elenor](http://elenor.net/)
	*/
		
	function generatePassword($minLength = 10, $maxLength=15) {
    	return substr(str_shuffle(implode('', array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'), array('#','&','@','$','_','%','?','+')))), 0, rand($minLength, $maxLength));
	}
	
	function generateSalt() {
		return sha1($this->generatePassword());
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}