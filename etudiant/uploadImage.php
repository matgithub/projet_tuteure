<?php
	session_start();

	require_once('../bin/params.php');

	if(isset($_SESSION['membre']) && ($_SESSION['membre'] == true) && (($_SESSION['groupe'] == 2) || ($_SESSION['groupe'] == 1)))
	{
		if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0)
		{
			if($_FILES['avatar']['size'] <= 2000000) /* =2Mo */
			{
				$infosfichier = pathinfo($_FILES['avatar']['name']);
				$extension_upload = $infosfichier['extension'];
				$enxtension_autorisees = array('jpg', 'jpeg', 'gif', 'png');

				if(in_array($extension_upload, $enxtension_autorisees))
				{
					$id_etu = $_SESSION['id_membre'];

					$nom = "avatars/{$id_etu}.{$extension_upload}";
					$up_avatar = move_uploaded_file($_FILES['avatar']['tmp_name'], $nom);
					if($up_avatar)
					{
						$insertion = mysql_query("UPDATE membre SET image = '$nom' WHERE id_membre = $id_etu");
						if(!$insertion) {echo 'Erreur : '.mysql_error(); exit;}
						else {echo "Mise à jour de l'avatar réussie.";}
					}
					else {echo "Erreur de transfert, veuillez réessayer.";}
				}
				else
				{
					echo "Le fichier n'a pas une extension valide !"
				}
			}
			else
			{
				echo "Le fichier est trop gros !";
			}
		}
	}

?>
