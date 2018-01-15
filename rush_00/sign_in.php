<?PHP 
require_once "func.php";

if ($_SESSION['user'] != '')
	header("Location: index.php");
if($_POST['submit'] == "OK") {
	if ($user = connectuser($_POST['login'], $_POST['password'])) {
		$_SESSION['user']['login'] = $user['login'];
		$_SESSION['user']['zipcode'] = $user['zipcode'];
		$_SESSION['user']['state'] = $user['state'];
		header("Location: index.php");
	} else
		echo "<pre style='color:red'>", "Erreur de connection de compte", "</pre>";
}
?>
<?= navbar();?>
<section>
	<h1>Sign In</h1>
	<form action="" method="post">
	Identifiant: <input type="text" name="login"><br/>
	Mot de passe: <input type="password" name="password"><br/>
	<input type="submit" name="submit" value="OK">
	</form>
</section>