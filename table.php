<?php

function outputTable($tableModulesResult, $tableSubmodulesResult)
{
	$tableModulesResult->data_seek(0);
	$counter = 0;
	
	while($row = $tableModulesResult->fetch_array())
	{
		$name = "cv" . $row["cv_part_id"];
		echo '<table width="100%" cellpadding="0" cellspacing="0">
		<tr><td class="tmh"><div style="height:33px; float:left; line-height:33px;">'
		. $row["title"] .
		'</div><img alt="" id=img'.$name.' onclick="showHideDiv(\''.$name.'\')" class="tb" src="res/min.gif" />
		</td></tr>		
		
		<tr><td>
		
		<div style="display:block;overflow:hidden" id="div'.$name.'">
		<table width="100%" cellspacing="0" cellpadding="0">
		<tr><td width="11"></td><td width="498" ></td><td width="11"></td></tr>
		<tr><td class="nwBlue"></td><td class="nB"></td><td class="neBlue"></td></tr>
		
		<tr style="background-color:#a3eafa"><td class="wB"></td><td class="mB">
	
		<table width="100%" cellpadding="0" cellspacing="0">';
			
		while($row2 = $tableSubmodulesResult[$counter]->fetch_array())
		{
			echo '<tr><td class="text tbr">'
			. $row2["title"] .
			'</td><td class="text2 tbr2">'
			. $row2["text"] .
			'</td></tr><tr style="height:5px"><td colspan="2"></td></tr>';
		}
			
		echo '</table>
		</td><td class="eB"></td></tr>
		<tr><td class="swBlue"></td><td class="sB"></td><td class="seBlue"></td></tr>
		</table>
		</div>
		</td></tr>
		</table><br/>';
		$counter++;
	}
}

?>