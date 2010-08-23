<?php
//location of the mysql db
SweetFramework::getClass('lib', 'Config')->setAll('databases', array(
	'default' => array(
		'driver' => 'My_SQL',
		'host' => 'localhost',
		'username' => 'root',
		'password' => 'dworkram',
		'databaseName' => 'sweet-test'
	)
));