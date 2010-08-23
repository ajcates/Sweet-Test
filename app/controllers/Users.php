<?
class Users extends App {
	/*
	@todo:
		- make the only message template varible $template->message
		- Streamline the template messages in the templates
	*/
	function __construct() {
		$this->lib(array('Template', 'Uri', 'Config', 'Session'));
		
		$this->helper('misc');
		
		$this->libs->Template->set(array(
			'siteName' => $this->libs->Config->get('site', 'name'),
			'siteTagline' => $this->libs->Config->get('site', 'tagline'),
			'navLocation' => 'Users',
			'message' => $this->libs->Session->flash('userMessage'),
		));
		
		if(!$this->model('User')->loggedIn()) {
			return $this->libs->Uri->redirect('login');
		}
	}

	function index() {
 		return $this->libs->Template->set(array(
			'title' => 'Users',
			'items' => $this->models->User->sort(array('name' => 'ASC'))->all(),
			'itemsEach' => function($user) {
				return B::li(array('class' => 'user'), B::a(array('href' => SITE_URL . 'users/edit/' . $user->id),
					B::h3($user->name),
					B::img(array(
						'src' => gravatar($user->email),
						'alt' => 'gravatar'
					)),
					B::p($user->lastName . ', ' . $user->firstName)
				));
			},
			'actions' => join(array(
				B::li(B::h2('Users:')),
				B::li(B::a(array('href' => SITE_URL . 'users/create/'), 'Create'))
			)),
		))->render('bases/list');
 		
	}
	
	function create() {
 		return $this->libs->Template->set(array(
			'title' => 'Create User',
			'actions' => B::li(B::a(array('href' => SITE_URL . 'users'), 'Back')),
			'content' => T::get('parts/users/new')
		))->render('bases/form');
	}
	
	function edit() {
		return $this->libs->Template->set(array(
			'title' => 'Edit User',
			'actions' => B::li(B::a(array('href' => SITE_URL . 'users'), 'Back')),
			'content' => T::get('parts/users/edit', array(
				'user' => $this->models->User->find($this->libs->Uri->get(2))->one()
			))
		))->render('bases/form');
	}
	
	function delete() {
		$item = $this->users->find($this->uri->get(2))->one();
		if($item->delete()) {
			$this->libs->Session->flash('userMessage', 'Successfully Deleted ' . $item->lastName . ', ' . $item->firstName );
		} else {
			$this->libs->Session->flash('userMessage', 'Massive Failure of Epic Proportions');
		}
		return $this->libs->Uri->redirect('users');
	}
	
	function docreate() {
		if($this->models->User->find(array('name' => $_POST['name']))->one()) {
			$this->libs->Session->flash('userMessage', 'Failure; Username already exists');
			
		} else {
			$post = $_POST;
		//	D::log($post, 'post');
			if($post['password'] === $post['passwordCheck']) {
				unset($post['passwordCheck']);	
			} else {
				$this->libs->Session->flash('userMessage', 'Passwords Do Not Match');
				return $this->libs->Uri->redirect('users/create');
			}
			
			if($this->models->User->createUser($post)) {
				$this->libs->Session->flash('userMessage', 'Successfully Created ' . $post['lastName'] . ', ' . $post['firstName']);
			} else {
				$this->libs->Session->flash('userMessage', 'Massive Failure of Epic Proportions');
			}
		}
		return $this->libs->Uri->redirect('users');
	}
	
	function doedit() {
		$post = $_POST;
		
		if(!empty($post['password'])) {
			if($post['password'] === $post['passwordCheck']) {
				unset($post['passwordCheck']);	
			} else {
				$this->libs->Session->flash('userMessage', 'Passwords Do Not Match');
				return $this->libs->Uri->redirect('users/edit/' . $this->libs->Uri->get(2));
			}
		} else {
			unset($post['passwordCheck']);
			unset($post['password']);
		}
		
		if($this->models->User->find($this->libs->Uri->get(2))->updateUser($post)->save()) {
			$this->libs->Session->flash('userMessage', 'Successfully Edited ' . $post['lastName'] . ', ' . $post['firstName']);
		} else {
			$this->libs->Session->flash('userMessage', 'Massive Failure of Epic Proportions');
		}
		return $this->libs->Uri->redirect('users');
	}
	
}