<div class="coForm">
	<form class="connexion" method="post" action="connexionMembre.php" >
		<label for="pseudo" >Pseudo : </label> <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_SESSION['pseudo'])) echo $_SESSION['pseudo']; ?>" required /><br />
		<label for="mdp" >Mot de passe : </label> <input type="password" name="mdp" id="mdp" required /><br />
        <input type="checkbox" name="cookie" id="cookie"/> <label for="cookie">Connexion automatique</label><br/>
		<input type="submit" value="Connexion" />
	</form>
	
	<h1>Options</h1>
	<p><a href="inscription.php">Je ne suis pas inscrit !</a><br/>
	<a href="moncompte.php?action=reset">J'ai oublié mon mot de passe !</a>
	</p>
</div>