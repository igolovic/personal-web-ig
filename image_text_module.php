<?php

function outputImageTextModules($imageTextModuleResult, $imageTextModuleSubmodules)
{
	$counter = 0;
	$conn = new connect();
	$rownum = $imageTextModuleResult->num_rows;
	$imageTextModuleResult->data_seek(0);

	while($row = $imageTextModuleResult->fetch_array())
	{
		$name = $row["part_id"].$row["image_text_module_id"];
		echo '<table width="100%" cellpadding="0" cellspacing="0">
		<tr><td width="11" height="0"></td><td width="498" ></td><td width="11" height="0"></td></tr>
		
		<tr><td colspan="3" class="tmh"><div style="height:33px; float:left; line-height:33px;">'
		. $row["title"] .
		'</div><img alt="" id=img'.$name.' onclick="showHideDiv(\''.$name.'\')" class="tb" src="res/min.gif" />
		</td></tr>		
	
		<tr><td colspan="3">
		<div class="tmc" id="div'.$name.'">
		<table cellpadding="0" cellspacing="0">
		<tr><td width="11" height="0"></td><td width="498"></td><td width="11" height="0"></td></tr>
		<tr><td class="nwBlue"></td><td class="nB"></td><td class="neBlue"></td></tr><tr><td class="wB"></td><td class="mB">';
											
		// content
		echo '<table><tr><td class="itmc" align="center">';
		if($row["is_image"] == true)
		{
			$size = getimagesize($row["image_path"]);
			$whRatio = $size[0] / $size[1];
		
			$bigImage = addslashes("<img alt='' width='") . $size[0] . addslashes("' height='") . $size[1]. addslashes("' src='") . addslashes($row["image_path"]) . addslashes("' style='cursor:pointer;' onclick='closeImage()'>");		

			echo '<img alt="" style="cursor:pointer" onclick="openImage(\'' . $bigImage . '\','.$size[0].','.$size[1].');" alt="" ';
			
			$src = dirname($row["image_path"]) . '/thumb_' . basename($row["image_path"]);
			if(file_exists($src) == false)
			{
				echo 'width="220" ';
				$src = dirname($row["image_path"]) . '/' . basename($row["image_path"]);
			}
			echo 'src="' . $src . '" />';
		}
		else
		{
			echo $row["image_path"];
		}
		echo '</td><td class="text itmc" valign="top">'
		. $row["text"] .
		'</td></tr>';
	
		$leftCount = $imageTextModuleSubmodules[$counter][0]->num_rows;
		$rightCount = $imageTextModuleSubmodules[$counter][1]->num_rows;
		
		$rownum = $leftCount > $rightCount ? $leftCount : $rightCount;
		
		$counter2 = 0;
		while($counter2 < $rownum)
		{
			$left  = $imageTextModuleSubmodules[$counter][0]->fetch_array();
			$right = $imageTextModuleSubmodules[$counter][1]->fetch_array();
						
			echo '<tr><td class="itsb">';
			
			if(isset($left["title"]))
			{
			echo '<table style="width:90%" cellpadding="0" cellspacing="0"><tr><td class="itsh">'
				. $left["title"] .
				'</td></tr><tr><td class="itst">'
				. $left["text"] .
				'</td></tr></table>';
			}
			
			echo '</td><td class="itsb">';
	
			if($right["title"])
			{
				echo '<table style="width:90%" cellpadding="0" cellspacing="0"><tr><td class="itsh">'
				. $right["title"] .
				'</td></tr><tr><td class="itst">'
				. $right["text"] .
				'</td></tr></table>';
			}
			echo '</td></tr>';
			$counter2++;
		}
		echo '</table>
		</td><td class="eB"></td></tr><tr><td class="swBlue"></td><td class="sB"></td><td class="seBlue">
		</td></tr>
		</table></div>
		</tr></td>
		</table><br />';
	
		$counter++;
	}
}

?>