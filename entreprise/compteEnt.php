<?php 
	include('../includes/menus.php'); 
	
	session_start();
	require_once('../bin/params.php');
	
	if((isset($_SESSION['membre']) == true) && (($_SESSION['groupe'] == 3) || ($_SESSION['groupe'] == 1)))
	/*Penser à faire un second if pour l'admin ensuite --> pouvoir modifir l'arragement...*/
	{
		menuEntreprise();
		
		$id = $_SESSION['id_membre'];
		
		$profil = mysql_query("SELECT * FROM membre WHERE id_membre = '$id'");
		if(!$profil) {echo 'Impossible'.mysql_error(); exit;}
		$profil = mysql_fetch_assoc($profil);
		/*print_r($profil);*/
?>
		<fieldset class="perso"><legend>Mon compte</legend>
			<a href="modifEnt.php">Modifier mes infos persos</a><br/>
			<a href="">Ajouter un avatar</a><br/>
			<a href="">Modifier le thème</a><br/>
			<a href="">Supprimer mon compte</a>
		</fieldset>
		<fieldset class="cv"><legend>Mon CV en ligne</legend>
			<!-- if(cv existe) modifier();
			else mettre en ligne();-->
			<a href="">Mettre en ligne</a><br/>
			<a href="">Modifier</a><br/>
			<a href="">Voir mon cv en ligne</a><br/>
			<a href="">Suspendre l'affichage</a><br/>
			<a href="">Modifier le design</a><br/>
			<a href="">Supprimer le cv</a>
		</fieldset>
<?php
	}
	else header('location : ../index.php');
?>