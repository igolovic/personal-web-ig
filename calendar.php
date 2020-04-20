<?php
	include("classes.php");

	if(!isset($_SESSION))
	{
		session_start();
	}

	if(isset($_POST["month"]))
	{
		$month = $_POST["month"];
	}
	else
	{
		$month = date("n");
	}
	$year = date("Y");
	
	$divData = "";
	
	///////// current month
	$todayDay = date("j");
	$todayMonth = date("n");
	///////////////////////
	
	///////// previous month
	$beforeTimestamp = mktime(1,1,1,$month-1,1,$year);
	$beforeDaysCount = date("t",$beforeTimestamp);
	////////////////////
	
	$timestamp = mktime(1,1,1,$month,1,$year);
	$daysCount = date("t",$timestamp);
	$labelToday = "Današnji datum";
	
	if(!isset($_SESSION['lang']) || $_SESSION['lang'] == "cro")
	{
		setlocale(LC_ALL,'croatian');
	    $localMonth = strftime("%B", $timestamp);
		$localMonth = iconv('ISO-8859-2', 'UTF-8', $localMonth);
		$trDays = "<tr class='cal calRow' style='height:25px;font-weight:bold'><td class='cal'>Po</td><td class='cal'>Ut</td><td class='cal'>Sr</td><td class='cal'>Če</td><td class='cal'>Pe</td><td class='cal'>Su</td><td class='cal'>Ne</td></tr>";
		
	} else if($_SESSION['lang'] == "eng")
	{
	    $localMonth = date("F", $timestamp); 
		$trDays = "<tr class='cal calRow' style='height:25px;font-weight:bold'><td class='cal'>Mo</td><td class='cal'>Tu</td><td class='cal'>We</td><td class='cal'>Th</td><td class='cal'>Fr</td><td class='cal'>Sa</td><td class='cal'>Su</td></tr>";
		$labelToday = "Current date";
	}
	
	if(isset($_POST['lang']) && $_POST['lang'] == "eng")
	{
	    $localMonth = date("F", $timestamp); 
		$trDays = "<tr class='cal calRow' style='height:25px;font-weight:bold'><td class='cal'>Mo</td><td class='cal'>Tu</td><td class='cal'>We</td><td class='cal'>Th</td><td class='cal'>Fr</td><td class='cal'>Sa</td><td class='cal'>Su</td></tr>";
		$labelToday = "Current date";
	}


	$dayInWeek = (date("w", $timestamp) == "0" ? 7 : date("w", $timestamp));

	$beforeCount = $dayInWeek - 1;
	$beforeDaysCount -= $beforeCount - 1;
	
	$daysCounter = 1;
	$beforeCounter = 1;
	
	/////////////////// get dates
	$conn = new connect();
	$result = $conn->mysqli->query("select date,text from calendar_dates order by date");
	$datesArray = array();
	while($row = $result->fetch_array())
	{
		$array = date_parse($row["date"]);
		$datesArray[$array["day"] ." ". $array["month"]] = $row["text"];
	}
	/////////////////////////////
	
	echo '<table style="width:100%" cellspacing="0" cellpadding="0" >';	
	echo "<tr style='height:25px' class='calRow'><td><img alt='' onclick='sendAjaxCalendar(\"-\")' style='cursor:pointer' src='res/calleft.gif' /></td><td class='cal' style='font-size:12px; width:112px' colspan='5'>".$localMonth."</td><td><img alt='' onclick='sendAjaxCalendar(\"+\")' style='cursor:pointer' src='res/calright.gif' /></td></tr>";
	echo $trDays;
	echo "<tr class='calRow'>";
	for($i=1; $i<=7; $i++)
	{
		if($i<=$beforeCount)
		{
			echo "<td class='cal oth'>".$beforeDaysCount."</td>";
			$beforeDaysCount++;
		}
		else
		{
			if($daysCounter == $todayDay && $month == $todayMonth)
			{
				echo "<td onmousemove='moveFollower2(event)' onmouseover='gotMouse2(\"CalToday\")' onmouseout='lostMouse2(\"CalToday\")' id='CalToday' class='cal now'>".$daysCounter."</td>";
				$divData .= '<div class="tooltipDiv" id="divCalToday">';
				$divData .= "<div class='smallTip'>" .$todayDay. ". ". $todayMonth .".</div><br /><br />". $labelToday;
				$divData .= '</div>';
			}
			else
			{
				if(isset($datesArray[$daysCounter ." ". $month]))
				{
					echo "<td class='cal hol' id='Cal" .$daysCounter ."_". $month. "' onmousemove='moveFollower2(event)' onmouseover='gotMouse2(\"Cal".$daysCounter ."_". $month."\")' onmouseout='lostMouse2(\"Cal".$daysCounter ."_". $month."\")'>".$daysCounter."</td>";
					$divData .= '<div class="tooltipDiv" id="divCal' .$daysCounter ."_". $month. '">';
					$divData .= "<div class='smallTip'>" .$daysCounter. ". ". $month .".</div><br /><br />". $datesArray[$daysCounter ." ". $month];
					$divData .= '</div>';
				}
				else
				{
					echo "<td class='cal'>".$daysCounter."</td>";
				}			
			}
			$daysCounter++;
		}
	}
	echo "</tr>";

	$remainder = 1;
	do{
		echo "<tr class='calRow'>";
		for($i=1; $i<=7; $i++)
		{
			if($daysCounter <= $daysCount)
			{
				if($daysCounter == $todayDay && $month == $todayMonth)
				{
					echo "<td onmousemove='moveFollower2(event)' onmouseover='gotMouse2(\"CalToday\")' onmouseout='lostMouse2(\"CalToday\")' id='CalToday' class='cal now'>".$daysCounter."</td>";
					$divData .= '<div class="tooltipDiv" id="divCalToday">';
					$divData .= "<div class='smallTip'>" .$todayDay. ". ". $todayMonth .".</div><br /><br />". $labelToday;
					$divData .= '</div>';
				}
				else
				{
					if(isset($datesArray[$daysCounter ." ". $month]))
					{
						echo "<td class='cal hol' id='Cal" .$daysCounter ."_". $month. "' onmousemove='moveFollower2(event)' onmouseover='gotMouse2(\"Cal".$daysCounter ."_". $month."\")' onmouseout='lostMouse2(\"Cal".$daysCounter ."_". $month."\")'>".$daysCounter."</td>";
						$divData .= '<div class="tooltipDiv" id="divCal' .$daysCounter ."_". $month. '">';
						$divData .= "<div class='smallTip'>" .$daysCounter. ". ". $month .".</div><br /><br />". $datesArray[$daysCounter ." ". $month];
						$divData .= '</div>';
					}
					else
					{
						echo "<td class='cal'>".$daysCounter."</td>";
					}	
				}
				$daysCounter++;
			}
			else
			{
				echo "<td class='cal oth'>".$remainder."</td>";
				$remainder++;
			}
		}
		echo "</tr>";
	}while($daysCounter <= $daysCount);
	
	echo "</table>";
	
	outputDivData();
	
	unset($conn);

function outputDivData()
{
	global $divData;
	echo "$divData";
}

?>
