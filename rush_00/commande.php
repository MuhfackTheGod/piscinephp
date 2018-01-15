<?PHP
require_once "func.php";

require_connexion();
if (empty($_SESSION['panier']))
	header("Location: index.php");
savecommande($_SESSION['panier']);
?>
<HTML>
<HEAD>
	<META charset="UTF-8" />
</HEAD>

<BODY>
	<?= navbar();?>
	<section>
		<h1>Recapitulatif de la commande ( <?= getcartprice($_SESSION['panier'])?> $ )</h1>
		<ul class="grid">
<?php foreach ($_SESSION['panier'] as $id):?>
			<li class="small">
				<a style="text-decoration: none;" href="index.php?product=<?= $id?>">
<?php $product = getproduct($id);?>
					<img src='<?= $product["photo"]?>' alt='<?= $product["nom_produit"]?>'>
					<h3><?= $product["nom_produit"]?> : <?= $product["prix"]?> $</h3>
					<br><br>
				</a>
			</li>
<?php endforeach;?>
		</ul>
	</section>
</BODY>
</HTML>
<?php
$_SESSION['panier'] = '';