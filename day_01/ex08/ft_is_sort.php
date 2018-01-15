#!/usr/bin/php
<?PHP
function ft_is_sort($tab)
{
	foreach ($tab as $key => $val) 
	{
		if($key != 0)
		{
			if($tab[$key - 1] > $tab[$key])
				return(FALSE);
		}
	}
	return (TRUE);
}
?>