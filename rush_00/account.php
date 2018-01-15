<?php 
require_once "func.php";

require_connexion();
?>
<?= navbar();?>
<section>
	<h4>Nom d'utilisateur : <?=$_SESSION['user']['login']?></h4><br>
	<h4>Code postale : <?=$_SESSION['user']['zipcode']?></h4><br>
	<h4>Pays : <?=$_SESSION['user']['state']?></h4><br>
	<a href="modifyaccount.php">Modifier mes informations</a>
</section>