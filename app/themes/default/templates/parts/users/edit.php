<?=B::form(
	array('action' => SITE_URL . 'users/doedit/' . $user->id, 'method' => 'post'),
	B::label(array('for' => 'name_input'), 'Username'),
	B::input(array(
		'id' => 'name_input',
		'name' => 'name',
		'type' => 'text',
		'value' => $user->name
	)),
	B::label(array('for' => 'email_input'), 'Email'),
	B::input(array(
		'id' => 'email_input',
		'name' => 'email',
		'type' => 'text',
		'value' => $user->email
	)),
	B::label(array('for' => 'firstname_input'), 'First Name'),
	B::input(array(
		'id' => 'firstname_input',
		'name' => 'firstName',
		'type' => 'text',
		'value' => $user->firstName
	)),
	B::label(array('for' => 'lastname_input'), 'Last Name'),
	B::input(array(
		'id' => 'lastname_input',
		'name' => 'lastName',
		'type' => 'text',
		'value' => $user->lastName
	)),
	B::label(array('for' => 'password_input'), 'Password, leave blank for no change'),
	B::input(array(
		'id' => 'password_input',
		'name' => 'password',
		'type' => 'password'
	)),
	B::label(array('for' => 'passwordcheck_input'), 'Password Check'),
	B::input(array(
		'id' => 'passwordcheck_input',
		'name' => 'passwordCheck',
		'type' => 'password'
	)),
	B::input(array(
		'value' => 'Edit User',
		'type' => 'submit'
	))
);