<?PHP
require_once "func.php";

if ($_GET['product'] && $_GET['add'] && $_GET['add'] == 1)
{
	if (empty($_SESSION['panier']))
		$_SESSION['panier'] = array();
	array_push($_SESSION['panier'], getproduct(intval($_GET['product']))['id']);
	header("Location: index.php?product=".$_GET['product']);
}
?>
<HTML>
<HEAD>
	<META charset="UTF-8" />
</HEAD>

<BODY>
	<?= navbar();?>
	<section>
		<h1>ACCUEIL</h1>
		<ul class="grid">
<?php if($_GET['product']):?>
			<li class="small">
<?php $product = getproduct(intval($_GET['product']));?>
				<img src='<?= $product["photo"]?>' alt='<?= $product["nom_produit"]?>'>
				<h3><?= $product["nom_produit"]?> - <?= $product["prix"]?> $</h3>
				<p style="color: #da007f;">Description : <?= $product["description"]?></p>
				<br><br>
				<a href="?product=<?= $_GET['product']?>&add=1">Ajouter au panier</a>
			</li>
<?php else:?>
		
<?php for ($i=1; $i < 33; $i++):?>
			<li class="small">
				<a style="text-decoration: none;" href="?product=<?= $i?>">
<?php $product = getproduct($i);?>
					<img src='<?= $product["photo"]?>' alt='<?= $product["nom_produit"]?>'>
					<h3><?= $product["nom_produit"]?> : <?= $product["prix"]?> $</h3>
					<br><br>
				</a>
			</li>
<?php endfor;?>
<?php endif;?>
		</ul>
	</section>
</BODY>
</HTML>