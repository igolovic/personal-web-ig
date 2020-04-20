<?php

include("classes.php");
$conn = new connect();
$conn->selectDb("hr");
							
// add new comments if any
if(isset($_POST["author"]) && isset($_POST['comment']) && filter_input(INPUT_POST,"author",FILTER_SANITIZE_STRING) && filter_input(INPUT_POST,"comment",FILTER_SANITIZE_STRING))
{
	if(strlen($_POST["author"]) <= 20 && strlen($_POST["comment"]) <= 700)
	{
		$text = $_POST["comment"];
		$array = explode(" ", $text);
		$conn->mysqli->query("INSERT INTO comments(comment_date, comment_author, comment_text) VALUES (NOW(), \"" . $conn->mysqli->real_escape_string(trim($_POST["author"])) . "\", \"" . $conn->mysqli->real_escape_string(trim($text)) . "\");");
	}
}
$commentsResult = $conn->mysqli->query("select * from comments order by comment_date");						
unset($conn);

// display existing comments
while($row = $commentsResult->fetch_array())
{						
	echo '<table width="100%" cellspacing="0" cellpadding="0">
	<tr><td width="11" height="0"></td><td width="498" ></td><td width="11" height="0"></td></tr>
	<tr><td colspan="3" height="11">
		<table style="margin-left:10px" cellpadding="0" cellspacing="0"><tr><td class="gchl"></td>
		<td class="text gchm">';
						
	if(!isset($_SESSION['lang']))
	{
		$lang = "cro";
		
	} else if($_SESSION['lang'] == "cro")
	{
		$lang = "cro";
		
	} else if($_SESSION['lang'] == "eng")
	{
		$lang = "eng";
	}
	
	if(isset($_POST['lang']) && $_POST['lang'] == "eng")
	{
		$lang = "eng";
	}
	
	if($lang == "cro")
	{
		setlocale(LC_ALL,'croatian');
		$date = strftime("%d. %B %Y. %H:%M:%S", strtotime($row['comment_date'])); 
		$date = iconv('ISO-8859-2', 'UTF-8', $date );
	}
	else
	{
		$date = date("d. F Y.", strtotime($row['comment_date'])); 
	}
	
	$comment = htmlspecialchars($row['comment_text']);
	$comment = str_replace(":)","<img style='margin-bottom:-2px' alt='' src='res/emoticons/smile1.gif' />",$comment);
	$comment = str_replace(":D","<img style='margin-bottom:-2px' alt='' src='res/emoticons/mrgreen1.gif' />",$comment);
	$comment = str_replace(":|","<img style='margin-bottom:-2px' alt='' src='res/emoticons/confused2.gif' />",$comment);
	$comment = str_replace(":(","<img style='margin-bottom:-2px' alt='' src='res/emoticons/sad2.gif' />",$comment);
	$comment = str_replace("[muu]","<img style='margin-bottom:-2px' alt='' src='res/emoticons/mooo.gif' />",$comment);
	$comment = str_replace("[:P]","<img style='margin-bottom:-2px' alt='' src='res/emoticons/tongue1.gif' />",$comment);
	$comment = str_replace("\"","&quot;",$comment);
	$comment = stripslashes($comment);
	
	$comment = nl2br($comment);

	echo $date . '&nbsp; <strong>' . htmlspecialchars($row['comment_author']) . '</strong>
		</td><td class="gchr"></td></tr>
		</table>
	</td></tr>
	<tr><td class="nwBlue"></td><td class="nB"></td><td class="neBlue"></td></tr>
	<tr style="background-color:#95DFFF"><td class="wB"></td><td class="text gct">'
	. $comment .
	'</td><td class="eB"></td></tr>
	<tr><td class="swBlue"></td><td class="sB"></td><td class="seBlue"></td></tr>
	</table><br/>';
}
?>