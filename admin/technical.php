<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Administrativno sučelje</title>
<script type="text/javascript" src="js/admin_common.js"></script><link rel="stylesheet" type="text/css" href="admin.css"></script>
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
		if(isset($_GET["inpAction"]) && isset($_GET["inpValue"]))
		{	
			switch($_GET["inpAction"])
			{
				case "deleteL":
					$conn->mysqli->query("delete from short_text_modules where short_text_module_id = '".$_GET["inpId"]."'");
					$conn->mysqli->query("update short_text_modules set _order = (_order - 1) where _order > '".$_GET["inpValue"]."' and part_id = 'Technical' and position = '0'");
				break;
				case "upL":
					$conn->mysqli->query("update short_text_modules set _order = (_order + 1) where _order = '".($_GET["inpValue"]-1)."' and part_id = 'Technical' and position = '0'");
					$conn->mysqli->query("update short_text_modules set _order = (_order - 1) where short_text_module_id = '".$_GET["inpId"]."'");
				break;
				case "downL":
					$conn->mysqli->query("update short_text_modules set _order = (_order - 1) where _order = '".($_GET["inpValue"]+1)."' and part_id = 'Technical' and position = '0'");
					$conn->mysqli->query("update short_text_modules set _order = (_order + 1) where short_text_module_id = '".$_GET["inpId"]."'");
				break;
				case "saveL":
					$id = $_GET["inpId"];
					$title = substr($_GET["inpTitleL".$id],0,50);
					$text  = substr($_GET["txtTextL".$id],0,3000);
					$conn->mysqli->query("update short_text_modules set title='".$title."', text='".$text."' where short_text_module_id = '".$id."'");
				break;
				case "newL":
					$title = substr($_GET["inpTitleNewL"],0,50);
					$text  = substr($_GET["txtTextNewL"],0,3000);
					$conn->mysqli->query("insert into short_text_modules(short_text_module_id, position, part_id, _order, title, text) values (null, 0, 'Technical', ".$conn->mysqli->query("select ifnull(max(_order)+1, 1) as num from short_text_modules where part_id = 'Technical' and position = 0")->fetch_array()["num"].", '".$title."', '".$text."')");
				break;
				
				case "deleteR":
					$conn->mysqli->query("delete from short_text_modules where short_text_module_id = '".$_GET["inpId"]."'");
					$conn->mysqli->query("update short_text_modules set _order = (_order - 1) where _order > '".$_GET["inpValue"]."' and part_id = 'Technical' and position = '1'");
				break;
				case "upR":
					$conn->mysqli->query("update short_text_modules set _order = (_order + 1) where _order = '".($_GET["inpValue"]-1)."' and part_id = 'Technical' and position = '1'");
					$conn->mysqli->query("update short_text_modules set _order = (_order - 1) where short_text_module_id = '".$_GET["inpId"]."'");
				break;
				case "downR":
					$conn->mysqli->query("update short_text_modules set _order = (_order - 1) where _order = '".($_GET["inpValue"]+1)."' and part_id = 'Technical' and position = '1'");
					$conn->mysqli->query("update short_text_modules set _order = (_order + 1) where short_text_module_id = '".$_GET["inpId"]."'");
				break;
				case "saveR":
					$id = $_GET["inpId"];
					$title = substr($_GET["inpTitleR".$id],0,50);
					$text  = substr($_GET["txtTextR".$id],0,3000);
					$conn->mysqli->query("update short_text_modules set title='".$title."', text='".$text."' where short_text_module_id = '".$id."'");
				break;
				case "newR":
					$title = substr($_GET["inpTitleNewR"],0,50);
					$text  = substr($_GET["txtTextNewR"],0,3000);
					$conn->mysqli->query("insert into short_text_modules(short_text_module_id, position, part_id, _order, title, text) values(null, 1, 'Technical', ".$conn->mysqli->query("select ifnull(max(_order)+1, 1) as num from short_text_modules where part_id = 'Technical' and position = 1")->fetch_array()["num"].", '".$title."', '".$text."')");
				break;
			}
		}
				
		// get short text modules for homepage part
		$leftShortTextModulesResult = $conn->mysqli->query("select * from short_text_modules where part_id = 'Technical' and position = 0 order by _order");
		
		$rightShortTextModulesResult = $conn->mysqli->query("select * from short_text_modules where part_id = 'Technical' and position = 1 order by _order");

		unset($conn);

		echo "<table width='100%' cellpading='10' cellspacing='10'><tr><td valign='top'>";
		// left
		
		echo "<form method='GET' id='formTechnical'> <input type='hidden' name='inpAction' id='inpAction'>";
		echo "<input type='hidden' name='inpValue' id='inpValue'>";
		echo "<input type='hidden' name='inpId' id='inpId'>";

		echo "<table width='100%' cellpading='0' cellspacing='0' class='adminTable'>";
		echo '<tr><td style="border-bottom:1px gray solid;padding-bottom:5px" ></td><td style="border-bottom:1px gray solid;padding-bottom:5px" >part_id</td><td style="border-bottom:1px gray solid;padding-bottom:5px" >title</td><td style="border-bottom:1px gray solid;padding-bottom:5px" >text</td style="border-bottom:1px gray solid;padding-bottom:5px" ></tr>';
		$counter = 1;
		$count = $leftShortTextModulesResult->num_rows;
		while($row = $leftShortTextModulesResult->fetch_array())
		{
			echo "<tr>";
			echo '<td width="8%" height="150" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top">';
			echo '<button onclick="handleClick(\'deleteL\',\''.$row["short_text_module_id"].'\',null ,\''.$row["_order"].'\')">obriši</button><br/>';
			if($counter > 1)
			{
				echo '<button onclick="handleClick(\'upL\',\''.  $row["short_text_module_id"].'\',null ,\''.$row["_order"].'\')">gore</button><br/>';
			}
			if($counter < $count)
			{
				echo '<button onclick="handleClick(\'downL\',\''.$row["short_text_module_id"].'\',null ,\''.$row["_order"].'\')">dolje</button><br/>';
			}
			echo '<button onclick="handleClick(\'saveL\',\''.$row["short_text_module_id"].'\',null ,\''.$row["_order"].'\')">spremi</button></td>';
			

			echo "<td width='6%'  height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>".$row["part_id"]."</td>";
			echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitleL".$row["short_text_module_id"]."' name='inpTitleL".$row["short_text_module_id"]."' type='text' value='".$row['title']."'></input></td>";
			echo "<td width='70%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%;height:140px' id='txtTextL".$row["short_text_module_id"]."' name='txtTextL".$row["short_text_module_id"]."'>".$row["text"]."</textarea></td>";
			echo "</tr>";
			
			$counter++;
		}
		
			echo "<tr>";
			echo '<td width="8%" height="150" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top"><button value="gore" onclick="handleClick(\'newL\',\'\',\'\',\'\')">dodaj</button></td>';
			echo "<td width='6%'  height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>homepage</td>";
			echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id= id='inpTitleNewL' name='inpTitleNewL' type='text' value='".$row['title']."'></input></td>";
			echo "<td width='70%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%;height:140px' id='txtTextNewL' name='txtTextNewL'>".$row["text"]."</textarea></td>";
			echo "</tr>";
		
		echo "</table></td>";
		
		// right
		echo "<td valign='top'><table width='100%' cellpading='0' cellspacing='0' class='adminTable'>";
		echo '<tr><td style="border-bottom:1px gray solid;padding-bottom:5px" ></td><td style="border-bottom:1px gray solid;padding-bottom:5px" >part_id</td><td style="border-bottom:1px gray solid;padding-bottom:5px" >title</td><td style="border-bottom:1px gray solid;padding-bottom:5px" >text</td style="border-bottom:1px gray solid;padding-bottom:5px" ></tr>';
		$counter = 1;
		$count = $rightShortTextModulesResult->num_rows;
		while($row = $rightShortTextModulesResult->fetch_array())
		{
			echo "<tr>";
			echo '<td width="8%" height="150" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top">';
			echo '<button onclick="handleClick(\'deleteR\',\''.$row["short_text_module_id"].'\',null ,\''.$row["_order"].'\')">obriši</button><br/>';
			if($counter > 1)
			{
				echo '<button onclick="handleClick(\'upR\',\''.  $row["short_text_module_id"].'\',null ,\''.$row["_order"].'\')">gore</button><br/>';
			}
			if($counter < $count)
			{
				echo '<button onclick="handleClick(\'downR\',\''.$row["short_text_module_id"].'\',null ,\''.$row["_order"].'\')">dolje</button><br/>';
			}
			echo '<button onclick="handleClick(\'saveR\',\''.$row["short_text_module_id"].'\',null ,\''.$row["_order"].'\')">spremi</button></td>';




			echo "<td width='6%'  height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>".$row["part_id"]."</td>";
			echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitleR".$row["short_text_module_id"]."' name='inpTitleR".$row["short_text_module_id"]."' type='text' value='".$row['title']."'></input></td>";
			echo "<td width='70%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%;height:140px' id='txtTextR".$row["short_text_module_id"]."' name='txtTextR".$row["short_text_module_id"]."'>".$row["text"]."</textarea></td>";
			echo "</tr>";
			
			$counter++;
		}
		
			echo "<tr>";
			echo '<td width="8%" height="150" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top"><button value="gore" onclick="handleClick(\'newR\',\'\',\'\',\'\')">dodaj</button></td>';
			echo "<td width='6%'  height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>homepage</td>";
			echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id= id='inpTitleNewR' name='inpTitleNewR' type='text' value='".$row['title']."'></input></td>";
			echo "<td width='70%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%;height:140px' id='txtTextNewR' name='txtTextNewR'>".$row["text"]."</textarea></td>";
			echo "</tr>";
		
		echo "</table></form></tr></td></table>";
?>

</body>

</html>
