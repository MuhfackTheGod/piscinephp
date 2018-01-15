<?PHP 
require_once "func.php";

if ($_SESSION['user'] != '')
	header("Location: index.php");
if($_POST['submit'] == "OK") {
	if (createuser($_POST['login'], $_POST['password']))
		header("Location: sign_in.php");
	else
		echo "<pre style='color:red'>", "Erreur de creation de compte", "</pre>";
}
?>
<?= navbar();?>
<section>
	<h1>Sign Up</h1>
	<form action="" method="post">
	Identifiant: <input type="text" name="login"><br/>
	Mot de passe: <input type="password" name="password"><br/>
	<input type="submit" name="submit" value="OK">
	</form>	
</section>