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
if ($argc > 1)
	echo implode(" " , ft_split($argv[1]))."\n";
?>