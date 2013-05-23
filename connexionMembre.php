<?php
	session_start();
	require_once('bin/params.php');

	if(isset($_SESSION['id_membre']))  // test si le membre est déjà connecté
	{
		exit('Vous êtes déjà connecté avec le pseudo '.htmlspecialchars($_SESSION['pseudo'], ENT_QUOTES).'.');
	}
	
	if(isset($_POST['pseudo'], $_POST['mdp']))
	{
		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp'];
		
		$membre = "SELECT * FROM membre WHERE pseudo_membre ='$pseudo'";
		$existe = mysql_query($membre);
		if(!$existe) {echo 'Impossible '.mysql_error(); exit; }
		
		if(mysql_num_rows($existe) == 0)
		{
			echo 'Le pseudo n\'existe pas';
		}
		else if($existe != false)
		{
			$data = mysql_fetch_assoc($existe);
			/*print_r($data);*/
			
			if($data != false)
			{
				if(sha1($mdp) == $data['PASS_MEMBRE'])
				{
					$_SESSION['mail'] = $data['MAIL_MEMBRE'];
					$_SESSION['mdp'] = $data['PASS_MEMBRE'];
					$_SESSION['pseudo'] = $data['PSEUDO_MEMBRE'];
					$_SESSION['groupe'] = $data['ID_GROUPE'];
					$_SESSION['id_membre'] = $data['ID_MEMBRE'];
					
					$_SESSION['membre'] = true;
					
					if(isset($_POST['cookie']) && $_POST['cookie'] == 'on')
					{
						setcookie('id_membre', $data['ID_MEMBRE'], time()+365*24*3600);
						setcookie('pass_membre', $data['PASS_MEMBRE'], time()+365*24*3600);
					}

					if($_SESSION['membre'] == true)
					{
						$status = mysql_query("UPDATE membre SET status = 1 WHERE pseudo_membre = '$pseudo'");
						if(!$status) {echo 'Impossible '.mysql_error(); exit; }
					}

				/*	if($_SESSION['groupe'] == 2)
					{
						$etu = "SELECT * FROM etudiant WHERE id_membre ='$_SESSION['id_membre']'";
						$existe = mysql_query($etu);
						if(!$existe) {echo 'Impossible '.mysql_error(); exit; }

						$dataetu = mysql_fetch_assoc($existe);

						$_SESSION['nometu'] = $dataetu['NOM_ETU'];
					}

					if($_SESSION['groupe'] == 3)
					{
						$ent = "SELECT * FROM entreprise WHERE id_membre ='$_SESSION['id_membre']'";
						$existe = mysql_query($ent);
						if(!$existe) {echo 'Impossible '.mysql_error(); exit; }

						$dataent = mysql_fetch_assoc($existe);

						$_SESSION['noment'] = $dataetu['NOM_ENT'];
					}
*/
					header('location: index.php');
				}
				else 
				{
					echo 'Mauvais mot de passe : ' .sha1($password);
				}
			}
			else
			{
				echo 'Erreur dans la base de données';
			}
		}
		else
		{
			echo 'Erreur dans la base de données';
		}
	}
	else
	{
		echo 'Une erreur est survenue, veuillez réessayer..';
		$_SESSION['membre'] = false;
	}

?>