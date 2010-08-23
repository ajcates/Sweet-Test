<?=B::get('xhtml5', array(
	'head' => B::head(
		//B::meta(array('http-equiv' => 'Content-Type', 'content' => 'text/html; charset=utf-8')),
		B::meta(array('charset' => 'utf-8')),
		B::title($siteName . ' - ' . $title),
		B::link(array('rel' => 'stylesheet', 'href' => T::$url . 'styles/main.css', 'type' => 'text/css', 'media' => 'screen', 'title'=>'Main Style'))
	),
	'body' => B::body(
		B::header(
			B::hgroup(
				B::h1(B::a(array('href' => URL), $siteName)),
				B::h2($siteTagline)
			),
			T::get('parts/common/nav')
		),
		(!empty($sidebar) ? B::aside($sidebar) : ''),
		B::div(
			array('class' => 'main'),
			B::hgroup(
				array('class' => 'title'),
				B::h1($title),
				!empty($message) ? B::h2(array('class' => 'message'), $message) : ''
			),
			(!empty($actions) ? B::ul(array('class' => 'actions'), $actions) : ''),
			B::article(
				array('class' => 'content'),
				$content
			)
		),
		T::get('parts/common/footer')
	)
));

/*
@todo
Make this a more dynamic form builder to show off how cool blocks reall can be.
*/