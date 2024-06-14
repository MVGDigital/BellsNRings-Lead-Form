<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'bnrdb');

	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false)
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	
	if (isset($_SESSION["errorType"]) && isset($_SESSION["errorMsg"]) )
	{
		$ERROR_TYPE = $_SESSION["errorType"];
		
		$ERROR_MSG = $_SESSION["errorMsg"];
		unset($_SESSION["errorType"]);
		unset($_SESSION["errorMsg"]);
	}
	else
	{
		$ERROR_TYPE = '';
		$ERROR_MSG = '';
	}
	
	$url = 'http://localhost/BellsNRings/BellsNRings-Lead-Form';
	$encryption_key = 'bnr-form-2024';

?>