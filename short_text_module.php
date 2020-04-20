<?php

function outputShortTextModules($leftShortTextModulesResult, $rightShortTextModulesResult)
{
	$left = is_object($leftShortTextModulesResult) ? $leftShortTextModulesResult->num_rows : 0;
	$right = is_object($leftShortTextModulesResult) ? $rightShortTextModulesResult->num_rows : 0;
	$rownum = $left > $right ? $left : $right;
	$counter = 0;
	echo '<table width="100%" align="center" cellpadding="0" cellspacing="0">';
	while($counter < $rownum)
	{		
		$counter++;
		$rowR = $rightShortTextModulesResult->fetch_array();
		$rowL = $leftShortTextModulesResult->fetch_array();
	
		echo '<tr valign="top" align="center"><td>';	
		if(isset($rowL["position"]))
		{
			echo "<table width=\"260\" cellpadding=\"0\" cellspacing=\"0\">
			 <tr>
			 <td align='center' class=\"titleSmall stmh\">"
			 . $rowL["title"] . 
			 "</td></tr><tr>
			 <td class=\"text stmt\"style=\"padding:5px 15px 5px 15px;\">"
			 . $rowL["text"] .
			 "</td></tr><tr>
			 <td class=\"stmb\"></td></tr></table><br />";
		}
		else
		{
			echo "<img alt='' src=\"res/pixel.gif\" height=\"1\" width=\"320\" />";
		}
		echo "</td><td>";
		if(isset($rowR["position"]))
		{
			echo "<table width=\"260\" cellpadding=\"0\" cellspacing=\"0\">
			<tr>
			<td align='center' class=\"titleSmall stmh\">"
			. $rowR["title"] .
			"</td></tr><tr>
			<td class=\"text stmt\" style=\"padding:5px 15px 5px 15px;\">"
			. $rowR["text"] .
			"</td></tr><tr>
			<td class=\"stmb\"></td></tr></table><br />";
		}
		else
		{
			echo "<img alt='' src=\"res/pixel.gif\" height=\"1\" width=\"320\" />";
		}
		echo "</td></tr>";
	}									
	echo "</table><img alt='' id='divAdm' src='res/adm.gif' style='position:absolute;top:500px;left:500px;display:none;z-index:55' />";
	}

?>