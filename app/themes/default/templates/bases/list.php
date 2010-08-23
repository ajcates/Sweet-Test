<?=B::get('xhtml5', array(
	'head' => B::head(
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
			(!empty($actions) ? B::ul(array('class' => 'actions'), $actions) : ''),
			B::ul(array('class' => 'list content'), join(array_map($itemsEach, $items)))
		),
		T::get('parts/common/footer')
	)
));







/*
B::div(
	array('class' => 'main'),
	ifthereshow(@$sidebar,
		B::aside(@$sidebar)
	),
	B::article(
		array('class' => 'content'),
		B::hgroup(B::h1($title)),
		$content
	)			
),
*/
