<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>Administrativno sučelje</title>
	<script type="text/javascript" src="js/admin_common.js"></script></script>
	<link rel="stylesheet" type="text/css" href="admin.css"></script>
</head>

<body>
<?php
		// check access
		
		if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != "true")
		{
			echo("Morate biti logirani.");
			exit();
		}
				
		// establish connection
		include("../classes.php");
		$conn = new connect();
				
		// do action
		if(isset($_GET["inpAction"]) && isset($_GET["inpValue"]))
		{	
			switch($_GET["inpAction"])
			{
				case "delete":
					$conn->mysqli->query("delete from comments where comment_id= '".$_GET["inpId"]."'");
					$conn->mysqli->query("update comments set _order = (_order - 1) where _order > '".$_GET["inpValue"]."'");
				break;
				case "save":
					$id = $_GET["inpId"];
					$comment_author= substr($_GET["inpTitle".$id],0,50);
					$text  = substr($_GET["txtText".$id],0,700);
					
					$conn->mysqli->query("update comments set comment_author = '".$comment_author."', comment_text = '".$text."' where comment_id = ".$id);
				break;
			}
		}
				
		// get text modules for homepage part
		$commentsResult = $conn->mysqli->query("select * from comments order by comment_date");

		unset($conn);

		echo "<form method='GET' id='formHome'> <input type='hidden' name='inpAction' id='inpAction'>";
		echo "<input type='hidden' name='inpValue' id='inpValue'>";
		echo "<input type='hidden' name='inpId' id='inpId'>";

		echo "<table width='100%' cellpading='0' cellspacing='0' class='adminTable'>";
		echo '<tr><td style="border-bottom:1px gray solid;padding-bottom:5px" ></td><td style="border-bottom:1px gray solid;padding-bottom:5px" >part_id</td><td style="border-bottom:1px gray solid;padding-bottom:5px" >title</td><td style="border-bottom:1px gray solid;padding-bottom:5px" >text</td style="border-bottom:1px gray solid;padding-bottom:5px" ></tr>';
		$counter = 1;
		$count = $commentsResult->num_rows;
		while($row = $commentsResult->fetch_array())
		{
			echo "<tr>";
			echo '<td width="10%" height="150" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top">';
			echo '<button onclick="handleClick(\'delete\',\''.$row["comment_id"].'\',\'\')">obriši</button><br/>';
			echo '<button onclick="handleClick(\'save\',\''.$row["comment_id"].'\',\'\')">spremi</button></td>';
			
			echo "<td width='10%'  height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>".$row["comment_date"]."</td>";
			echo "<td width='20%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitle".$row["comment_id"]."' name='inpTitle".$row["comment_id"]."' type='text' value='".$row['comment_author']."'></input></td>";
			echo "<td width='60%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%;height:140px' id='txtText".$row["comment_id"]."' name='txtText".$row["comment_id"]."'>".$row["comment_text"]."</textarea></td>";
			echo "</tr>";
			
			$counter++;
		}
				
		echo "</table></form>";

?>

</body>

</html>
