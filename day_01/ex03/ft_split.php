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
	asort($ret, SORT_FLAG_CASE | SORT_STRING);
	return ($ret);
}
?>