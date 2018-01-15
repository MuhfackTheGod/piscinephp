#!/usr/bin/php
<?PHP
while (TRUE)
{
	echo "Entrez un nombre: ";
	$entree = fgets(STDIN);
	if (empty($entree))
	{
		echo "\n";
		exit();
	}
	$entree = trim($entree, "\n");
	if (is_numeric($entree) == FALSE)
		echo "'$entree' n'est pas un chiffre\n";
	elseif ($entree % 2) {
		echo "Le chiffre $entree est Impair\n";
	}
	else
		echo "Le chiffre $entree est Pair\n";
}	
?>