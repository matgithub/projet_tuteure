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
?>

<!-- 
	Affichage du pseudo et gestion de l'avatar 
-->
		<fieldset><legend>Mon profil</legend>
			Bonjour <?php echo $_SESSION['pseudo']; ?> et bienvenue sur votre profil.<br/>

<?php 
			$avatar = mysql_query("SELECT * FROM membre WHERE id_membre = '$id'");
			if(!$avatar) {echo 'Impossible'.mysql_error(); exit;}
			else 
			{ 
				if($avatar = mysql_fetch_object($avatar)) 
				{
					$avatar = $avatar->IMAGE;
				}
			}
			if($avatar == '')
			{
?>
				<img class="avatar" src="../includes/images/image.jpg" /><br/>
<?php
			}
			else
			{
				echo "<img class=\"avatar\" src=\"$avatar\" width=\"160\" height=\"160\" /></br>";
			}
?>
			<form method="post" action="uploadImage.php" enctype="multipart/form-data" >
				<input type="file" name="avatar" />
				<input type="hidden" name="id" value="<?php echo $_SESSION['id_membre']; ?>"/>
				<input type="submit" value="Ok" />
			</form>
			<p>L'avatar doit être un fichier au format .jpg, jpeg, .gif ou .png uniquement. Sa taille ne doit pas dépasser 2 Mo.</p>
		</fieldset>
		

<!-- 
	Gestion des informations personnelles 
-->
<?php		
		$profil = mysql_query("SELECT * FROM membre WHERE id_membre = '$id'");
		if(!$profil) {echo 'Impossible'.mysql_error(); exit;}
		$profil = mysql_fetch_assoc($profil);
?>
		<fieldset class="perso"><legend>Mon compte</legend>
			<a href="modifEtu.php">Modifier mes infos persos</a><br/>
			<?php echo "<a href=\"profilEtu.php?etu=$id\">Voir mon profil</a><br/>" ?>
			<a href="motivations.php">Modifier mes motivations</a><br/>
			<a href="">Modifier le thème du profil</a><br/>
			<?php echo "<a href=\"supprimerCompte.php?etu=$id\">Supprimer mon compte</a>"; ?>
		</fieldset>


<!-- 
	Gestion des inforations publiques 
-->
		<fieldset class="cv"><legend>Mon CV en ligne</legend>
			<!-- $id = $_SESSION['id_etudiant'];
			$cv = mysql_query("SELECT status_cv FROM cv WHERE id_etudiant = '$id'");
			if($cv == 'on') <a href="">Modifier</a><br/>;
			else if($cv == 'off') <a href="">Mettre en ligne</a><br/>;
			-->
			<a href="etape1.php">Mettre en ligne</a><br/>
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