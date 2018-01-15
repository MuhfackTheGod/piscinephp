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
	asort($ret);
	return ($ret);
}
function ft_ssap($av)
{
	$ret = " ";
	foreach ($av as $val)
	{
		if ($val != $av[0])
			$ret = $ret." ".$val;	
	}
	return ($ret);
}

if ($argc > 1)
	echo implode("\n" , ft_split(ft_ssap($argv)))."\n";
?>