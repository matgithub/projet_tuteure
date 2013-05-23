<?php
	
	require_once('bin/params.php');
	include('inscFonction.php');
	include('inscMail.php');
	
	$form = true;
	
	if(isset($_POST['pseudo'], $_POST['mdp'], $_POST['mdpverif'], $_POST['mail'], $_POST['groupe']))
	{
		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp'];
		$mdpverif = $_POST['mdpverif'];
		$mail = $_POST['mail'];
		$groupe = $_POST['groupe'];
		
		$pseudo_result = checkpseudo($pseudo);
		$mdp_result = checkmdp($mdp);
		$mdpverif_result = checkmdpverif($mdp, $mdpverif);
		$mail_result = checkmail($mail);
		$groupe_result = checkgroup($groupe);
		
		if($pseudo_result == 'ok')
		{
			if($mdp_result == 'ok')
			{
				if($mdpverif_result == 'ok')
				{
					if($mail_result == 'ok')
					{
						if($groupe_result == 'ok')
						{
							$pseudo = mysql_real_escape_string($_POST['pseudo']);
							$mdp = mysql_real_escape_string($_POST['mdp']);
							$mdphache = sha1($_POST['mdp']); // Hachage du mot de passe
							$mail = mysql_real_escape_string($_POST['mail']);
							$groupe = intval($_POST['groupe']);
							
							$insert = 'INSERT INTO membre(id_groupe, pseudo_membre, pass_membre, mail_membre, date_insc) 
									  values("'.$groupe.'", "'.$pseudo.'", "'.$mdphache.'", "'.$mail.'", CURDATE())';
							$insertion = mysql_query($insert);
							
							if($insertion)
							{
								if(envoiMail($mail, $pseudo, $mdp)) $envoye = 'Un mail de confirmation vous a été envoyé à l\'adresse '.htmlspecialchars($email, ENT_QUOTES).'';
								else $sent = 'Un mail de confirmation devait être envoyé, mais son envoi a échoué, vous êtes cependant bien inscrit.';
								
								echo '<div class="message">Vous avez bien &eacute;t&eacute; inscrit. Vous pouvez dor&eacute;navant vous connecter.<br />';
								echo "$sent";
								echo '<a href="connexionForm.php">Se connecter</a></div>';
								
								$form = false;
							}
							else
							{
								echo 'Une erreur est survenue lors de l\'inscription.';
								$form = true;
							}
						}
						else
						{
							echo "Erreur groupe : $groupe_result";
							$form = true;
						}
					}
					else
					{
						echo "Erreur mail : $mail_result";
						$form = true;
					}
				}
				else
				{
					echo "Erreur mdpverif : $mdpverif_result";
					$form = true;
				}
			}
			else
			{
				echo "Erreur mdp : $mdp_result";
				$form = true;
			}
		}
		else
		{
			echo "Erreur pseudo : $pseudo_result";
			$form = true;
		}
	}
	else
	{
		$form = true;
	}
	
	if($form == true)
	{
?>
		<div class="inscForm">
			<form class="inscription" method="post" action="inscription.php" >
				<label for="pseudo" >Pseudo : </label> <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_POST['pseudo'])){echo htmlentities($_POST['pseudo'], ENT_QUOTES, 'UTF-8');} ?>" required /><br />
				<label for="mdp" >Mot de passe : <span class="small">(4 caract&egrave;res min.)</span></label> <input type="password" name="mdp" id="mdp" required /><br />
				<label for="mdpverif" >Retapez votre mot de passe : </label> <input type="password" name="mdpverif" id="mdpverif" required /><br />
				<label for="mail" >Adresse mail : </label> <input type="email" name="mail" id="mail" value="<?php if(isset($_POST['mail'])){echo htmlentities($_POST['mail'], ENT_QUOTES, 'UTF-8');} ?>" required /><br />
				<label for="groupe" >Vous êtes : </label><br />
					<input type="radio" name="groupe" value="2" id="2" /> <label for="etu">Un(e) étudiant(e) </label><br/>
					<input type="radio" name="groupe" value="3" id="3" /> <label for="ent">Une entreprise </label></br>
				<input type="submit" value="Ok" />
			</form>
		</div>
<?php
	}
?>