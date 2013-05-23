<?php
	session_start();

	require_once('bin/params.php');
	
	$_SESSION['membre'] = false;
	$pseudo = $_SESSION['pseudo'];

	if($_SESSION['membre'] == false)
	{
		$status = mysql_query("UPDATE membre SET status = 0 WHERE pseudo_membre = '$pseudo'");
		if(!$status) {echo 'Impossible '.mysql_error(); exit; }
	}
	
	$_SESSION = array();
	
	/*vider_cookie();
	foreach($_COOKIE as $cle => $element)
	{
		setcookie($cle, '', time()-3600);
	}*/
	
	session_destroy();

	header('location: index.php');
?>