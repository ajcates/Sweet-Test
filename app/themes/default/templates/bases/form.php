<?=B::get('xhtml5', array(
	'head' => B::head(
		//B::meta(array('http-equiv' => 'Content-Type', 'content' => 'text/html; charset=utf-8')),
		B::meta(array('charset' => 'utf-8')),
		B::title($siteName . ' - ' . $title)
	),
	'body' => B::body(
		B::header(
			B::hgroup(
				B::h1(B::a(array('href' => URL), $siteName)),
				B::h2($siteTagline)
			),
			T::get('parts/common/nav')
		),
		B::hgroup(
			array('class' => 'title'),
			B::h1($title),
			(isset($message) && !empty($message)) ? B::h2(array('class' => 'message'), $message) : ''
		),
		(!empty($sidebar) ? B::aside($sidebar) : ''),
		B::div(
			array('class' => 'main'),
			(isset($actions) && !empty($actions)) ? B::ul(array('class' => 'actions'), $actions) : '',
			B::div(
				array('class' => 'content form'),
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
