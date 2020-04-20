<?php

	$conn = new connect();
	$conn->mysqli->query("insert into hit_count(ip, date, total) values ('".$_SERVER['REMOTE_ADDR']."', NOW(), 1) on duplicate key update total = total + 1, date = NOW()");
	
	$newsResult = $conn->mysqli->query("select * from news");	
	unset($conn);
	
	echo "<script type='text/javascript'>window.onresize=function(){ini.calc();};window.onload=function(){typing();_browser();revolve();ini=new initialPos();ini.calc();";
	if(isset($_GET['cv']))
	{
		echo "setMenu('MyData');showPart('MyData');};";
	}
	elseif($cookieFound)
	{
		echo "setMenu('".$_COOKIE['pref']."');showPart('".$_COOKIE['pref']."');};";	
	}
	else
	{
		echo "setMenu('Homepage');showPart('Homepage');};";	
	}
	
	if(isset($_POST['sSkin']))
	{
		$selectedSkin = $_POST['sSkin'];
		$_SESSION['skin'] = $selectedSkin;
	}
	else
	{
		if(isset($_SESSION['skin']))
		{
			$selectedSkin = $_SESSION['skin'];
		}
		else
		{
			$selectedSkin = "skin2";
		}
	}
	
	switch($selectedSkin)
	{
		case "skin1": echo " skin='skin1';</script><link rel=\"stylesheet\" type=\"text/css\" href=\"skin1.css\" />";
		break;
		case "skin2": echo " skin='skin2';</script><link rel=\"stylesheet\" type=\"text/css\" href=\"skin2.css\" />";
		break;
	}

?>