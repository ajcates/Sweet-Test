<?php
SweetFramework::getClass('lib', 'Config')->setAll('site', array(
	'name' => 'Sweet-Test',
	'tagline' => 'A Suit Of Tests for Sweet-Framework',
	'prettyUrls' => true,
	'database' => 'default',
	'autoload' => array('Session', 'SweetModel'),
	'theme' => 'default',
	'mainController' => 'Main',
	'salt' => '8bae34e497==RANDOM CRAP IS THE SALT==dc21c3457a8ff'
));