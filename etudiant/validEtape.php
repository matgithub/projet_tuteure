<?php
	if(isset($_POST['ok']))
	{
		/*header('location:etape2.php');*/
		header('location:23.php');
	}

	if(isset($_POST['ok2']))
	{
		header('location:etape3.php');
	}

	if(isset($_POST['ok3']))
	{
		header('location:etape4.php');
	}

	if(isset($_POST['ok4']))
	{
		header('location:profilEtu.php?');
	}
?>