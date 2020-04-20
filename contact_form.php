<form action="" name="formContact">								
<table width="100%" cellspacing="0" cellpadding="0">
<tr><td width="11" height="0"></td><td width="498" ></td><td width="11" height="0"></td></tr>
<tr><td height="11" class="nwBlue"></td><td class="nB"></td><td class="neBlue"></td></tr>
<tr><td class="wB"></td><td class="mB">
<table width="498px" cellpadding="0" cellspacing="0">
<tr><td colspan="2"><span id="cfNotify" style="display:none; height:15px; line-height:15px"><?php echo $cfSent ?></span></td></tr>	  
<tr><td colspan="2"><img src="res/pixel.gif" style="height:5px;width:100px" /></td></tr>	                          
<tr valign="top">
<td class="text" style="text-align:right;height:30px;"><?php echo $cfName; ?> </td>
<td style="text-align:center">
    <input class="inpc" maxlength="20" name="inpAuthor" id="inpAuthor" type="text">
    <div id="errorName" style="display:block;" class="error"><img alt="" src="res/pixel.gif" height="1" width="12" /></div>
</td>
</tr>
<tr valign="top">
<td class="text" style="text-align:right;height:30px;"><?php echo $cfEmail; ?> </td>
<td style="text-align:center">
    <input class="inpc" maxlength="50" name="inpMail" id="inpMail" type="text">
    <div id="errorMail" style="display:block;" class="error"><img alt="" src="res/pixel.gif" height="1" width="12" /></div>
</td>
</tr>							
<tr valign="top">
<td class="text" style="text-align:right"><?php echo $cfMessage; ?> </td>
<td style="text-align:center">
    <textarea class="inpc" style="height:110px" rows="0" cols="0" onkeyup="countChars(event)" name="inpComment" id="inpComment"></textarea>
    <div id="errorComment" style="display:block;" class="error"></div>
    <div id="divCount" class="text" style="margin-top:5px">700 <?php echo $availableCharMsg; ?></div>
</td>
</tr>
<tr>
<td colspan="2" style="height:40px"><button class="submit" type="button" onclick="if(checkContactForm()){showHideLoader(true);sendAjaxContactForm();}else{notify(alString,noDataText);}" value="Pošalji"><?php echo $gSend; ?></button></td>
</tr>
</table>
</td><td class="eB"></td></tr>
<tr><td class="swBlue"></td><td class="sB"></td><td class="seBlue"></td></tr>
</table>
</form>