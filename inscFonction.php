<?php

	require_once('bin/params.php');

	function checkpseudo($pseudo)
	{
		if($pseudo == '') return 'empty';
		else if(strlen($pseudo) < 3) return 'tooshort';
		else if(strlen($pseudo) > 32) return 'toolong';
		else
		{
			$result = mysql_query("SELECT COUNT(*) AS nbr FROM membre WHERE pseudo_membre = '".mysql_real_escape_string($pseudo)."'");
			if(!$result) {echo 'Impossible'.mysql_error(); exit; }
			$result = mysql_fetch_row($result);
			
			/*echo "$result[0]";*/
			
			if($result[0] == 0) return 'ok';
			else return 'exists';
		}
	}
	
	function checkmdp($mdp)
	{
		if($mdp == '') return 'empty';
		else if(strlen($mdp) < 4) return 'tooshort';
		else if(strlen($mdp) > 50) return 'toolong';
		else
		{
			if(!preg_match('#[0-9]{1,}#', $mdp)) return 'nofigure';
			else if(!preg_match('#[A-Z]{1,}#', $mdp)) return 'noupcap';
			else return 'ok';
		}
	}
	
	function checkmdpverif($mdp, $mdpverif)
	{
		if($mdp != $mdpverif && $mdp != '' && $mdpverif != '') return 'different';
		else return checkmdp($mdp);
	}
	
	function checkmail($mail)
	{
		if($mail == '') return 'empty';
		else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $mail)) return 'isnt';
		else
		{
			$result = mysql_query("SELECT COUNT(*) AS nbr FROM membre WHERE mail_membre = '".mysql_real_escape_string($mail)."'");
			if(!$result) {echo 'Impossible'.mysql_error(); exit; }
			$result = mysql_fetch_row($result);
			
			if($result[0] == 0) return 'ok';
			else return 'exists';
		}
	}
	
	function checkgroup($groupe)
	{
		/*if($groupe == '') return 'empty';
		else if($groupe == '2') return 'etu';
		else if($groupe == '3') return 'ent';*/
		
		if($groupe == 2 || $groupe == 3) return 'ok';
		else return 'empty';
	}
	
	/* Permet de vider les variables mises dans $_SESSION sans détruire la session,
	sinon on ne peut pas créer $_SESSION['inscrit'] */
	function vidersession()
	{
		foreach($_SESSION as $cle => $element)
		{
			unset($_SESSION[$cle]);
		}
	}
?>