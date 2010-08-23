<?=B::nav(B::ul(
	B::li(B::a(array('href' => SITE_URL), 'Home')),
	B::li(B::a(array('href' => SITE_URL . 'users'), 'Users')),
	B::li(B::a(array('href' => SITE_URL . 'logout'), 'Logout'))
));