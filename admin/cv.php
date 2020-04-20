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
		if(isset($_POST["inpAction"]) && isset($_POST["inpValue"]))
		{	
			switch($_POST["inpAction"])
			{
				case "delete":
					$conn->mysqli->query("delete from cv_parts where cv_part_id = '".$_POST["inpId"]."'");
					$conn->mysqli->query("update cv_parts set _order = (_order - 1) where _order > '".$_POST["inpValue"]."'");
				break;
				case "up":
					$conn->mysqli->query("update cv_parts set _order = (_order + 1) where _order = '".($_POST["inpValue"]-1)."'");
					$conn->mysqli->query("update cv_parts set _order = (_order - 1) where cv_part_id = '".$_POST["inpId"]."'");
				break;
				case "down":
					$conn->mysqli->query("update cv_parts set _order = (_order - 1) where _order = '".($_POST["inpValue"]+1)."'");
					$conn->mysqli->query("update cv_parts set _order = (_order + 1) where cv_part_id = '".$_POST["inpId"]."'");
				break;
				case "save":
					$id = $_POST["inpId"];
					$title = substr($_POST["inpTitle".$id],0,50);
					$conn->mysqli->query("update cv_parts set title='".$title."' where cv_part_id = '".$id."'");
				break;
				case "new":
					$title = substr($_POST["inpTitleNew"],0,50);
					$conn->mysqli->query("insert into cv_parts(cv_part_id, title, _order) values(null, '".$title."', ".$conn->mysqli->query("select ifnull(max(_order)+1, 1) as num from cv_data")->fetch_array()["num"].")");
				break;
				
				case "deleteSubmodule":
					$conn->mysqli->query("delete from cv_data where cv_data_id = '".$_POST["inpId"]."'");
					$conn->mysqli->query("update cv_data set _order = (_order - 1) where _order > '".$_POST["inpValue"]."'");
				break;
				case "upSubmodule":
					$conn->mysqli->query("update cv_data set _order = (_order + 1) where _order = '".($_POST["inpValue"]-1)."'");
					$conn->mysqli->query("update cv_data set _order = (_order - 1) where cv_data_id = '".$_POST["inpId"]."'");
				break;
				case "downSubmodule":
					$conn->mysqli->query("update cv_data set _order = (_order - 1) where _order = '".($_POST["inpValue"]+1)."'");
					$conn->mysqli->query("update cv_data set _order = (_order + 1) where cv_data_id = '".$_POST["inpId"]."'");
				break;
				case "saveSubmodule":
				
					$id = $_POST["inpId"];
					$title = substr($_POST["inpTitleSubmodule".$id],0,2000);
					$text = substr($_POST["txtTextSubmodule".$id],0,2000);
					$conn->mysqli->query("update cv_data set title='".$title."', text = '".$text."' where cv_data_id = '".$id."'");
				break;
				case "newSubmodule":
					$parentid = $_POST["inpId2"];
					$title = substr($_POST["inpTitleNewSubmodule".$parentid],0,2000);
					$text = substr($_POST["txtTextNewSubmodule".$parentid],0,2000);
					$conn->mysqli->query("insert into cv_data(cv_data_id, cv_part_id, _order, title, text) values(null, '".$_POST['inpId2']."', ".$conn->mysqli->query("select ifnull(max(_order)+1, 1) as num from cv_data where cv_part_id = ".$_POST['inpId2'])->fetch_array()["num"].", '".$title."', '".$text."')");
				break;
			}
		}
				
		// cv parts and data
		$cvPartsResult = $conn->mysqli->query("select * from cv_parts order by _order");


		echo "<form method='POST' id='formCv'> <input type='hidden' name='inpAction' id='inpAction'>";
		echo "<input type='hidden' name='inpValue' id='inpValue'>";
		echo "<input type='hidden' name='inpId' id='inpId'>";
		echo "<input type='hidden' name='inpId2' id='inpId2'>";

		echo "<table width='100%' cellpading='0' cellspacing='0' class='adminTable'>";
		echo '<tr><td style="border-bottom:1px gray solid;padding-bottom:5px" ></td>
		<td style="border-bottom:1px gray solid;padding-bottom:5px" >title</td>
		<td style="border-bottom:1px gray solid;padding-bottom:5px"></td></tr>';
		$counter = 1;
		$count = $cvPartsResult->num_rows;
		while($row = $cvPartsResult->fetch_array())
		{
			echo "<tr>";
			echo '<td width="10%" height="200" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top">';
			echo '<button onclick="handleClick(\'delete\',\''.$row["cv_part_id"].'\',null ,\''.$row["_order"].'\')">obriši</button><br/>';
			if($counter > 1)
			{
				echo '<button onclick="handleClick(\'up\',\''.  $row["cv_part_id"].'\',null ,\''.$row["_order"].'\')">gore</button><br/>';
			}
			if($counter < $count)
			{
				echo '<button onclick="handleClick(\'down\',\''.$row["cv_part_id"].'\',null ,\''.$row["_order"].'\')">dolje</button><br/>';
			}
			echo '<button onclick="handleClick(\'save\',\''.$row["cv_part_id"].'\',null ,\''.$row["_order"].'\')">spremi</button></td>';
			


			echo "<td width='20%' height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitle".$row["cv_part_id"]."' name='inpTitle".$row["cv_part_id"]."' type='text' value='".$row['title']."'></input></td>";
			echo "<td width='70%' height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>";

					$cvDataResults[$counter] = $conn->mysqli->query("select * from cv_data where cv_part_id = " . $row["cv_part_id"] . " order by _order");
					$counter2 = 1;
					echo '<table width="100% cellpadding="0" cellspacing="0" style="border:1px gray solid;">';
					while($row2 = $cvDataResults[$counter]->fetch_array())
					{
						$count = $cvDataResults[$counter]->num_rows;
					
						echo '<tr>';
						
							echo '<td width="10%" height="200" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top">';
							echo '<button onclick="handleClick(\'deleteSubmodule\',\''.$row2["cv_data_id"].'\',null ,\''.$row2["_order"].'\')">obriši</button><br/>';
							if($counter2 > 1)
							{
								echo '<button onclick="handleClick(\'upSubmodule\',\''.  $row2["cv_data_id"].'\',null ,\''.$row2["_order"].'\')">gore</button><br/>';
							}
							if($counter2 < $count)
							{
								echo '<button onclick="handleClick(\'downSubmodule\',\''.$row2["cv_data_id"].'\',null ,\''.$row2["_order"].'\')">dolje</button><br/>';
							}
							echo '<button onclick="handleClick(\'saveSubmodule\',\''.$row2["cv_data_id"].'\',null ,\''.$row2["_order"].'\')">spremi</button></td>';

							echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitleSubmodule".$row2["cv_data_id"]."' name='inpTitleSubmodule".$row2["cv_data_id"]."' type='text' value='".$row2['title']."'></input></td>";
							echo "<td width='70%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%;height:140px' id='txtTextSubmodule".$row2["cv_data_id"]."' name='txtTextSubmodule".$row2["cv_data_id"]."'>".$row2["text"]."</textarea></td>";
						echo '</tr>';
						
						$counter2++;
					}
					echo "<tr>";
					echo '<td width="8%" height="150" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top"><button value="gore" onclick="handleClick(\'newSubmodule\',\'\',\''.$row["cv_part_id"].'\',\'\')">dodaj</button></td>';
					echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitleNewSubmodule".$row["cv_part_id"]."' name='inpTitleNewSubmodule".$row["cv_part_id"]."' type='text'></input></td>";
					echo "<td width='70%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%;height:140px' id='txtTextNewSubmodule".$row["cv_part_id"]."' name='txtTextNewSubmodule".$row["cv_part_id"]."'></textarea></td>";
					echo "</tr>";
					
					echo '</table>';
				/*	$counter++;
				}*/

			echo "</td>";
			echo "</tr>";
			
			$counter++;
		}
		
		echo "<tr>";
		echo '<td width="10%" height="200" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top"><button onclick="handleClick(\'new\',\'\',\'\')">dodaj</button></td>';
		echo "<td width='20%' height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id= id='inpTitleNew' name='inpTitleNew' type='text' value='".$row['title']."'></input></td>";
		echo "<td width='70%' height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'></td>";
		echo "</tr>";
		
		echo "</table></form>";
		
		unset($conn);

?>

</body>

</html>
