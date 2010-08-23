<?=join(array(
	B::h2($message),
	B::form(
		array('action' => SITE_URL . 'login/', 'method' => 'post', 'id' => 'login_form'),
		B::label(array('for' => 'username_input'), 'Username'),
		B::input(array(
			'id' => 'username_input',
			'autofocus' => 'autofocus',
			'name' => 'name',
			'type' => 'text'
		)),
		B::label(array('for' => 'password_input'), 'Password'),
		B::input(array(
			'id' => 'password_input',
			'name' => 'password',
			'type' => 'password'
		)),
		B::input(array(
			'value' => 'Login',
			'type' => 'submit'
		))
	)
));

