
<form action="" name="formComments">
<!-- existing comments -->
<div id="displayComments"><?php include("get_comments.php"); ?></div>
<!-- new comment -->
<table width="100%" cellspacing="0" cellpadding="0">
<tr><td width="11" height="0"></td><td width="498" ></td><td width="11" height="0"></td></tr>
<tr><td colspan="3">
<table style="margin-left:10px" cellpadding="0" cellspacing="0">
    <tr><td class="gchl"></td><td class="text gchm"><?php echo $signhere; ?></td><td class="gchr"></td></tr>
</table>
</td></tr>
<tr><td height="11" class="nwBlue"></td><td class="nB"></td><td class="neBlue"></td></tr>
<tr><td class="wB"></td><td class="mB">
<table width="100%">
<tr><td colspan="2"><img src="res/pixel.gif" style="height:5px;width:100px" /></td></tr>
<tr valign="top">
<td class="text" style="text-align:right"><?php echo $gName; ?> </td>
<td style="text-align:center">
    <input class="inpc" width="" maxlength="20" name="inpAuthor" id="inpAuthor" type="text">
    <div id="errorName" style="display:block;" class="error"><img alt="" src="res/pixel.gif" height="1" width="12" /></div>
    <div style="padding:3px">
        <img style="cursor:pointer" alt="" src="res/emoticons/smile1.gif" onclick="insert_emoticon('inpComment',':)')" />
        <img style="cursor:pointer" alt="" src="res/emoticons/mrgreen1.gif" onclick="insert_emoticon('inpComment',':D')" />
        <img style="cursor:pointer" alt="" src="res/emoticons/confused2.gif" onclick="insert_emoticon('inpComment',':|')" />
        <img style="cursor:pointer" alt="" src="res/emoticons/sad2.gif" onclick="insert_emoticon('inpComment',':(')" />
        <img style="cursor:pointer" alt="" src="res/emoticons/mooo.gif" onclick="insert_emoticon('inpComment','[muu]')" />
        <img style="cursor:pointer" alt="" src="res/emoticons/tongue1.gif" onclick="insert_emoticon('inpComment','[:P]')" />
    </div>
</td>
</tr>
<tr valign="top">
<td class="text" style="text-align:right"><?php echo $gComment; ?> </td>
<td style="text-align:center">
    <textarea class="inpc" style="height:110px" rows="0" cols="0" onkeyup="countChars(event)" name="inpComment" id="inpComment"></textarea>
    <div id="errorComment" style="display:block;" class="error"></div>
    <div id="divCount" class="text" style="margin-top:5px">700 <?php echo $availableCharMsg; ?></div>
</td>
</tr>
<tr>
<td colspan="2" style="height:40px">
    <button class="submit" type="button" onclick="if(checkComment()){sendAjaxComment();}else{notify(alString,noDataText);}" value="Pošalji"><?php echo $gSend; ?></button>
</td>
</tr>
</table>
</td><td class="eB"></td></tr>
<tr><td class="swBlue"></td><td class="sB"></td><td class="seBlue"></td></tr>
</table>
</form>