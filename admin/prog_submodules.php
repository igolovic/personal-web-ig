<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Administrativno sučelje</title>
<script type="text/javascript" src="js/admin_common.js"></script><link rel="stylesheet" type="text/css" href="admin.css"></script>
</head>

<body>
<?php 	
function create_submodules_editing_template($module_id)
{
		// Check access
		// SESSION ALREADY STARTED IN link.php!
		if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != "true")
		{
			echo("Morate biti logirani.");
			exit();
		}
		
		// establish connection
		$conn = new connect();

		$left_image_text_submodules_result = $conn->mysqli->query("select * from image_text_submodules where module = '".$module_id."' and position = 0 order by _order");
		$right_image_text_submodules_result = $conn->mysqli->query("select * from image_text_submodules where module = '".$module_id."' and position = 1 order by _order");

		unset($conn);

		echo "<table width='100%' cellpading='10' cellspacing='10'><tr><td valign='top'>";
		// left
		
		// echo "<form method='POST' id='formTechnical'>";

		echo "<table width='100%' cellpading='0' cellspacing='0' class='adminTable'>";
		echo '<tr><td style="border-bottom:1px gray solid;padding-bottom:5px" ></td><td style="border-bottom:1px gray solid;padding-bottom:5px" ></td></tr>';
		$counter = 1;
		$count = $left_image_text_submodules_result->num_rows;
		while($row = $left_image_text_submodules_result->fetch_array())
		{
			echo "<tr>";
			echo '<td width="20%" height="100" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top">';
			echo '<button onclick="handleClick(\'deleteL\',\''.$row["image_text_submodule_id"].'\',\''.$row["module"].'\',\''.$row["_order"].'\')">obriši</button><br/>';
			if($counter > 1)
			{
				echo '<button onclick="handleClick(\'upL\',\''.$row["image_text_submodule_id"].'\',\''.$row["module"].'\',\''.$row["_order"].'\')">gore</button><br/>';
			}
			if($counter < $count)
			{
				echo '<button onclick="handleClick(\'downL\',\''.$row["image_text_submodule_id"].'\',\''.$row["module"].'\',\''.$row["_order"].'\')">dolje</button><br/>';
			}
			echo '<button onclick="handleClick(\'saveL\',\''.$row["image_text_submodule_id"].'\',\''.$row["module"].'\',\''.$row["_order"].'\')">spremi</button></td>';
			
			echo "<td width='80%' height='100' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitleL".$row["image_text_submodule_id"]."' name='inpTitleL".$row["image_text_submodule_id"]."' type='text' value='".$row['title']."'></input><br/><textarea style='width:95%;height:140px' id='txtTextL".$row["image_text_submodule_id"]."' name='txtTextL".$row["image_text_submodule_id"]."'>".$row["text"]."</textarea></td>";
			echo "</tr>";
			
			$counter++;
		}
		
			echo "<tr>";
			echo '<td width="8%" height="100" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top"><button value="gore" onclick="handleClick(\'newL\',\''.$module_id.'\',\'\',\'\')">dodaj</button></td>';
			echo "<td width='16%' height='100' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id= id='inpTitleNewL' name='inpTitleNewL".$module_id."' type='text' value='".$row['title']."'></input><br/><textarea style='width:95%;height:140px' id='txtTextNewL' name='txtTextNewL".$module_id."'>".$row["text"]."</textarea></td>";
			echo "</tr>";
		
		echo "</table></td>";
		
		// right
		echo "<td valign='top'><table width='100%' cellpading='0' cellspacing='0' class='adminTable'>";
		echo '<tr><td style="border-bottom:1px gray solid;padding-bottom:5px" ></td><td style="border-bottom:1px gray solid;padding-bottom:5px" ></td></tr>';
		$counter = 1;
		$count = $right_image_text_submodules_result->num_rows;
		while($row = $right_image_text_submodules_result->fetch_array())
		{
			echo "<tr>";
			echo '<td width="20%" height="100" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top">';
			echo '<button onclick="handleClick(\'deleteR\',\''.$row["image_text_submodule_id"].'\',\''.$row["module"].'\',\''.$row["_order"].'\')">obriši</button><br/>';
			if($counter > 1)
			{
				echo '<button onclick="handleClick(\'upR\',\''.$row["image_text_submodule_id"].'\',\''.$row["module"].'\',\''.$row["_order"].'\')">gore</button><br/>';
			}
			if($counter < $count)
			{
				echo '<button onclick="handleClick(\'downR\',\''.$row["image_text_submodule_id"].'\',\''.$row["module"].'\',\''.$row["_order"].'\')">dolje</button><br/>';
			}
			echo '<button onclick="handleClick(\'saveR\',\''.$row["image_text_submodule_id"].'\',\''.$row["module"].'\',\''.$row["_order"].'\')">spremi</button></td>';


			echo "<td width='80%' height='100' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id='inpTitleR".$row["image_text_submodule_id"]."' name='inpTitleR".$row["image_text_submodule_id"]."' type='text' value='".$row['title']."'></input><br/><textarea style='width:95%;height:140px' id='txtTextR".$row["image_text_submodule_id"]."' name='txtTextR".$row["image_text_submodule_id"]."'>".$row["text"]."</textarea></td>";
			echo "</tr>";
			
			$counter++;
		}
		
			echo "<tr>";
			echo '<td height="150" style="border-bottom:1px gray solid;padding-bottom:5px" valign="top"><button value="gore" onclick="handleClick(\'newR\',\''.$module_id.'\',\'\',\'\')">dodaj</button></td>';
			echo "<td height='150' style='border-bottom:1px gray solid;padding-bottom:5px' valign='top'><input style='width:95%' id= id='inpTitleNewR".$module_id."' name='inpTitleNewR".$module_id."' type='text' value='".$row['title']."'></input><br/><textarea style='width:95%;height:140px' id='txtTextNewR".$module_id."' name='txtTextNewR".$module_id."'>".$row["text"]."</textarea></td>";
			echo "</tr>";
		
		echo "</table>";
		// echo "</form>";
		echo "</tr></td></table>";
}
?>

</body>

</html>
