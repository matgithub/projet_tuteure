<?php 
	include('../includes/menus.php');
	
	session_start();
	require_once('../bin/params.php');
	
	if((isset($_SESSION['membre']) == true) && (($_SESSION['groupe'] == 2) || ($_SESSION['groupe'] == 1)))
	/*Penser à faire un second if pour l'admin ensuite --> pouvoir modifir l'arragement...*/
	{
		menuEtudiant();
		voletDisconnect();
		$id = $_SESSION['id_membre'];

		$compte = "SELECT * FROM membre WHERE id_membre = $id
				";
	}
?>