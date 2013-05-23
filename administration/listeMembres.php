<?php
	
	include('../includes/menus.php');
	require_once('../bin/params.php');
	session_start();

	if((isset($_SESSION['membre'])) && ($_SESSION['groupe'] == 1))
	{


			echo "Liste des etudiants : ";
			$r = mysql_query("SELECT * FROM membre WHERE id_groupe=2 ORDER BY id_membre");
			while($data = mysql_fetch_object($r))
			{
				$id_etu = $data->ID_MEMBRE;
				
				echo "<a href=\"profil.php?etu=$id_etu\">Liste des etudiants</a><br/>";
			}

			echo "Liste des entreprises : ";
			$a = mysql_query("SELECT * FROM membre WHERE id_groupe=3 ORDER BY id_membre");
			while($dataent = mysql_fetch_object($a))
			{
				$id_ent = $dataent->ID_MEMBRE;
				
				echo "<a href=\"profilent.php?ent=$id_ent\">Entreprise</a>";
			}


	}
	else header('location : ../index.php');
?>