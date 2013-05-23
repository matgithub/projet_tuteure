<?php 
	include('../includes/menus.php'); 
	
	session_start();
	require_once('../bin/params.php');
	
	if((isset($_SESSION['membre']) == true) && (($_SESSION['groupe'] == 2) || ($_SESSION['groupe'] == 1)))
	{
		menuEtudiant();
?>
		<h1>Modification des infos persos</h1>
		<div class="modifForm">
		<fieldset><legend>Modification des infos</legend>
			<form class="modifpseudo" method="post" action="modifEtu.php" >
				<fieldset><legend>Modification du pseudo</legend>
					<label for="pseudo">Pseudo actuel : </label> 
						<input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_SESSION['pseudo'])){echo htmlentities($_SESSION['pseudo'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
					<label for="pseudonew">Nouveau pseudo : </label> 
						<input type="text" name="pseudonew" id="pseudonew" /><br />
					
					<input type="hidden" name="modifpseudo" id="modifpseudo" value="modifpseudo" />
					<input type="submit" value="Modifier" /><br/>
				
			
					<?php
					if(isset($_POST['modifpseudo']))
					{
						if(isset($_POST['pseudonew']) && ($_POST['pseudonew'] != ''))
						{
							$pseudo = $_POST['pseudonew'];
							
							$maj = mysql_query("UPDATE membre SET pseudo_membre = '$pseudo'");
							if(!$maj) { echo 'Erreur : '.mysql_error(); exit; }
							else { $_SESSION['pseudo'] = $pseudo; echo 'Votre pseudo à bien été changé.'; }
						}
						else echo 'Vous devez entrer un nouveau pseudo';
					}
					?>
				</fieldset>
			</form>
			<form class="modifmdp" method="post" action="modifEtu.php" >
				<fieldset><legend>Modification du mot de passe</legend>
					<label for="mdp">Mot de passe actuel : </label> 
						<input type="password" name="mdp" id="mdp" /><br />
					<label for="mdpnew">Nouveau mot de passe : <span class="small">(4 caract&egrave;res min.)</span></label> 
						<input type="password" name="mdpnew" id="mdpnew" /><br />
					<label for="mdpverifnew">Retapez le mot de passe : </label> 
						<input type="password" name="mdpverifnew" id="mdpverifnew" /><br />
					
					<input type="hidden" name="modifmdp" id="modifmdp" value="modifmdp" />
					<input type="submit" value="Modifier" /><br/>
					
					<?php
					if(isset($_POST['modifmdp']))
					{
						if( (isset($_POST['mdp']) && ($_POST['mdp'] != '')) && (isset($_POST['mdpnew']) && ($_POST['mdpnew'] != '')) )
						{
							if(isset($_POST['mdpverifnew']) && ($_POST['mdpverifnew'] == $_POST['mdpnew']))
							{
								$mdp = sha1($_POST['mdpnew']);
								
								$maj = mysql_query("UPDATE membre SET pass_membre = '$mdp'");
								if(!$maj) { echo 'Erreur : '.mysql_error(); exit; }
								else { $_SESSION['mdp'] = $mdp; echo 'Votre mot de passe à bien été changé'; }
							}
							else
							{
								echo 'Veuillez retaper votre mot de passe';
							}
						}
						else echo 'Vous devez entrer un nouveau mot de passe';
					}
					?>
				</fieldset>
			</form>
			
			
			
			<form class="modifmail" method="post" action="modifEtu.php" >
				<fieldset><legend>Modification de l'adresse mail</legend>
					<label for="mail" >Adresse mail actuelle : </label> 
						<input type="email" name="mail" id="mail" value="<?php if(isset($_SESSION['mail'])){echo htmlentities($_SESSION['mail'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
					<label for="mailnew" >Adresse mail : </label> 
						<input type="email" name="mailnew" id="mailnew" /><br />
					
					<input type="hidden" name="modifmail" id="modifmail" value="modifmail" />
					<input type="submit" value="Modifier" /><br/>
					
					<?php
					if(isset($_POST['modifmail']))
					{
						if(isset($_POST['mailnew']) && ($_POST['mailnew'] != ''))
						{
							$mail = $_POST['mailnew'];
							
							$maj = mysql_query("UPDATE membre SET mail_membre = '$mail'");
							if(!$maj) { echo 'Erreur : '.mysql_error(); exit; }
							else 
							{ 
								$_SESSION['mail'] = $mail; 
								echo 'Votre adresse mail à bien été changée.'; 
								/*envoiMail($mail, $_SESSION['pseudo'], $_SESSION['mdp']);*/
							}
						}
						else echo 'Vous devez entrer une nouvelle adresse mail';
					}
					?>
				</fieldset>
			</form>
			
			
			<form method="post" action="modifEtu.php" class="modifier" >
				<input type="hidden" name="modiftout" id="modiftout" value="modiftout" />
				<input type="submit" value="Modifier tout" /><br/>
				
				<?php
					if(isset($_POST['modiftout']))
					{
						if( (isset($_POST['pseudonew']) && ($_POST['pseudonew'] != '')) && (isset($_POST['mdpnew']) && ($_POST['mdpnew'] != '')) && (isset($_POST['mailnew']) && ($_POST['mailnew'] != '')) )
						{
							if(isset($_POST['mdpverifnew']) && ($_POST['mdpverifnew'] == $_POST['mdpnew']))
							{
								$pseudo = $_POST['pseudonew'];
								$mdp = sha1($_POST['mdpnew']);
								$mail = $_POST['mailnew'];
								
								$maj = mysql_query("UPDATE membre SET pass_membre = '$mdp', mail_membre = '$mail', pseudo_membre = '$pseudo'");
								if(!$maj) { echo 'Erreur : '.mysql_error(); exit; }
								else 
								{ 
									$_SESSION['mdp'] = $mdp; 
									$_SESSION['pseudo'] = $pseudo; 
									$_SESSION['mail'] = $mail; 
									echo 'Vos informations ont bien été changées'; 
								}
							}
							else
							{
								echo 'Veuillez retaper votre mot de passe';
							}
						}
						else /*if(($_POST['pseudonew'] == '') || ($_POST['mdpnew'] == '') || ($_POST['mailnew'] == ''))*/
						{
							echo 'Vous devez remplir tous les champs pour tout modifier.';
						}
					}
				?>
			</form>
		</fieldset>
		</div>
<?php
		
		
	}
	else header('location : ../index.php');
?>