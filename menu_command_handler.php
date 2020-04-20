<?php

if(isset($_GET["command"]))
{
	include("language.php");
	include("gallery.php");

	$conn = new connect();
	if(isset($_GET['lang']) && $_GET['lang'] == "eng")
	{
		$conn->selectDb('en');
	}
	else
	{
		$conn->selectDb("hr"); 
	}

	switch($_GET["command"])
	{
		case "Homepage":

			include("text_module.php");
			$resultHomepage = $conn->mysqli->query("select text from text where part_id = 'Homepage'");
			$resultHomepageArray = $resultHomepage->fetch_array();
			echo $resultHomepageArray["text"] . "<br/><br/>";
			$textModulesResult = $conn->mysqli->query("select * from text_modules where part_id = 'Homepage' order by _order");
			outputTextModules($textModulesResult); 
		break;
		case "Technical":

			include("short_text_module.php"); 
			$resultTechnical = $conn->mysqli->query("select text from text where part_id = 'Technical'");
			$text = $resultTechnical->fetch_array();
			echo $text["text"] . "<br/><br/>";
			$leftShortTextModulesResult = $conn->mysqli->query("select * from short_text_modules where part_id = 'Technical' and position = 0 order by _order");
			$rightShortTextModulesResult = $conn->mysqli->query("select * from short_text_modules where part_id = 'Technical' and position = 1 order by _order");
			outputShortTextModules($leftShortTextModulesResult, $rightShortTextModulesResult); 
		break;
		case "MyData":

			include("table.php");
			$cvPartsResult = $conn->mysqli->query("select * from cv_parts order by _order");
			$counter = 0;
			$rownum = $cvPartsResult->num_rows;
			while($counter < $rownum)
			{
				$row = $cvPartsResult->fetch_array();
				$cvDataResults[$counter] = $conn->mysqli->query("select * from cv_data where cv_part_id = " . $row["cv_part_id"] . " order by _order");
				$counter++;
			}

			$text = $conn->mysqli->query("select text from text where part_id = 'MyData'")->fetch_array();
			echo $text["text"] . "<br/><br/>";
			if($counter > 0)
			{
				outputTable($cvPartsResult, $cvDataResults);
			}
		break;
		case "Leisure":

			include("text_module.php");
			$leisureTextModulesResult = $conn->mysqli->query("select * from text_modules where part_id = 'Leisure' order by _order");			
			$galleriesResult = $conn->mysqli->query("select * from gallery order by _order");
			
			$text = $conn->mysqli->query("select text from text where part_id = 'Leisure'")->fetch_array();			
			
			$conn->selectDb("hr");
			$counter = 0;

			echo $text["text"] . "<br/><br/>";
			while($row = $galleriesResult->fetch_array())
			{
				$galleryObjects[$counter] = new galleryObject();
				$galleryObjects[$counter]->addName($row["title"]); 
			
				$galleriesElements[$counter] = $conn->mysqli->query("select * from gallery_element where gallery_id = " . $row["gallery_id"] . " order by _order");
				
				$counter2 = 0;
				while($row2 = $galleriesElements[$counter]->fetch_array())
				{
					$galleryObjects[$counter]->addElement($row2["path"]);
				}
				$counter++;	
			}
			outputTextModules($leisureTextModulesResult);
			$counter = 0;
			$js_code = "&&";
			while(isset($galleryObjects[$counter]))
			{
				$js_code .= gallery($galleryObjects[$counter], $counter);
				$counter++;
			}
			echo $js_code;
		break;
		case "FavProgram":

			$favprogsResult = $conn->mysqli->query("select * from image_text_modules where part_id = 'FavProgram' order by _order");
			$counter = 0;
			$rownum = $favprogsResult->num_rows;
			while($counter < $rownum)
			{
				$row = $favprogsResult->fetch_array();
				$favprogs_submodules[$counter][0] = $conn->mysqli->query("select * from image_text_submodules where module = " . $row["image_text_module_id"] . " and position = 0 order by _order");
				$favprogs_submodules[$counter][1] = $conn->mysqli->query("select * from image_text_submodules where module = " . $row["image_text_module_id"] . " and position = 1 order by _order");
				$counter++;
			}

			$text = $conn->mysqli->query("select text from text where part_id = 'FavProgram'")->fetch_array();
			echo $text["text"] . "<br/><br/>";
			include("image_text_module.php");
			if($counter > 0)
			{
				outputImageTextModules($favprogsResult, $favprogs_submodules); 
			}
		break;
		case "FavLinks":

			$favlinksResult = $conn->mysqli->query("select * from image_text_modules where part_id = 'favlinks' order by _order");
			$counter = 0;
			$rownum = $favlinksResult->num_rows;
			while($counter < $rownum)
			{
				$row = $favlinksResult->fetch_array();
				$favlinksSubmodules[$counter][0] = $conn->mysqli->query("select * from image_text_submodules where module = " . $row["image_text_module_id"] . " and position = 0 order by _order");
				$favlinksSubmodules[$counter][1] = $conn->mysqli->query("select * from image_text_submodules where module = " . $row["image_text_module_id"] . " and position = 1 order by _order");
				$counter++;
			}

			$text = $conn->mysqli->query("select text from text where part_id = 'FavLinks'")->fetch_array();
			echo $text["text"] . "<br/><br/>";
			include("image_text_module.php");
			if($counter > 0)
			{
				outputImageTextModules($favlinksResult, $favlinksSubmodules); 
			}
		break;
		case "Guestbook":

			$text = $conn->mysqli->query("select text from text where part_id = 'Guestbook'")->fetch_array();
			echo $text["text"] . "<br/><br/>";
			unset($conn);
			include("guestbook.php");
		break;
		case "Cf":

			$text = $conn->mysqli->query("select text from text where part_id = 'Cf'")->fetch_array();
			echo $text["text"] . "<br/><br/>";
			unset($conn);
			include("contact_form.php");
		break;
	}
	unset($conn);
}

?>