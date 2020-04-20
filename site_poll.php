<?php

	include("classes.php");
	
	$conn = new connect();
	$conn->selectDb("hr");
	
	if(isset($_POST['grade']) && ($_POST['grade'] == "1" || $_POST['grade'] == "2" || $_POST['grade'] == "3" || $_POST['grade'] == "4" || $_POST['grade'] == "5"))
	{
		$conn->mysqli->query("insert into grades values(null,'".$_POST['grade']."','".$_SERVER['REMOTE_ADDR']."')");
	}
	
	$avgResult = $conn->mysqli->query("select round((select avg(grade) from grades), 1),(select count(*) from grades)");
	unset($conn);
	
	$avg2 = $avgResult->fetch_array();
	$votesCount = $avg2[1];
	$avg = $avg2[0];
	$floor = floor($avg);
	$mod = $avg - $floor;
	
	for($i=1; $i<=$floor; $i++)
	{
		echo '<img alt="" id="imgStar2'.$i.'" style="cursor:pointer" src="res/star2.png" />';				
	}
	
	if($mod != 0)
	{
		if($mod <= 0.5)
		{
			echo '<img alt="" id="imgStar2'.$i.'" style="cursor:pointer" src="res/star1.png" />';
			$i++;				
		}
		else
		{
			echo '<img alt="" id="imgStar2'.$i.'" style="cursor:pointer" src="res/star2.png" />';
			$i++;					
		}
	}
	
	for($j = $i; $j<=5; $j++)
	{
		echo '<img alt="" id="imgStar2'.$j.'" style="cursor:pointer" src="res/star0.png" />';				
	}
	
	echo '<span id="additional" style="display:none">|' . $votesCount . '|' . $avg . '|</span>';

?>