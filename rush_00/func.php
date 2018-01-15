<?php
session_start();

function makedb($dbname) {
	if (!file_exists('db'))
		mkdir ("db");
	if (!file_exists('db/'.$dbname))
		touch ("db/".$dbname);
}
function require_connexion() {
	if ($_SESSION['user'] == '') {
		header("Location: index.php");
		die();
	}
}
function initproductdb() {
	$products = array();
	$categorie = array('mug_froisse','mug_droit','mug_droit','mug_froisse','mug_froisse','tasse_cafe','tasse_cafe','tasse_cafe');
	$description = array('mug_froisse_noir_parfait','mug_droit_argent','mug_droit_rouge','mug_froisse_noir_defaut','mug_froisse_vert_formes','tasse_cafe_marron_coffee','tasse_cafe_noir_coffee','tasse_cafe_creme_coffee');
	$prix = array(3.0, 3.0, 3.5, 3.5, 3.5, 4.0, 4.0, 4.0);
	$stock = array(8,5,2,3,0,8,2,6);
	$photo = array('img/mug_froisse_noir_parfait.jpg','img/mug_droit_argent.jpg','img/mug_droit_rouge.jpg','img/mug_froisse_noir_defaut.jpg','img/mug_froisse_vert_formes.jpg','img/tasse_cafe_marron_coffee.jpg','img/tasse_cafe_noir_coffee.jpg','img/tasse_cafe_creme_coffee.jpg');
	for ($i=1; $i < 33; $i++) { 
		array_push($products, array('id'=>$i,'nom_produit'=>'tasse_'.$i,'categorie'=>$categorie[$i % 8],'description'=>$description[$i % 8],'prix'=>$prix[$i % 8],'stock'=>$stock[$i % 8],'photo'=>$photo[$i % 8]));
	}
	file_put_contents('db/products_db', serialize($products), LOCK_EX);
}
function getproduct($id)
{
	makedb('products_db');

	if (unserialize(file_get_contents('db/products_db')) === false)
		file_put_contents('db/products_db', serialize(array()), LOCK_EX);
	$accnt_array = unserialize(file_get_contents('db/products_db'));
	$found = 0;
	foreach ($accnt_array as $key => $val)
	{
		if ($val['id'] === $id)
			return $accnt_array[$key];
	}
	return false;
}
function getcartprice($cart)
{
	$price = 0;
	foreach ($cart as $id) {
		$product = getproduct($id);
		$price += $product['prix'];
	}
	return $price;
}
function savecommande($cart) {
	makedb('carts_db');
	if (unserialize(file_get_contents('db/carts_db')) === false)
		file_put_contents('db/carts_db', serialize(array()), LOCK_EX);
	$accnt_array = unserialize(file_get_contents('db/carts_db'));
	$commande = array();
	foreach ($cart as $id) {
		$product = getproduct($id);
		array_push($commande, $product);
	}
	$accnt_array[] = $commande;
	file_put_contents('db/carts_db', serialize($accnt_array), LOCK_EX);
}
function createuser($login, $passwd, $admin = false) {
	if ($login == '' && $passwd == '')
		return false;
	makedb('users_db');
	if (unserialize(file_get_contents('db/users_db')) === false)
		file_put_contents('db/users_db', serialize(array()), LOCK_EX);
	$accnt_array = unserialize(file_get_contents('db/users_db'));
	$found = 0;
	foreach ($accnt_array as $val)
	{
		if ($val['login'] === $login)
			$found = 1;
	}
	if (!$found)
	{
		$array['login'] = $login;
		$array['password'] = hash('sha3-512', $passwd);
		$array['admin'] = $admin;
		$array['zipcode'] = "";
		$array['state'] = "";
		$accnt_array[] = $array;
		file_put_contents('db/users_db', serialize($accnt_array), LOCK_EX);
		return true;
	}
	return false;
}
function connectuser($login, $passwd) {
	if ($login == '' && $passwd == '')
		return false;
	makedb('users_db');
	if (unserialize(file_get_contents('db/users_db')) === false)
		file_put_contents('db/users_db', serialize(array()), LOCK_EX);
	$accnt_array = unserialize(file_get_contents('db/users_db'));
	foreach ($accnt_array as $key => $val) {
		if ($val['login'] === $login && $val['password'] === hash('sha3-512', $passwd))
			return array('login'=>$login, 'zipcode'=>$val['zipcode'], 'state'=>$val['state']);
	}
	return false;
}
function modifyuser($zipcode, $state, $passwd) {
	if ($zipcode == '' && $state == '' && connectuser($_SESSION['user']['login'], $passwd) === false)
		return false;
	makedb('users_db');
	if (unserialize(file_get_contents('db/users_db')) === false)
		file_put_contents('db/users_db', serialize(array()), LOCK_EX);
	$accnt_array = unserialize(file_get_contents('db/users_db'));
	$found = 0;
	foreach ($accnt_array as $key => $val) {
		if ($val['login'] === $_SESSION['user']['login']) {
			$found = 1;
			$accnt_array[$key]['zipcode'] = "";
			$accnt_array[$key]['state'] = "";
			break;
		}
	}
	if ($found) {
		$array['zipcode'] = $zipcode;
		$array['state'] = $state;
		file_put_contents('db/users_db', serialize($accnt_array), LOCK_EX);
		return $array;
	}
	return false;
}
function deleteuser($login, $passwd) {
	if (connectuser($login, $passwd) === false)
		return false;
	makedb('users_db');
	if (unserialize(file_get_contents('db/users_db')) === false)
		file_put_contents('db/users_db', serialize(array()), LOCK_EX);
	$accnt_array = unserialize(file_get_contents('db/users_db'));
	foreach ($accnt_array as $key => $val) {
		if ($val['login'] === $login) {
			array_splice($accnt_array, $key, 1);
			return true;
		}
	}
	return false;
}

function navbar() {
	$navbar = '<link rel="stylesheet" href="style.css"><nav style="padding: 10px 25px; height: 18px; border: 1px black solid;"><div style="float: left;"><a href="index.php">Accueil</a></div><div style="float: right;">';
	if (!empty($_SESSION['panier']))
		$navbar .= '<a style="padding: 0 1em;"href="panier.php">Panier ( '.count($_SESSION['panier']).' | '.getcartprice($_SESSION['panier']).' $ )</a>';
	if ($_SESSION['user']) {
		$navbar .= '<a style="padding: 0 1em;" href="account.php">Account</a><a style="padding: 0 1em;"href="logout.php">Logout</a>';
	} else {
		$navbar .= '<a style="padding: 0 1em;"href="sign_in.php">Sign In</a><a style="padding: 0 1em;"href="sign_up.php">Sign Up</a>';
	}
	$navbar .= '</div></nav>';
	return $navbar;
}
