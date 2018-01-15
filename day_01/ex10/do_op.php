#!/usr/bin/php
<?PHP
if($argc != 4)
{
	echo "Incorrect Parameters\n";
	exit(0);
}
$a = trim($argv[1]);
$op = trim($argv[2]);
$b = trim($argv[3]);
if($op == '+')
	echo($a + $b)."\n";
if($op == '*')
	echo($a * $b)."\n";
if($op == '/')
	echo ($a / $b)."\n";
if($op == '%')
	echo($a % $b)."\n";
if($op == '-')
	echo($a - $b)."\n";
?>