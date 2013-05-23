<?php
	$id = (int) $_GET['etu'];

	require_once('../bin/params.php');

	$etudiant = mysql_query("SELECT * FROM membre WHERE id_membre = '$id'");
	if(!$etudiant) {echo "erreur"; exit;}


	if(mysql_num_rows($etudiant) != false)
	{
		while($a = mysql_fetch_object($etudiant))
		{
			$pseudo = $a->PSEUDO_MEMBRE;
		}
	}

	echo "Profil de $pseudo.";
?>