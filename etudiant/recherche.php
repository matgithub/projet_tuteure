
<form method="post" action="recherche.php">
<input type="text" id="id" name="id" />
<input type="submit" name="ok" id="ok" value="ok" />
</form>

<?php

require_once('../bin/params.php');
if(isset($_POST['ok'])){
	$id = $_POST['id'];
$profil = mysql_query("SELECT * FROM membre WHERE id_membre = '$id'");
if(!$profil) {echo 'Impossible'.mysql_error(); exit;}
while($profil = mysql_fetch_assoc($profil))
{
	$id = $profil['ID_MEMBRE'];

	echo "<a href=\"compteEtu.php?id=$id\">Membre</a>";
}
}
?>