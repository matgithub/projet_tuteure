<?php
	include('../includes/menus.php');
	session_start();

	require_once('../bin/params.php');

	if((isset($_SESSION['membre']) == true) && (($_SESSION['groupe'] == 3) || ($_SESSION['groupe'] == 1) || ($_SESSION['groupe'] == 2)))
	{
		menuEtudiant();
		voletDisconnect();
		
		$id_etu = (int) $_GET['etu'];

		$etudiant = mysql_query("SELECT * FROM membre WHERE id_membre = '$id_etu'");
		if(!$etudiant) {echo 'Impossible'.mysql_error(); exit;}

		if(mysql_num_rows($etudiant) != false)
		{
			while($a = mysql_fetch_object($etudiant))
			{
				$pseudo = $a->PSEUDO_MEMBRE;
				$mail = $a->MAIL_MEMBRE;
				$date = $a->DATE_INSC;
				$avatar = $a->IMAGE;
				$status = $a->STATUS;
			}
		}

		echo "Vous êtes sur le profil de $pseudo.</br><br/>";
		echo "<img class=\"avatar\" src=\"$avatar\" width=\"160\" height=\"160\"/></br>";

		if($status == 0)
			{echo "Le membre est n'est pas en ligne.<br/>";}
		else
			{echo "Le membre est en ligne.<br/>";}

		echo "Date d'inscription sur La Boîte à CV : $date.<br/>";

		echo "<a href=\"mailto:$mail\" /><input type=\"button\" value=\"Contacter\" /></a><br/>";

		echo "<a href=\"contactForm.php?etu=$id_etu\" /><input type=\"button\" value=\"Contacter l'etudiant\" /></a><br/>";

		echo "<a href=\"cv.php?cv=$idcv\">voir son cv</a><br/>";

		echo "Mes motivations : </br>";


	}
	else
	{
		echo "entree interdite </br>";
		if(!isset($_SESSION['membre']))
		{
			echo "vous n'etes pas co.</br>";
		}
	}
?>