<?php

	function contactEtu($from, $to, $objet, $message)
	{
		$destinataire = $to;
		$expediteur = $from;
		$sujet = '[La Boîte à CV] ' . $objet;

		$texte = $message . 
		'<html>
			<br/>
			<hr/>
			<br/>
			<p>Ce mail vous a été envoyé depuis le site <a href="projet_tuteure/index.php">La boîte à CV</a>.<br/> 
			Vous pouvez répondre directement à l\'expéditeur en cliquant sur le bouton "répondre" de votre messagerie.</a></p>
		</html>';

		$envoi = mail($destinataire, $sujet, $message, $expediteur);
		
		if($envoi) return true;
		else return false;
	}

	function contactEtuCopie($from, $to, $objet, $message)
	{
		$destinataire = $from;
		$sujet = 'Votre message "'.$objet.'"';
		$expediteur = 'From : "La boite à CV" <noreply@lbcv.fr>' ;

		$texte = '<p>Votre message a bien été envoyé.</p><br/>
				<p>Voici votre message : </p><br/>' . $message . 
				'<html>
					<br/>
					<hr/>
					<br/>
					<p>Ce mail vous a été envoyé depuis le site <a href="projet_tuteure/index.php">La boîte à CV</a>.</p>
				</html>';

		$envoi = mail($destinataire, $sujet, $message, $expediteur);
		
		if($envoi) return true;
		else return false;
	}
?>