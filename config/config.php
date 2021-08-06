<?php
	extract($_GET);
	$uri = '';

	$page = 'user';
	$pg = '';
	$pg2 = '';
	
	///Page definitions
	define('BASE_URL', 'http://'.$_SERVER['SERVER_NAME'].'/projects/alumni_web/');
	define('APP_TITLE', 'Alumni Management');
	define('APP_LOGO', 'Alumni Management');
	define('PAGE_COLOR', 'primary');
	define('HEADER_COLOR', 'dark');
	define('HEADER_BG', 'primary');

	///DB DEFINITIONS
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'alumni_db');
	define('DB_USER', 'root');
	define('DB_PASS', '');

	////Page utils
	$url = '';
	if(isset($_GET['url']))
	{
		$url = rtrim($_GET['url'], '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
	}

	if(explode('/', $url)[0] == 'admin'){
		$page = 'admin';
	}else{
		$page = 'user';
	}
	$urlArr = explode('/', $url);
	$pg = $urlArr[0]; 
	$pg2 = isset($urlArr[1])? $urlArr[1]:'';
?>