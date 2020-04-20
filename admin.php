<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unos dnevnog jelovnika</title>
</head>
<body style="text-align:center">

<?php

	$header = "";
	$leftColumn = "";
	$rightColumn = "";
	$footer = "";
	$content = "";
	
	$fileNames = array("editedHeader.htm", "editedLeftColumn.htm", "editedRightColumn.htm", "editedFooter.htm", "editedContent.htm");
	
	foreach($fileNames as $fileName)
	{
		if(!file_exists($fileName))
		{
			$fileHandle = fopen($fileName, "w");
			fclose($fileHandle);
		}		
	}

	if(isset($_POST["editedHeader"]))
	{
		$header = stripslashes($_POST["editedHeader"]);
		$fileHandle = fopen("editedHeader.htm", "w");
		fwrite($fileHandle, $header);
		fclose($fileHandle);
	}
	
	if(isset($_POST["editedLeftColumn"]))
	{
		$leftColumn = stripslashes($_POST["editedLeftColumn"]);
		$fileHandle = fopen("editedLeftColumn.htm", "w");
		fwrite($fileHandle, $leftColumn);
		fclose($fileHandle);
	}
	
	if(isset($_POST["editedRightColumn"]))
	{
		$rightColumn = stripslashes($_POST["editedRightColumn"]);
		$fileHandle = fopen("editedRightColumn.htm", "w");
		fwrite($fileHandle, $rightColumn);
		fclose($fileHandle);	
	}
	
	if(isset($_POST["editedFooter"]))
	{
		$footer = stripslashes($_POST["editedFooter"]);
		$fileHandle = fopen("editedFooter.htm", "w");
		fwrite($fileHandle, $footer);
		fclose($fileHandle);
	}
	
	if(isset($_POST["editedContent"]))
	{
		$content = stripslashes($_POST["editedContent"]);
		$fileHandle = fopen("editedContent.htm", "w");
		fwrite($fileHandle, $content);
		fclose($fileHandle);
	}
		
	$header = file_get_contents("editedHeader.htm");
	$leftColumn = file_get_contents("editedLeftColumn.htm");
	$rightColumn = file_get_contents("editedRightColumn.htm");
	$footer = file_get_contents("editedFooter.htm");
	$content = file_get_contents("editedContent.htm");

?>

<form name="main" id="main" method="post" action="admin.php">

<style type="text/css">
	td{ font-family:Arial, Helvetica, sans-serif; font-size:14px; vertical-align:top}
</style>

<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
function previewDailyMenu()
{
	document.getElementById("header").innerHTML = document.getElementById("leftColumn").innerHTML = document.getElementById("rightColumn").innerHTML = document.getElementById("footer").innerHTML = "";

	document.getElementById("editedHeader").value = document.getElementById("header").innerHTML = tinyMCE.get('textareaHeader').getContent();
	document.getElementById("editedLeftColumn").value = document.getElementById("leftColumn").innerHTML = tinyMCE.get('textareaLeftColumn').getContent();
	document.getElementById("editedRightColumn").value = document.getElementById("rightColumn").innerHTML = tinyMCE.get('textareaRightColumn').getContent();
	document.getElementById("editedFooter").value = document.getElementById("footer").innerHTML = tinyMCE.get('textareaFooter').getContent();
	document.getElementById("editedContent").value = document.getElementById("contentContainer").innerHTML;
}

tinyMCE.init({
	mode : "exact",
	elements : 'textareaHeader, textareaLeftColumn, textareaRightColumn, textareaFooter',
	theme : "advanced",
	button_title_map: false,
	apply_source_formatting: true,
	plugins: "table,contextmenu,advimage,advlink,paste,imagepopup",
	theme_advanced_toolbar_align: "left",
	theme_advanced_buttons1: "formatselect,outdent,indent,seperator,undo,redo,fontselect,fontsizeselect,link",
	theme_advanced_buttons2: "justifyleft,justifycenter,justifyright,separator,bold,italic,underline,separator,forecolor,backcolor,separator,bullist,numlist,link,separator,imagepopup,table,separator,sub,sup",
	theme_advanced_buttons3: "",
	theme_advanced_toolbar_location: "top",
	theme_advanced_path_location : "bottom",
	theme_advanced_resizing : true,
	content_css : "/style/editable.css",
	theme_advanced_blockformats : "h2,h3,blockquote"
});
</script>

<div id="contentContainer">
<div style="width:674px; margin-left:auto; margin-right:auto; background-color:#9bc4d1; border:3px #cde3ea solid; background-image:url(images/logo2.gif); background-position:top right; background-repeat:no-repeat">
<table cellpadding="0" cellspacing="0" style="width:650px; margin-left:12px; margin-right:12px">
    <tr>
    	<td>
        	<img alt="" src="images/pixel.gif" style="width:325px; height:3px" />
        </td>
        <td>
        	<img alt="" src="images/pixel.gif" style="width:325px; height:3px" />
        </td>
    </tr>
	<tr>
    	<td colspan="2">
        	<div name="header" id="header"><? echo $header ?></div>
        </td>
    </tr>
    <tr>
        <td style="border-right:1px #008080 solid">
        	<div name="leftColumn" id="leftColumn"><? echo $leftColumn ?></div>        
        </td>
        <td>
        	<div name="rightColumn" id="rightColumn"><? echo $rightColumn ?></div>
        </td>
    </tr>
	<tr>
    	<td colspan="2">
        	<div name="footer" id="footer"><? echo $footer ?></div>
        </td>
    </tr>
    <tr>
    	<td>
        	<img alt="" src="images/pixel.gif" style="width:325px; height:3px" />
        </td>
        <td>
        	<img alt="" src="images/pixel.gif" style="width:325px; height:3px" />
        </td>
    </tr>
</table>
</div>
</div>

<table cellpadding="5" cellspacing="0" style="width:1200px; margin-left:auto; margin-right:auto">
	<tr>
    	<td colspan="2" style="text-align:left">
            <input type="submit" onclick="previewDailyMenu()" value="Spremi" />
            <input type="hidden" name="editedHeader" id="editedHeader" />
            <input type="hidden" name="editedLeftColumn" id="editedLeftColumn" />
            <input type="hidden" name="editedRightColumn" id="editedRightColumn" />
            <input type="hidden" name="editedFooter" id="editedFooter" />
            <input type="hidden" name="editedContent" id="editedContent" />
        </td>
    </tr>
	<tr>
    	<td colspan="2">
        	<textarea style="width:1200px; height:300px;" id="textareaHeader"><? echo $header ?></textarea>
        </td>
    </tr>
    <tr>
        <td>
        	<textarea style="width:590px; height:500px;" id="textareaLeftColumn"><? echo $leftColumn ?></textarea>
        </td>
        <td>
        	<textarea style="width:590px; height:500px;" id="textareaRightColumn"><? echo $rightColumn ?></textarea>
        </td>
    </tr>
	<tr>
	<tr>
    	<td colspan="2">
        	<textarea style="width:1200px; height:300px;" id="textareaFooter"><? echo $footer ?></textarea>
        </td>
    </tr>
</table>
</form>
</body>
</html>