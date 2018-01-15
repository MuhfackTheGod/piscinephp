#!/usr/bin/php
<?PHP
function ft_split($input)
{
	$arr = explode(" ", $input);
	foreach ($arr as $key => $value)
	{
		if ($value == '')
		unset($arr[$key]);
	}
	return $arr;
}

function test($a, $b)
{
	$count = 0;
	$tmp = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r",
 		   		 "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
				 "!", "\"", "#", "$", "%", "&", "'", "(", ")", "*", "+", ",", "-", ".", "/", ":", ";", "<",
				 "=", ">", "?", "@", "[", "\\", "]", "^", "_", "`", "{", "|", "}", "~");
	while ($a[$count] && $b[$count])
	{
		if (ctype_upper($a[$count]) == TRUE)
		{
			$v1 = array_search(strtolower($a[$count]), $tmp);
			$v2 = array_search(strtolower($b[$count]), $tmp);
		}
		else
		{
			$v1 = array_search($a[$count], $tmp);
			$v2 = array_search($b[$count], $tmp);
		}
		if ($v1 > $v2)
		   return 1;
		if ($v1 < $v2)
		   return -1;
		$count++;
	}
	return 0;
}

$final = array();
unset($argv[0]);
foreach($argv as $str)
{
	$tmp = ft_split($str);
	$final = array_merge($final, $tmp);
}
usort($final, test);
if ($argc > 1) 
	echo implode("\n" ,$final)."\n";
?>