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
					$conn->mysqli->query("delete from text_modules where text_module_id = '".$_GET["inpId"]."'");
					$conn->mysqli->query("update text_modules set _order = (_order - 1) where _order > '".$_GET["inpValue"]."' and part_id = 'Leisure'");
				break;
				case "up":
					$conn->mysqli->query("update text_modules set _order = (_order + 1) where _order = '".($_GET["inpValue"]-1)."' and part_id = 'Leisure'");
					$conn->mysqli->query("update text_modules set _order = (_order - 1) where text_module_id = '".$_GET["inpId"]."'");
				break;
				case "down":
					$conn->mysqli->query("update text_modules set _order = (_order - 1) where _order = '".($_GET["inpValue"]+1)."' and part_id = 'Leisure'");
					$conn->mysqli->query("update text_modules set _order = (_order + 1) where text_module_id = '".$_GET["inpId"]."'");
				break;
				case "save":
					$id = $_GET["inpId"];
					$title = substr($_GET["inpTitle".$id],0,50);
					$text  = substr($_GET["txtText".$id],0,3000);
					$conn->mysqli->query("update text_modules set title='".$title."', text='".$text."' where text_module_id = '".$id."'");
				break;
				case "new":
					$title = substr($_GET["inpTitleNew"],0,50);
					$text  = substr($_GET["txtTextNew"],0,3000);
					$conn->mysqli->query("insert into text_modules(text_module_id, part_id, _order, title, text) values(null, 'Leisure', ".$conn->mysqli->query("select ifnull(max(_order)+1, 1) as num from text_modules where part_id = 'Leisure'")->fetch_array()["num"].", '".$title."', '".$text."')");
				break;
			}
		}
				
		// get text modules for Leisure part
		$textModulesResult = $conn->mysqli->query("select * from text_modules where part_id = 'Leisure' order by _order");
		unset($conn);


		echo "<form method='GET' id='formLeisureTextModules'> <input type='hidden' name='inpAction' id='inpAction'>";
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
			echo '<button onclick="handleClick(\'delete\',\''.$row["text_module_id"].'\',\''.$row["_order"].'\')">obriši</button><br/>';
			if($counter > 1)
			{
				echo '<button onclick="handleClick(\'up\',\''.  $row["text_module_id"].'\',\''.$row["_order"].'\')">gore</button><br/>';
			}
			if($counter < $count)
			{
				echo '<button onclick="handleClick(\'down\',\''.$row["text_module_id"].'\',\''.$row["_order"].'\')">dolje</button><br/>';
			}
			echo '<button onclick="handleClick(\'save\',\''.$row["text_module_id"].'\',\''.$row["_order"].'\')">spremi</button></td>';
			





			echo "<td width='6%'  height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>".$row["part_id"]."</td>";
			echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitle".$row["text_module_id"]."' name='inpTitle".$row["text_module_id"]."' type='text' value='".$row['title']."'></input></td>";
			echo "<td width='70%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%;height:140px' id='txtText".$row["text_module_id"]."' name='txtText".$row["text_module_id"]."'>".$row["text"]."</textarea></td>";
			echo "</tr>";
			
			$counter++;
		}
		
			echo "<tr>";
			echo '<td width="8%" height="150" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top"><button value="gore" onclick="handleClick(\'new\',\'\',\'\')">dodaj</button></td>';
			echo "<td width='6%'  height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>Leisure</td>";
			echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id= id='inpTitleNew' name='inpTitleNew' type='text' value='".$row['title']."'></input></td>";
			echo "<td width='70%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%;height:140px' id='txtTextNew' name='txtTextNew'>".$row["text"]."</textarea></td>";
			echo "</tr>";
		
		echo "</table></form>";

?>

</body>

</html>
