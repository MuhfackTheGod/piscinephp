<?php 
require_once "func.php";

require_connexion();
if($_POST['submit'] == "OK") {
	if ($user = modifyuser($_POST['zipcode'], $_POST['state'], $_POST['password'])) {
		$_SESSION['user']['zipcode'] = $user['zipcode'];
		$_SESSION['user']['state'] = $user['state'];
		header("Location: account.php");
	} else
		echo "<pre style='color:red'>", "Erreur Mot de passe incorrect", "</pre>";
}
?>
<?= navbar();?>
<h1>Modify account<h1>
<form action="" method="post">
Code postal: <input type="text" name="zipcode"> <br /><br />
Pays: <input type="text" name="state"> <br /><br />
Confirmer mot de passe: <input type="password" name="password"> <br /><br />
<input type="submit" name="submit" value="OK">
</form>