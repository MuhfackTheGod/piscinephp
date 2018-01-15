<?PHP
require_once "func.php";

if (!file_exists('db'))
	mkdir ("db");
if (!file_exists('db/users_db'))
	touch ("db/users_db");
initproductdb();
?>
<HTML>
<HEAD>
	<META charset="UTF-8" />
</HEAD>
	<BODY>
		<h1>Site installé<h1>
		<tr><td><a href="index.php">Cliquez ici</a></td></tr>
	</BODY>
</HTML>
<?PHP
	if (file_exists("db/users_db"))
		createuser("admin", "admin", true)
?>
