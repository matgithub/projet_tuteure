<head>
	<script type="text/javascript" src="../ckeditor_std/ckeditor/ckeditor.js"></script>
</head>
<?php
	include('../includes/menus.php');
	
	session_start();
	require_once('../bin/params.php');
	include('contactMail.php');
	
	if((isset($_SESSION['membre']) == true) && (($_SESSION['groupe'] == 3) || ($_SESSION['groupe'] == 1) || ($_SESSION['groupe'] == 2)))
	/*Penser à faire un second if pour l'admin ensuite --> pouvoir modifir l'arragement...*/
	{
		menuEtudiant();
		voletDisconnect();

		$id_etu = (int) $_GET['etu']; /* id du membre a contacter */
		$id_membre = $_SESSION['id_membre']; /* id du membre qui envoie un message */
?>
	
		<?php echo "<form method=\"post\" action=\"contactForm.php?etu=$id_etu\" class=\"contactetu\">"; ?>
			<label for="objet">Objet</label> <input type="text" name="objet" id="objet" size=50 required /><br/>
			<label for="message">Message</label><br/> <textarea class="ckeditor" name="message" id="message" cols=50 rows=10 required ></textarea></br>
			
			<input type="checkbox" name="copie" id="copie" />Recevoir une copie du mail<br/>
			
			<input type="submit" name"envoi" id="envoi" value="Envoyer" />
			<input type="reset" value="Réinitialiser" />
		</form>
<?php


/* On recupere le mail et le groupe de l'expediteur avec une requete SQL pour plus de securite
On pourrais aussi utiliser les variables de sessions */
			$mail = mysql_query("SELECT * FROM membre WHERE id_membre = $id_membre");
			if(!$mail) {echo "Erreur : " . mysql_error(); exit;}
			if($mail = mysql_fetch_object($mail))
			{
				$from = $mail->MAIL_MEMBRE;
				$groupe = $mail->ID_GROUPE;
			}


/* Si l'expediteur est un etudiant */
			if($groupe == 2)
			{
				$nom = mysql_query("SELECT * FROM etudiant WHERE id_membre = $id_membre");
				if(!$nom) {echo "Erreur : ".mysql_error(); exit;}
				if($nom = mysql_fetch_object($nom))
				{
					$nom_etu = $nom->NOM_ETU;
					$prenom_etu = $nom->PRENOM_ETU;
				}
			}


/* Si l'expediteur est une entreprise */
			if($groupe == 3)
			{
				$nom = mysql_query("SELECT * FROM entreprise WHERE id_membre = $id_membre");
				if(!$nom) {echo 'Impossible '.mysql_error(); exit;}
				if($nom = mysql_fetch_object($nom))
				{
					$nom_ent = $nom->NOM_ENT;
				}
			}


/* On recupere le mail du destinataire puis ses nom et prenom */
			$dest = mysql_query("SELECT * FROM membre WHERE id_membre = $id_etu");
			if(!$dest) {echo 'Impossible '.mysql_error(); exit;}
			if($dest = mysql_fetch_object($dest))
			{
				$to = $dest->MAIL_MEMBRE;
			}
			$nom_dest = mysql_query("SELECT * FROM etudiant WHERE id_membre = $id_etu");
			if(!$nom_dest) {echo "Erreur ".mysql_error(); exit;}
			if($nom_dest = mysql_fetch_object($nom_dest))
			{
				$nom = $nom_dest->NOM_ETU;
				$prenom = $nom_dest->PRENOM_ETU;
			}


/* On vérifie les champs envoyes par l'expediteur */
		if(isset($_POST['objet']) && $_POST['objet'] != '')
		{
			$objet = mysql_real_escape_string($_POST['objet']);

			if(isset($_POST['message']) && $_POST['message'] != '')
			{
				$message = mysql_real_escape_string($_POST['message']);

				if(isset($_POST['copie']) && $_POST['copie'] == 'on')
				{
					contactEtuCopie($from, $to, $objet, $message);
				}

				if(contactEtu($from, $to, $objet, $message) && contactEtuCopie($from, $to, $objet, $message)) 
				{
					echo "Votre mail a bien été envoyé à ".$prenom.' '.$nom." et vous allez recevoir une copie dans votre boîte mail.";
				}
				else if(contactEtu($from, $to, $objet, $message))
				{
					echo "Votre mail a bien été envoyé à ".$prenom.' '.$nom.'.';
				}
			}
			else
			{
				echo "Vous ne pouvez pas envoyer un mail sans texte !";
			}
		}
	}
?>