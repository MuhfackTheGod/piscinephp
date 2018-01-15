#!/usr/bin/php
<?PHP
function ft_split($str)
{
	$ret = explode(" ", "$str");
	foreach ($ret as $key => $value)
	{
		if($value == '')
			unset($ret[$key]);
	}
	return ($ret);
}
function rostring($tab)
{
	$tmp = $tab[0];
	unset($tab[0]);
	$tab[] = $tmp;
	return ($tab);
}
if ($argc > 1)
	echo implode(" " , rostring(ft_split($argv[1])))."\n";
?>