<head>
	<script type="text/javascript" src="../ckeditor_std/ckeditor/ckeditor.js"></script>
</head>
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

		if(isset($_POST['ok']) /*&& isset($_POST['motiv'])*/)
		{
			$motivation = $_POST['motiv'];

			$search = mysql_query("SELECT * FROM motivation WHERE id_membre = $id");
			if(!$search) {echo 'Erreur '.mysql_error(); exit;}
			$search_rows = mysql_num_rows($search);

			if($search_rows == 0)
			{
				$insert = mysql_query("INSERT INTO motivation (id_membre, text_motiv) VALUES ('$id', '$motivation')");
				if(!$insert) {echo 'Erreur '.mysql_error(); exit;}
				else {echo "motivations mises a jour";}
			}
			else if($search_rows == 1)
			{
				$up = mysql_query("UPDATE motivation SET text_motiv = '$motivation'");
				if(!$up) {echo 'Erreur '.mysql_error(); exit;}
				else {echo "motivations mises a jour";}
			}
			else
			{
				echo "Erreur";
			}
		}

		$motiv = mysql_query("SELECT * FROM motivation WHERE id_membre = $id");
		if(!$motiv) {echo 'Impossible '.mysql_error(); exit;}
		if($texte = mysql_fetch_object($motiv))
		{
			$text = $texte->TEXT_MOTIV;
		}
	}
	else header('location : ../index.php');
?>

<h1>Mes motivations</h1>
<form method="post" action="motivations.php">
	<?php echo "<textarea class=\"ckeditor\" name=\"motiv\" > $text </textarea><b/>"; ?>
	<input type="submit" name="ok" id="ok" value="Valider" /><br/>
	<!--<input type="reset" value="Recommencer" />
	<a href=""><input type="button" value="Previsualiser" /></a>-->
</form>	