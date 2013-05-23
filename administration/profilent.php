<?php
	$id_ent = (int) $_GET['ent'];

	require_once('../bin/params.php');

	$entreprise = mysql_query("SELECT * FROM membre WHERE id_membre = '$id_ent'");
	if(!$entreprise) {echo "erreur"; exit;}

	if(mysql_num_rows($entreprise) != false)
	{
		while($a = mysql_fetch_object($entreprise))
		{
			$pseudo_ent = $a->PSEUDO_MEMBRE;
		}
	}

	echo "Profil de $pseudo_ent.";
?>