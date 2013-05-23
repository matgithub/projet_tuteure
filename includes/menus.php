<head>
<style type="text/css">
	<?php require('menu.css'); 
		require('style.css'); 
		require('volet.css'); 
	?>
</style>

	<script type="text/javascript" src="../ckeditor_std/ckeditor.js"></script>
	<script type="text/javascript" src="../ckeditor_full/ckeditor.js"></script>
</head>

<?php
	function menuSimple()
	{
?>
		<div class="menu">
			<ul>
				<li><a href="../index.php">Accueil</a></li>
				<li><a href="#">Forum d'aide</a></li>
				<li><a href="#">Recherche</a></li>
				<li><a href="inscription.php">Inscription</a></li>
				<!--<li><a href="deconnexionMembre.php">Deconnexion</a></li>-->
			</ul>
		</div>
<?php
	}
	
	function menuAdmin()
	{
?>
		<div class="menu">
			<ul>
				<li><a href="../index.php">Accueil</a></li>
				<li><a href="etudiant/compteEtu.php">Etudiant</a></li>
				<li><a href="entreprise/compteEnt.php">Entreprise</a></li>
				<li><a href="#">Forum d'aide</a></li>
				<li><a href="#">Recherche</a></li>
				<li><a href="administration/listeMembres.php">Membres</a></li>
			<!--<li><a href="deconnexionMembre.php">Deconnexion</a></li>-->
			</ul>
		</div>
<?php
	}
	
	function menuEtudiant()
	{
		/*$id_membre = $_SESSION['id_membre'];
		$r = mysql_query("SELECT * FROM membre WHERE id_membre=$id_membre");
		while($data = mysql_fetch_object($r))
		{
			$page = $data->ID_MEMBRE;
			
			echo "<div class=\"menu\">
					<ul>
						<li><a href=\"../index.php\">Accueil</a></li>
						<li><a href=\"etudiant/compteEtu.php/$page\">Mon compte</a></li>
						<li><a href=\"#\">Forum d'aide</a></li>
						<li><a href=\"#\">Recherche</a></li>
						<!--<li><a href=\"deconnexionMembre.php\">Deconnexion</a></li>-->
					</ul>
				</div>";
 		}*/

?>
		<div class="menu">
			<ul>
				<li><a href="../index.php">Accueil</a></li>
				<li><a href="etudiant/compteEtu.php">Mon compte</a></li>
				<li><a href="#">Forum d'aide</a></li>
				<li><a href="#">Recherche</a></li>
				<!--<li><a href="deconnexionMembre.php">Deconnexion</a></li>-->
			</ul>
		</div>
<?php
	}
	
	function menuEntreprise()
	{
?>
		<div class="menu">
			<ul>
				<li><a href="../index.php">Accueil</a></li>
				<li><a href="entreprise/compteEnt.php">Mon compte</a></li>
				<li><a href="#">Forum d'aide</a></li>
				<li><a href="#">Recherche</a></li>
				<!--<li><a href="deconnexionMembre.php">Deconnexion</a></li>-->
			</ul>
		</div>
<?php
	}

	function voletDisconnect()
	{
?>
			<div id="volet_clos">
				<div id="volet">
				    <form class="connexion" method="post" action="../../projet_tuteure/deconnexionMembre.php" >
						<p>Vous êtes connecte avec le pseudo <?php echo $_SESSION['pseudo'] ?></p>
						<input type="submit" value="Deconnexion" id="deconnectButton" />
					</form>
				    <a href="#volet" class="ouvrir">Se deconnecter</a>
				    <a href="#volet_clos" class="fermer">Se deconnecter</a>
				</div>
			</div>
<?php
	}

	function voletConnect()
	{
?>
			<div id="volet_clos">
				<div id="volet">
				    <form class="connexion" method="post" action="connexionMembre.php" >
				    	<input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" autofocus /><br/>
				    	<input type="password" name="mdp" id="mdp" placeholder="Mot de passe" /><br/><br/>
				    	<input type="checkbox" name="cookie" id="cookie"/> <label for="cookie">Rester connecte(e)</label><br/><br/>
						<input type="submit" value="Connexion" id="connectButton" />
					</form>
				    <a href="#volet" class="ouvrir">Se connecter</a>
				    <a href="#volet_clos" class="fermer">Se connecter</a>
				</div>
			</div>
<?php
	}
?>