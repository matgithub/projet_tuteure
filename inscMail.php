<?php
	function envoiMail($mail, $pseudo, $mdp)
	{
		$destinataire = $mail;
		$sujet = "Inscription sur TITRESITE" ;
		$entete = "From: noreply@shoezYparadise.com" ;

		$message = 
		'<html>
			<head>
				<title>Votre inscription sur TITRESITE</title>
			</head>
			
			<body>
				<div class="mail">
					<p>Bonjour '.$pseudo.' et bienvenue sur TITRESITE !</p><br/>
					<p>Votre compte a bien été créé avec le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).'.</p>
					<p>Votre mot de passe est : '.htmlspecialchars($mdp, ENT_QUOTES).'</p>
					<p>Veillez à garder ces informations secrêtes et à ne pas les oublier.</p>
					<br/><br/>
					<p>L\'équipe de TITRESITE.</p>

					<p>---------------<br/>
					Ceci est un mail automatique, veuillez ne pas répondre.<br/>
					Pour nous contacter, <a href="contact.php">cliquer ici</a>.</p>
				</div>
			</body>
		</html>';

		$envoi = mail($destinataire, $sujet, $message, $entete); // Envoi du mail
		
		if($envoi) return true;
		else return false;
	}
?>