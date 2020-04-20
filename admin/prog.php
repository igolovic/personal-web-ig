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
		include("prog_submodules.php");
		
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
					if($conn->mysqli->query("delete from image_text_modules where image_text_module_id = '".$_POST["inpId"]."' and part_id = 'FavProgram'") == true)
					{
						$conn->mysqli->query("update image_text_modules set _order = (_order - 1) where _order > '".$_POST["inpId2"]."' and part_id = 'FavProgram'");
						unlink("../" . $_POST["inpValue"]);
					}
				break;
				case "up":
					$conn->mysqli->query("update image_text_modules set _order = (_order + 1) where _order = '".($_POST["inpValue"]-1)."' and part_id = 'FavProgram'");
					$conn->mysqli->query("update image_text_modules set _order = (_order - 1) where image_text_module_id = '".$_POST["inpId"]."'");
				break;
				case "down":
					$conn->mysqli->query("update image_text_modules set _order = (_order - 1) where _order = '".($_POST["inpValue"]+1)."' and part_id = 'FavProgram'");
					$conn->mysqli->query("update image_text_modules set _order = (_order + 1) where image_text_module_id = '".$_POST["inpId"]."' and part_id = 'FavProgram'");
				break;
				case "save":
					$id = $_POST["inpId"];
					$title = substr($_POST["inpTitle".$id],0,50);
					$text  = substr($_POST["txtText".$id],0,3000);	
								
					$uploaded_file_id = "uploadedfile".$id;
					$path = "";	
					$path_sql_chunk = "";
					
					
					if(isset($_FILES[$uploaded_file_id]['name']) && $_FILES[$uploaded_file_id]['name'] != "")
					{
						unlink("../" . $_POST["inpValue"]);

						$path = "../res/"  . $_FILES[$uploaded_file_id]['name'];
						if(!move_uploaded_file($_FILES[$uploaded_file_id]['tmp_name'], $path)) 
						{
							echo "Greška!";
						}	
						$path_sql_chunk =  ", image_path = '".$path."'";
					}
					
					$path_sql_chunk = str_replace("../","",$path_sql_chunk);
var_dump("update image_text_modules set title='".$title."', text = '".$text."' " . $path_sql_chunk . " where image_text_module_id = '".$id."' and part_id = 'FavProgram'");
					$conn->mysqli->query("update image_text_modules set title='".$title."', text = '".$text."' " . $path_sql_chunk . " where image_text_module_id = '".$id."' and part_id = 'FavProgram'");
									
				break;
				case "new":
					$id = $_POST["inpId"];
					$title = substr($_POST["inpTitleNew"],0,50);
					$text  = substr($_POST["txtTextNew"],0,3000);
					$path = "";	
					
					if($_FILES["uploadedfileNew"]['name'] != "")
					{
						$path = "../res/"  . $_FILES["uploadedfileNew"]['name'];
						if(!move_uploaded_file($_FILES["uploadedfileNew"]['tmp_name'], $path)) 
						{
							echo "Greška!";
						}	
					}
					
					$path = str_replace("../","",$path);

					$conn->mysqli->query("insert into image_text_modules(image_text_module_id, part_id, _order, title, text, image_path, is_image) values(null, 'FavProgram', ".$conn->mysqli->query("select ifnull(max(_order)+1, 1) as num from image_text_modules where part_id = 'FavProgram'")->fetch_array()["num"].", '".$title."', '".$text."', '" .$path. "', 1)");
				break;
				
				case "deleteL":
					$conn->mysqli->query("delete from image_text_submodules where image_text_submodule_id = '".$_POST["inpId"]."'");
					$conn->mysqli->query("update image_text_submodules set _order = (_order - 1) where _order > '".$_POST["inpValue"]."' and module = '".$_POST["inpId2"]."' and position = '0'");
				break;
				case "upL":
					$conn->mysqli->query("update image_text_submodules set _order = (_order + 1) where _order = '".($_POST["inpValue"]-1)."' and module = '".$_POST["inpId2"]."' and position = '0'");
					$conn->mysqli->query("update image_text_submodules set _order = (_order - 1) where image_text_submodule_id = '".$_POST["inpId"]."'");
				break;
				case "downL":
					$conn->mysqli->query("update image_text_submodules set _order = (_order - 1) where _order = '".($_POST["inpValue"]+1)."' and module = '".$_POST["inpId2"]."' and position = '0'");
					$conn->mysqli->query("update image_text_submodules set _order = (_order + 1) where image_text_submodule_id = '".$_POST["inpId"]."'");
				break;
				case "saveL":
					$id = $_POST["inpId"];
					$title = substr($_POST["inpTitleL".$id],0,50);
					$text  = substr($_POST["txtTextL".$id],0,3000);
					$conn->mysqli->query("update image_text_submodules set title='".$title."', text='".$text."' where image_text_submodule_id = '".$id."'");
				break;
				case "newL":
					$title = substr($_POST["inpTitleNewL".$_POST["inpId"]],0,50);
					$text  = substr($_POST["txtTextNewL" .$_POST["inpId"]],0,3000);
					$conn->mysqli->query("insert into image_text_submodules(image_text_submodule_id, _order, part_id, position, module, title, text) values(null, ".$conn->mysqli->query("select ifnull(max(_order)+1, 1) as num from image_text_submodules where part_id = 'FavProgram' and position = 0")->fetch_array()["num"].", 'FavProgram', 0, ".$_POST["inpId"].", '".$title."', '".$text."')");
				break;
				
				case "deleteR":			
					$conn->mysqli->query("delete from image_text_submodules where image_text_submodule_id = '".$_POST["inpId"]."'");
					$conn->mysqli->query("update image_text_submodules set _order = (_order - 1) where _order > '".$_POST["inpValue"]."' and module = '".$_POST["inpId2"]."' and position = '1'");
				break;
				case "upR":
					$conn->mysqli->query("update image_text_submodules set _order = (_order + 1) where _order = '".($_POST["inpValue"]-1)."' and module = '".$_POST["inpId2"]."' and position = '1'");
					$conn->mysqli->query("update image_text_submodules set _order = (_order - 1) where image_text_submodule_id = '".$_POST["inpId"]."'");
				break;
				case "downR":
					$conn->mysqli->query("update image_text_submodules set _order = (_order - 1) where _order = '".($_POST["inpValue"]+1)."' and module = '".$_POST["inpId2"]."' and position = '1'");
					$conn->mysqli->query("update image_text_submodules set _order = (_order + 1) where image_text_submodule_id = '".$_POST["inpId"]."'");
				break;
				case "saveR":
					$id = $_POST["inpId"];
					$title = substr($_POST["inpTitleR".$id],0,50);
					$text  = substr($_POST["txtTextR".$id],0,3000);
					$conn->mysqli->query("update image_text_submodules set title='".$title."', text='".$text."' where image_text_submodule_id = '".$id."'");
				break;
				case "newR":
					$title = substr($_POST["inpTitleNewR".$_POST["inpId"]],0,50);
					$text  = substr($_POST["txtTextNewR" .$_POST["inpId"]],0,3000);
					$conn->mysqli->query("insert into image_text_submodules (image_text_submodule_id, _order, part_id, position, module, title, text) values(null, ".$conn->mysqli->query("select ifnull(max(_order)+1, 1) as num from image_text_submodules where part_id = 'FavProgram' and position = 1")->fetch_array()["num"].", 'FavProgram', 1, ".$_POST["inpId"].", '".$title."', '".$text."')");
				break;			
			}
		}
				
		// get favorite programs
		$favprogsResult = $conn->mysqli->query("select * from image_text_modules where part_id = 'FavProgram' order by _order");
		unset($conn);
		$counter = 0;
		$rownum = $favprogsResult->num_rows;

		echo "<form enctype='multipart/form-data' method='POST' id='formProg'> <input type='hidden' name='inpAction' id='inpAction'>";
		echo "<input type='hidden' name='inpValue' id='inpValue'>";
		echo "<input type='hidden' name='inpId' id='inpId'>";
		echo "<input type='hidden' name='inpId2' id='inpId2'>";

		echo '<a href="prog.php#new">novi modul</a>';

		echo "<table width='100%' cellpading='0' cellspacing='0' class='adminTable'>";
		echo '<tr><td style="border-bottom:1px gray solid;padding-bottom:5px" ></td>
		<td style="border-bottom:1px gray solid;padding-bottom:5px" >title</td>
		<td style="border-bottom:1px gray solid;padding-bottom:5px"></td></tr>';
		$counter = 1;
		$count = $favprogsResult->num_rows;
		while($row = $favprogsResult->fetch_array())
		{
			echo "<tr>";
			echo '<td width="5%" height="200" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top">';
			echo '<button onclick="handleClick(\'delete\',\''.$row["image_text_module_id"].'\',\''.$row["_order"].'\',\''.$row["image_path"].'\')">obriši</button><br/>';
			if($counter > 1)
			{
				echo '<button onclick="handleClick(\'up\',\''.  $row["image_text_module_id"].'\', null, \''.$row["_order"].'\')">gore</button><br/>';
			}
			if($counter < $count)
			{
				echo '<button onclick="handleClick(\'down\',\''.$row["image_text_module_id"].'\', null, \''.$row["_order"].'\')">dolje</button><br/>';
			}
			echo '<button onclick="handleClick(\'save\',\''.$row["image_text_module_id"].'\',\''.$row["_order"].'\',\''.$row["image_path"].'\')">spremi</button></td>';
			


			echo "<td width='20%' height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitle".$row["image_text_module_id"]."' name='inpTitle".$row["image_text_module_id"]."' type='text' value='".$row['title']."'></input><br/><textarea style='width:95%;height:150px' id='txtText".$row["image_text_module_id"]."' name='txtText".$row["image_text_module_id"]."' type='text'>".$row['text']."</textarea></td>";
			
			if($row["is_image"] == "1")
			{
				echo "<td width='20%' height='130' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><img id='imgItem".$row["image_text_module_id"]."' src='../".$row["image_path"]."' height='150' width='200'><br/><input type='hidden' name='MAX_FILE_SIZE' value='10000000' />Izaberite sliku: <input name='uploadedfile" . $row["image_text_module_id"] . "' type='file' /></td>";
			}
			else
			{
				echo "<td width='20%' height='130' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input type='text' id='imgItem".$row["image_text_module_id"]."' value='../".$row["image_path"]."' style='height:150px;width:200'></input><br/></td>";
			}
			
			echo "<td width='55%' height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>";
				create_submodules_editing_template($row["image_text_module_id"]);
			echo "</td>";
			echo "</tr>";
			
			$counter++;
		}
			echo "<tr>";
			echo '<td height="200" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top"><a name="new"></a><button onclick="handleClick(\'new\',\'\',\'\',\'\')">dodaj</button></td>';
			echo "<td height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id= id='inpTitleNew' name='inpTitleNew' type='text'></input></td>";
			echo "<td height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%' id= id='txtTextNew' name='txtTextNew' type='text'></textarea></td>";			
			echo "<td height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input type='hidden' name='MAX_FILE_SIZE' value='10000000' />Izaberite sliku: <input name='uploadedfileNew' type='file' />";
			//echo "<br/>Unesite objekt<input type='text' id='imgItem".$row["image_text_module_id"]."' value='".$row["image_path"]."' style='height:150px;width:200'></input><br/></td>";
			echo "</td>";
			echo "</tr>";
		
		echo "</table></form>";

?>

</body>

</html>
