<?php
require_once "func.php";
if (empty($_SESSION['panier']))
	header("Location: index.php");
$price = 0;
foreach ($_SESSION['panier'] as $id) {
	$product = getproduct($id);
	$price += $product['prix'];
}
if ($_GET['product'] && $_GET['remove'] && $_GET['remove'] == 1)
{
	foreach ($_SESSION['panier'] as $key => $id) {
		if ($id === intval($_GET['product'])) {
			array_splice($_SESSION['panier'], $key, 1);
			break;
		}
	}
	header("Location: panier.php");
}
?>
<HTML>
<HEAD>
	<META charset="UTF-8" />
</HEAD>

<BODY>
	<?= navbar();?>
	<section>
		<h1>Panier</h1>
		<ul class="grid">
<?php foreach ($_SESSION['panier'] as $id):?>
			<li class="small">
				<a style="text-decoration: none;" href="index.php?product=<?= $id?>">
<?php $product = getproduct($id);?>
					<img src='<?= $product["photo"]?>' alt='<?= $product["nom_produit"]?>'>
					<h3><?= $product["nom_produit"]?> : <?= $product["prix"]?> $</h3>
					<a style="text-decoration: none;" href="?product=<?= $id?>&remove=1">Supprimer l'article</a>
					<br><br>
				</a>
			</li>
<?php endforeach;?>
		</ul><br><br>
<?php if ($_SESSION['user'] == ''):?>
		<a style="padding: 25px 10px; background-color: #df5050" href="sign_in.php">Identifiez vous avant de valider votre panier</a>
<?php else:?>
		<a style="padding: 25px 10px; background-color: #c4e6a3" href="commande.php">Valider ma commande</a>
<?php endif;?>
	</section>
</BODY>
</HTML>