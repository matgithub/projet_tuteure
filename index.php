<!DOCTYPE html>
<html>
	<head>
		<title>La boite a CV</title>
		<link href="includes/menu.css" rel="stylesheet" type="text/css">
		<link href="includes/style.css" rel="stylesheet" type="text/css">
		<link href="includes/volet.css" rel="stylesheet" type="text/css">
	</head>
	
	<body>
		<header>Bienvenue sur le site !</header>
		
		<?php 
		include('includes/menus.php'); 
		
		session_start();
		require_once('bin/params.php');
		
		if(isset($_SESSION['membre']) == true)
		{
			if($_SESSION['groupe'] == 1) menuAdmin();
			else if($_SESSION['groupe'] == 2) menuEtudiant();
			else if($_SESSION['groupe'] == 3) menuEntreprise();

			voletDisconnect();
		}
		else{ menuSimple(); voletConnect(); }
		?>	

		<footer>Fait par Sev</footer>
	</body>
</html>