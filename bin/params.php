<?php
	
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$base = 'projet_tuteure';
	
	$connexion = mysql_connect($host, $user, $password) or die('Erreur de connexion au SGBD.');
	mysql_select_db($base, $connexion) or die('La base de données n\'existe pas');
	
	/*
	$bdd = mysql_connect("localhost", "root", "");
	mysql_select_db("coursweb");
	

	$adminPseudo='admin';
	$adminPassword='admin';
	
	function bddConnect()
	{
		$dsn = 'mysql:host=localhost;dbname=projet_tuteure';
		$user = 'root';
		$password = '';

		try
		{
			$bdd = new PDO($dsn, $user, $password);
		} catch (PDOException $e)
		{
			echo 'Connexion échouée : ' . $e->getMessage();
		}
	}*/
?>
