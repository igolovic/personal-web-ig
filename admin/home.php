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
		// Check access
		if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != "true")
		{
			echo("Morate biti logirani.");
			exit();
		}
		
		// establish connection
		include("../classes.php");
		$conn = new connect();

		// do action
		if(isset($_POST["inpAction"]) && isset($_POST["inpValue"]))
		{	
			switch($_POST["inpAction"])
			{
				case "delete":
					$conn->mysqli->query("delete from text_modules where text_module_id = '".$_POST["inpId"]."'");
					$conn->mysqli->query("update text_modules set _order = (_order - 1) where _order > '".$_POST["inpValue"]."' and part_id = 'Homepage'");
				break;
				case "up":
					$conn->mysqli->query("update text_modules set _order = (_order + 1) where _order = '".($_POST["inpValue"]-1)."' and part_id = 'Homepage'");
					$conn->mysqli->query("update text_modules set _order = (_order - 1) where text_module_id = '".$_POST["inpId"]."'");
				break;
				case "down":
					$conn->mysqli->query("update text_modules set _order = (_order - 1) where _order = '".($_POST["inpValue"]+1)."' and part_id = 'Homepage'");
					$conn->mysqli->query("update text_modules set _order = (_order + 1) where text_module_id = '".$_POST["inpId"]."'");
				break;
				case "save":
					$id = $_POST["inpId"];
					$title = substr($_POST["inpTitle".$id],0,50);
					$text  = substr($_POST["txtText".$id],0,3000);
					$conn->mysqli->query("update text_modules set title='".$title."', text='".$text."' where text_module_id = '".$id."'");
				break;
				case "new":
					$title = substr($_POST["inpTitleNew"],0,50);
					$text  = substr($_POST["txtTextNew"],0,3000);
					$conn->mysqli->query("insert into text_modules (text_module_id, part_id, _order, title, text) values(null, 'Homepage', ".$conn->mysqli->query("select ifnull(max(_order)+1, 1) as num from text_modules where part_id = 'Homepage'")->fetch_array()["num"].", '".$title."', '".$text."')");
				break;
			}
		}
				
		// get text modules for Homepage part
		$textModulesResult = $conn->mysqli->query("select * from text_modules where part_id = 'Homepage' order by _order");
		unset($conn);


		echo "<form method='POST' id='formHome'> <input type='hidden' name='inpAction' id='inpAction'>";
		echo "<input type='hidden' name='inpValue' id='inpValue'>";
		echo "<input type='hidden' name='inpId' id='inpId'>";

		echo "<table width='100%' cellpading='0' cellspacing='0' class='adminTable'>";
		echo '<tr><td style="border-bottom:1px gray solid;padding-bottom:5px" ></td><td style="border-bottom:1px gray solid;padding-bottom:5px" >part_id</td><td style="border-bottom:1px gray solid;padding-bottom:5px" >title</td><td style="border-bottom:1px gray solid;padding-bottom:5px" >text</td style="border-bottom:1px gray solid;padding-bottom:5px" ></tr>';
		$counter = 1;
		$count = $textModulesResult->num_rows;
		while($row = $textModulesResult->fetch_array())
		{
			echo "<tr>";
			echo '<td width="8%" height="150" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top">';
			echo '<button onclick="handleClick(\'delete\',\''.$row["text_module_id"].'\',null ,\''.$row["_order"].'\')">obriši</button><br/>';
			if($counter > 1)
			{
				echo '<button onclick="handleClick(\'up\',\''.  $row["text_module_id"].'\',null ,\''.$row["_order"].'\')">gore</button><br/>';
			}
			if($counter < $count)
			{
				echo '<button onclick="handleClick(\'down\',\''.$row["text_module_id"].'\',null ,\''.$row["_order"].'\')">dolje</button><br/>';
			}
			echo '<button onclick="handleClick(\'save\',\''.$row["text_module_id"].'\',null ,\''.$row["_order"].'\')">spremi</button></td>';
			// echo '<button class="open'.$row["text_module_id"].'" onclick="openForEditing('.$row["text_module_id"].')">uredi</button></td>';
			// echo '<button class="close'.$row["text_module_id"].'" onclick="closeForEditing('.$row["text_module_id"].')">zatvori</button></td>';
			





			echo "<td width='6%'  height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>".$row["part_id"]."</td>";
			echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitle".$row["text_module_id"]."' name='inpTitle".$row["text_module_id"]."' type='text' value='".$row['title']."'></input></td>";
			echo "<td width='70%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%;height:140px' id='txtText".$row["text_module_id"]."' name='txtText".$row["text_module_id"]."'>".$row["text"]."</textarea></td>";
			echo "</tr>";
			
			$counter++;
		}
		
			echo "<tr>";
			echo '<td width="8%" height="150" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top"><button value="gore" onclick="handleClick(\'new\',\'\',\'\')">dodaj</button></td>';
			echo "<td width='6%'  height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>Homepage</td>";
			echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id= id='inpTitleNew' name='inpTitleNew' type='text' value='".$row['title']."'></input></td>";
			echo "<td width='70%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%;height:140px' id='txtTextNew' name='txtTextNew'>".$row["text"]."</textarea></td>";
			echo "</tr>";
		
		echo "</table></form>";

?>

</body>

</html>
