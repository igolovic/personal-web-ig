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
					// Delete gallery files
					$filesResult = $conn->mysqli->query("select path from gallery_element where gallery_id = ".$_POST["inpId"]);
					$count = $filesResult->num_rows;
					while($row = $filesResult->fetch_array())
					{
						var_dump($_SERVER['DOCUMENT_ROOT'] ."/".$row["path"]);
						unlink($_SERVER['DOCUMENT_ROOT'] ."/".$row["path"]);
					}
					// Delete gallery folder
					rmdir("../res/gallery".$_POST["inpId"]);

					if($conn->mysqli->query("delete from gallery where gallery_id = ".$_POST["inpId"]) == true)
					{				
						$conn->mysqli->query("update gallery set _order = (_order - 1) where _order > '".$_POST["inpValue"]."'");
						$conn->mysqli->query("delete from gallery_element where gallery_id = ".$_POST["inpId"]);
					}
				break;
				case "up":
					$conn->mysqli->query("update gallery set _order = (_order + 1) where _order = '".($_POST["inpValue"]-1)."'");
					$conn->mysqli->query("update gallery set _order = (_order - 1) where gallery_id = '".$_POST["inpId"]."'");
				break;
				case "down":
					$conn->mysqli->query("update gallery set _order = (_order - 1) where _order = '".($_POST["inpValue"]+1)."'");
					$conn->mysqli->query("update gallery set _order = (_order + 1) where gallery_id = '".$_POST["inpId"]."'");
				break;
				case "save":
					$id = $_POST["inpId"];
					$title = substr($_POST["inpTitle".$id],0,50);
					$text  = substr($_POST["txtText".$id],0,50);
					$conn->mysqli->query("update gallery set title='".$title."', text='".$text."' where gallery_id = '".$id."'");					
				break;
				case "new":
					$id = $_POST["inpId"];
					$title = substr($_POST["inpTitleNew"],0,50);
					$text  = substr($_POST["txtTextNew"],0,50);
					$conn->mysqli->query("insert into gallery(gallery_id, part_id, title, text, path, _order) values(null, 'Leisure', '".$title."', '".$text."', '', ".$conn->mysqli->query("select ifnull(max(_order)+1, 1) as num from gallery")->fetch_array()["num"].")");
					$insertedId = $conn->mysqli->insert_id;
					$conn->mysqli->query("update gallery set path = 'gallery".$insertedId."' where gallery_id = ".$insertedId);
					mkdir("../res/gallery".$insertedId);
				break;
				
				
				
				case "deleteSubmodule":
					unlink("../" . $_POST["inpId2"]);
					$conn->mysqli->query("delete from gallery_element where gallery_element_id = '".$_POST["inpId"]."'");
					$conn->mysqli->query("update gallery_element set _order = (_order - 1) where _order > '".$_POST["inpValue"]."' and gallery_id = '".$_POST["inpId2"]."'");
				break;
				case "upSubmodule":
					$conn->mysqli->query("update gallery_element set _order = (_order + 1) where _order = '".($_POST["inpValue"]-1)."' and gallery_id = '".$_POST["inpId2"]."'");
					$conn->mysqli->query("update gallery_element set _order = (_order - 1) where gallery_element_id = '".$_POST["inpId"]."'");
				break;
				case "downSubmodule":
					$conn->mysqli->query("update gallery_element set _order = (_order - 1) where _order = '".($_POST["inpValue"]+1)."' and gallery_id = '".$_POST["inpId2"]."'");
					$conn->mysqli->query("update gallery_element set _order = (_order + 1) where gallery_element_id = '".$_POST["inpId"]."'");
				break;
				case "saveSubmodule":
					$id = $_POST["inpId"];
					$gallery_id = $_POST["inpId2"];
					$title = substr($_POST["inpTitleSubmodule".$id],0,50);
					$text = substr($_POST["txtTextSubmodule".$id],0,3000);
					$uploaded_file_id = "uploadedfile".$id;
					$path = "";	
					$path_sql_chunk = "";
					
					if($_FILES[$uploaded_file_id]['name'] != "")
					{
						unlink("../" . $_POST["inpValue"]);
						$path = "../res/gallery" . $gallery_id . "/"  . $_FILES[$uploaded_file_id]['name'];
						if(!move_uploaded_file($_FILES[$uploaded_file_id]['tmp_name'], $path)) 
						{
							echo "Greška!";
							return;
						}
						else
						{
							$path_sql_chunk =  ", path = '".$path."'";
							$path_sql_chunk = str_replace("../","",$path_sql_chunk);
							$conn->mysqli->query("update gallery_element set title='".$title."', text = '".$text."' " . $path_sql_chunk . " where gallery_element_id = '".$id."'");	
						}
					}	
				break;
				case "newSubmodule":
					$parentid = $_POST["inpId2"];
					$title = substr($_POST["inpTitleNewSubmodule".$parentid],0,50);
					$text = substr($_POST["txtTextNewSubmodule".$parentid],0,3000);
					
					$uploaded_file_id = "uploadedfileNew".$parentid;			
					$path = "res/gallery" . $parentid . "/"  . $_FILES[$uploaded_file_id]['name'];
					if(!move_uploaded_file($_FILES[$uploaded_file_id]['tmp_name'], "../" . $path)) 
					{
						echo "Greška!";
						return;
					}
					else
					{					
						$conn->mysqli->query("insert into gallery_element(gallery_element_id, gallery_id, _order, title, text, path) values(null, '".$_POST['inpId2']."', ".$conn->mysqli->query("select ifnull(max(_order)+1, 1) as num from gallery_element where gallery_id = ".$_POST['inpId2'])->fetch_array()["num"].", '".$title."', '".$text."', '".$path."')");
					}
				break;
			}
		}
				
		$galleriesResult = $conn->mysqli->query("select * from gallery order by _order");

		echo "<form enctype='multipart/form-data' method='POST' id='formLeisureGalleries'> <input type='hidden' name='inpAction' id='inpAction'>";
		echo "<input type='hidden' name='inpValue' id='inpValue'>";
		echo "<input type='hidden' name='inpId' id='inpId'>";
		echo "<input type='hidden' name='inpId2' id='inpId2'>";

		echo '<a href="leisure_galleries.php#new">nova galerija</a>';

		echo "<table width='100%' cellpading='0' cellspacing='0' class='adminTable'>";
		echo '<tr><td style="border-bottom:1px gray solid;padding-bottom:5px" ></td>
		<td style="border-bottom:1px gray solid;padding-bottom:5px" >title</td>
		<td style="border-bottom:1px gray solid;padding-bottom:5px"></td></tr>';
		$counter = 1;
		$count = $galleriesResult->num_rows;
		while($row = $galleriesResult->fetch_array())
		{
			echo "<tr>";
			echo '<td width="10%" height="200" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top">';
			echo '<button onclick="handleClick(\'delete\',\''.$row["gallery_id"].'\', null, \''.$row["_order"].'\')">obriši</button><br/>';
			if($counter > 1)
			{
				echo '<button onclick="handleClick(\'up\',\''.  $row["gallery_id"].'\', null, \''.$row["_order"].'\')">gore</button><br/>';
			}
			if($counter < $count)
			{
				echo '<button onclick="handleClick(\'down\',\''.$row["gallery_id"].'\', null, \''.$row["_order"].'\')">dolje</button><br/>';
			}
			echo '<button onclick="handleClick(\'save\',\''.$row["gallery_id"].'\', null, \''.$row["_order"].'\')">spremi</button></td>';
			


			echo "<td width='20%' height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitle".$row["gallery_id"]."' name='inpTitle".$row["gallery_id"]."' type='text' value='".$row['title']."'></input><br/><textarea style='width:95%' id='txtText".$row["gallery_id"]."' name='txtText".$row["gallery_id"]."' type='text'>".$row['text']."</textarea></td>";
			echo "<td width='70%' height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'>";


					$cvDataResults[$counter] = $conn->mysqli->query("select * from cv_data where gallery_id = " . $row["gallery_id"] . " order by _order");
					$galleriesElements_result[$counter] = $conn->mysqli->query("select * from gallery_element where gallery_id = " . $row["gallery_id"] . " order by _order");
					$counter2 = 1;
					echo '<table width="100% cellpadding="0" cellspacing="0" style="border:1px gray solid;">';
					while($row2 = $galleriesElements_result[$counter]->fetch_array())
					{
						$count = $galleriesElements_result[$counter]->num_rows;
					
						echo '<tr>';
						
							echo '<td width="10%" height="130" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top">';
							echo '<button onclick="handleClick(\'deleteSubmodule\',\''.$row2["gallery_element_id"].'\',\''.$row2["path"].'\',\''.$row2["_order"].'\')">obriši</button><br/>';
							if($counter2 > 1)
							{
								echo '<button onclick="handleClick(\'upSubmodule\',\''.$row2["gallery_element_id"].'\',\''.$row["gallery_id"].'\',\''.$row2["_order"].'\')">gore</button><br/>';
							}
							if($counter2 < $count)
							{
								echo '<button onclick="handleClick(\'downSubmodule\',\''.$row2["gallery_element_id"].'\',\''.$row["gallery_id"].'\',\''.$row2["_order"].'\')">dolje</button><br/>';
							}
							echo '<button onclick="handleClick(\'saveSubmodule\',\''.$row2["gallery_element_id"].'\',\''.$row["gallery_id"].'\',\''.$row2["path"].'\')">spremi</button></td>';
///////////////////////////////////
							echo "<td width='15%' height='130' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input type='hidden' name='MAX_FILE_SIZE' value='5000000' />Izaberite sliku: <input name='uploadedfile".$row2['gallery_element_id']."' type='file' /><br /><input style='width:95%' id='inpTitleSubmodule".$row2["gallery_element_id"]."' name='inpTitleSubmodule".$row2["gallery_element_id"]."' type='text' value='".$row2['title']."'></input><br/><textarea style='width:95%;height:40px' id='txtTextSubmodule".$row2["gallery_element_id"]."' name='txtTextSubmodule".$row2["gallery_element_id"]."'>".$row2["text"]."</textarea></td>";
							echo "<td width='20%' height='130' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><img id='imgItem".$row2["gallery_element_id"]."' src='../".$row2["path"]."' height='150' width='200'></td>";
						
						echo '</tr>';
						
						$counter2++;
					}
					echo "<tr>";
					echo '<td width="8%" height="150" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top"><button value="gore" onclick="handleClick(\'newSubmodule\',\'\',\''.$row["gallery_id"].'\',\'\')">dodaj</button></td>';
					echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitleNewSubmodule".$row["gallery_id"]."' name='inpTitleNewSubmodule".$row["gallery_id"]."' type='text'></input>	<br/><textarea style='width:95%;height:140px' id='txtTextNewSubmodule".$row["gallery_id"]."' name='txtTextNewSubmodule".$row["gallery_id"]."'></textarea></td>";
					
					echo "<td width='16%' height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input type='hidden' name='MAX_FILE_SIZE' value='5000000' />Izaberite sliku: <input name='uploadedfileNew".$row["gallery_id"]."' type='file' /></td>";
					
					
					echo "</tr>";
					
					echo '</table>';
					
			echo "</td>";
			echo "</tr>";
			
			$counter++;
		}
			echo "<tr>";
			echo '<td width="10%" height="200" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top"><a name="new"></a><button onclick="handleClick(\'new\',\'\',\'\',\'\')">dodaj</button></td>';
			echo "<td width='20%' height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id= id='inpTitleNew' name='inpTitleNew' type='text'></input></td>";
			echo "<td width='20%' height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><textarea style='width:95%' id= id='txtTextNew' name='txtTextNew' type='text'></textarea></td>";			
			echo "<td width='70%' height='200' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'></td>";
			echo "</tr>";
		
		echo "</table></form>";
		unset($conn);


?>

</body>

</html>
