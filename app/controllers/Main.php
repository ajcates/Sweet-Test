<?php

Class Main extends App {

	static $urlPattern = array(
		'/(users).*/' => array('Users.php'),
	);

	function __construct() {
		$this->lib(array('Template', 'Uri', 'Config'));
		$this->model(array('User'));
		
		$this->libs->Template->set(array(
			'siteName' => $this->libs->Config->get('site', 'name'),
			'siteTagline' => $this->libs->Config->get('site', 'tagline')
		));
	}

	function index() {
		if(!$this->models->User->loggedIn()) {
			$this->libs->Template->set(array(
				'title' => 'Sweet-Test',
				'content'=> 'Currently not logged in. ' . B::a(array('href' => SITE_URL . 'login'), 'Please login') . '.'
			))->render('bases/content');
		} else {
			$this->libs->Template->set(array(
				'title' => 'Sweet-Test',
				'content'=> 'Logged In.'
			))->render('bases/content');
		}
	}
	
	function login() {
		$message = 'Please Login.';
		if(isset($_POST['name'])) {
			if($this->models->User->login($_POST['name'], $_POST['password'])) {
				return $this->libs->Uri->redirect('/');
			} else {
				$message = 'Login Failed, Please try again.';
			}
		}
		return $this->libs->Template->set(array(
			'title' => 'Login',
			'content'=> $this->libs->Template->get('parts/login', array(
				'message' => $message
			))
		))->render('bases/form');
	}
	
	function logout() {
		if(!$this->models->User->loggedIn()) {
			return $this->libs->Uri->redirect('login');
		}
		$this->models->User->logout();
		return $this->libs->Uri->redirect('/');
	}	
	
	function __DudeWheresMyCar() {
		header('HTTP/1.0 404 Not Found');
		return 'Dude where\'s my car?';
	}
}
