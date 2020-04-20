<?php
include("classes.php");
function gallery($galleryObject, $galleryId)
{
	$uniqueGalleryName = "g" . $galleryId;
	
	echo '<table cellpadding="0" cellspacing="0" class="tmmt">
	<tr><td class="titleSmall tmh2">'
	. $galleryObject->get_name() .
	'</td></tr>		
	<tr><td>
					
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr><td width="11" height="1"></td><td width="498" ></td><td width="11" height="1"></td></tr>
	<tr><td class="nwBlue"></td><td class="nB"></td><td class="neBlue"></td></tr>
	<tr><td class="wB" ></td><td align="center" height="360" class="mB">
					
		<table width="498" cellpadding="0" cellspacing="0">
		<tr>
		<td valign="bottom" align="right"><img alt="" onmouseover="javascript:this.src=\'res/gallery_left2.png\'" onmouseout="javascript:this.src=\'res/gallery_left.png\'" style="cursor:pointer" src="res/gallery_left.png" onclick="slideRow(\'' .$uniqueGalleryName. '\')" /></td>
		<td align="left"><div style="width:100%;overflow:hidden;">';
							
		$src_array = $galleryObject->get_el();
		
		// big image
		echo '<div align="left" style="position:relative;overflow:hidden;width:100%;height:270px">';
		$counter = 0;
		foreach($src_array as $src)
		{		
			$size = getimagesize($src);
			$whRatio = $size[0] / $size[1];
			
			// big images, one behind another
			echo '<div align="center" class="gid" id="divimg' . $uniqueGalleryName . $counter . '" >';
			$thumb_src = dirname($src) . "/thumb_" . basename($src);
			
			if(file_exists($thumb_src) == false)
				$thumb_src = dirname($src) ."/". basename($src);

			$thumb_src_array[] = $thumb_src;
			echo '<img alt="" class="gi" id="img' . $uniqueGalleryName . $counter . '" src="' . $thumb_src;
			
			$html = addslashes("<img alt='' width='") . $size[0] . addslashes("' height='") . $size[1]. addslashes("' src='") . addslashes($src) . addslashes("' style='cursor:pointer;' onclick='closeImage()'>");
			
			echo '" onclick="openImage(\'' .$html. '\','.$size[0].','.$size[1].');" />
			</div>';
			
			$counter++;
		}
		echo '</div>';
		
		$count = count($src_array);

	echo '<div style="position:relative;overflow:hidden;height:110px;width:453px" id="div'.$uniqueGalleryName.'">
	<div style="position:absolute">
		
		<div align="left" id="'.$uniqueGalleryName.'" style="background-color:white;overflow:hidden;position:relative;width:' . (($count * 160) + 10) . 'px;height:110px">
		<div style="position:absolute">';
		
		// filmstrip
		$counter = 0;
		foreach($src_array as $src)
		{
			echo '<img alt="" class="fsi" id="' . "imgSmall" . $uniqueGalleryName . $counter . '" onmouseout="small_down(\'imgSmall' . $uniqueGalleryName . $counter . '\')" onmouseover="enlarge(\'imgSmall' . $uniqueGalleryName . $counter . '\')" onclick="javascript:showImg(\''.$uniqueGalleryName.'\',\'img' . $uniqueGalleryName . $counter . '\'); return false;" width="140" height="100" style="margin-left:5px;margin-right:5px" src="' . $thumb_src_array[$counter] . '" />';
							
			$counter++;
		}
		echo '</div></div>
		</div></div>

		</td>
		<td valign="bottom" align="left"><img alt="" onmouseover="javascript:this.src=\'res/gallery_right2.png\'" onmouseout="javascript:this.src=\'res/gallery_right.png\'" style="cursor:pointer" src="res/gallery_right.png" onclick="slideBackRow(\''.$uniqueGalleryName.'\')" /></td></tr>
		</table>
						
		</td><td class="eB"></td></tr>
		
		<tr><td class="swBlue"></td><td class="sB"></td><td class="seBlue"></td></tr>
		</table>
		</td></tr>							
		</table><br/>';
				
	return 	'setInitialPosition("'.$uniqueGalleryName.'",' . $count . ');visibleImgId[\''.$uniqueGalleryName.'\']="img' . $uniqueGalleryName. '0"; document.getElementById("div" + visibleImgId[\''.$uniqueGalleryName.'\']).style.display = \'block\';';
}
?>
