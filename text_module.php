<?php

function outputTextModules($textModulesResult)
{
  while($row = $textModulesResult->fetch_array())
  {
	$name = $row["part_id"].$row["text_module_id"];	
	echo '<table cellpadding="0" cellspacing="0">
	  <tr><td class="tmh"><div class="tht">' . $row["title"] .
	 '</div><img alt="" id=img'.$name.' onclick="showHideDiv(\''.$name.'\')" class="tb" src="res/min.gif" />
	  </td></tr><tr><td>	
	  <div class="tmc" id="div'.$name.'">
	  <table width="100%" cellspacing="0" cellpadding="0">
	  <tr><td class="nwBlue"></td><td class="nB"></td><td class="neBlue"></td></tr>
	  <tr><td class="wB"></td><td class="mB">'
	 . $row["text"] .
	 '</td><td class="eB"></td></tr>
	 <tr><td class="swBlue"></td><td class="sB"></td><td class="seBlue"></td></tr>
	 </table>
	 </div>
	 </td></tr></table><br />';
   }
}

?>