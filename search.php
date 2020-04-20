<?php

	include("classes.php");
	session_start();

	$con = new connect();
	$resultsFound = false;

	if(isset($_POST["words"]))
	{			
		$clean = $_POST["words"];
		filter_input(INPUT_POST, $clean, FILTER_SANITIZE_STRING);
		
		$tables = array("short_text_modules", "text_modules", "image_text_modules", "gallery", "text");
		foreach($tables as $table)
		{							
			$words = explode(" ", trim($clean));
			$wordsCopy = $words;				
		
			$query = "select title, text, part_id from " . $table . " where ";
			
			$words2 = array();
			foreach($words as $word)
			{
				$words2[] = "text like '%" . $word . "%' or title like '%" . $word . "%'";
				$wordsIts2[] = "its.text like '%" . $word . "%' or its.title like '%" . $word . "%'";
				$wordsCp2[] = "title like '%" . $word . "%'";
				$wordsCd2[] = "cd.text like '%" . $word . "%' or cd.title like '%" . $word . "%'";
				$wordsC2[] = "comment_author like '%" . $word . "%' or comment_text like '%" . $word . "%'";
			}
			$words = implode(" or ", $words2);
			$wordsIts = implode(" or ", $wordsIts2);
			$wordsCp = implode(" or ", $wordsCp2);
			$wordsCd = implode(" or ", $wordsCd2);
			$wordsC = implode(" or ", $wordsC2);

			$query .= $words;

			foreach($wordsCopy as $word)
			{
				$wordsCopy2[] = "<span class='high'>".$word."</span>";
			}			
			
			$result = mysql_query($query);
			while($row = mysql_fetch_array($result))
			{
				$highlight = str_ireplace($wordsCopy, $wordsCopy2, strip_tags($row["title"])."<br/>".strip_tags($row["text"]));
				if(stristr($highlight, "<span") != false)
				{	
					$resultsFound = true;				
					echo "<div class='sr'>";
					echo "<div class='sr2'>".$highlight."</div>";
					echo "<br /><a class='linkTooltip' style='margin:5px' onclick='openPart( \"".$row["part_id"]."\")'>".($_SESSION["lang"] == "cro" ? "Pokaži rezultat - " : "Show result - ").$row["part_id"]."</a><br /><br />";		
					echo "</div>";	
				}
			}
		}
		
		// image_text_submodules /////////////////////////
		$query = "select its.title, its.text, itm.part_id from image_text_submodules as its inner join image_text_modules as itm on itm.image_text_module_id = its.module where " . $wordsIts;
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result))
		{			
			$highlight = str_ireplace($wordsCopy, $wordsCopy2, strip_tags($row["title"])."<br/>".strip_tags($row["text"]));
			if(stristr($highlight, "<span") != false)
			{	
				$resultsFound = true;
				echo "<div class='sr'>";
				echo "<div class='sr2'>".$highlight."</div>";
				echo "<br /><a class='linkTooltip' style='margin:5px' onclick='openPart(\"".$row["part_id"]."\")'>".($_SESSION["lang"] == "cro" ? "Pokaži rezultat - " : "Show result - ").$row["part_id"]."</a><br /><br />";		
				echo "</div>";
			}
		}	
		/////////////////////////////////////////////////////	
		
		// cv_parts ////////////////////////////
		$query = "select title, part_id from cv_parts where " . $wordsCp;
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result))
		{
			$highlight = str_ireplace($wordsCopy, $wordsCopy2, strip_tags($row["title"])."<br/>");
			if(stristr($highlight, "<span") != false)
			{				
				$resultsFound = true;
				echo "<div class='sr'>";
				echo "<div class='sr2'>".$highlight."</div>";
				echo "<br /><a class='linkTooltip' style='margin:5px' onclick='openPart(\"".$row["part_id"]."\")'>".($_SESSION["lang"] == "cro" ? "Pokaži rezultat - " : "Show result - ").$row["part_id"]."</a><br /><br />";		
				echo "</div>";
			}
		}	
		/////////////////////////////////////////////////////	
		
		// cv_data ////////////////////////////
		$query = "select cd.title, cd.text, cp.part_id from cv_data as cd inner join cv_parts as cp on cd.cv_part_id = cp.cv_part_id where " . $wordsCd;
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result))
		{
			$highlight = str_ireplace($wordsCopy, $wordsCopy2, strip_tags($row["title"])."<br/>".strip_tags($row["text"]));				
			if(stristr($highlight, "<span") != false)
			{				
				$resultsFound = true;
				echo "<div class='sr'>";
				echo "<div class='sr2'>".$highlight."</div>";
				echo "<br /><a class='linkTooltip' style='margin:5px' onclick='openPart(\"".$row["part_id"]."\")'>".($_SESSION["lang"] == "cro" ? "Pokaži rezultat - " : "Show result - ").$row["part_id"]."</a><br /><br />";		
				echo "</div>";
			}
		}	
		/////////////////////////////////////////////////////	
					
		// comments ////////////////////////////
		$query = "select comment_author, comment_text, part_id from comments where " . $wordsC;
		
		$con->selectDb("hr");
		$result = mysql_query($query);
		echo mysql_error();
		
		while($row = mysql_fetch_array($result))
		{
			$highlight = str_ireplace($wordsCopy, $wordsCopy2, $row["comment_author"]."<br/>".strip_tags($row["comment_text"]));
			if(stristr($highlight, "<span") != false)
			{
				$resultsFound = true;
				echo "<div class='sr'>";
				echo "<div class='sr2'>".$highlight."</div>";
				echo "<br /><a class='linkTooltip' style='margin:5px' onclick='openPart(\"".$row["part_id"]."\")'>".($_SESSION["lang"] == "cro" ? "Pokaži rezultat - " : "Show result - ").$row["part_id"]."</a><br /><br />";		
				echo "</div>";
			}
		}	
		/////////////////////////////////////////////////////	

		if(!$resultsFound)
		{
			echo ($_SESSION["lang"] == "cro" ? "Nije pronađen nijedan rezultat<br /><br />" : "No results found<br /><br />");
		}
	}		
	unset($con);

?>