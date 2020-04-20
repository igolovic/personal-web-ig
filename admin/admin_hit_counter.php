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
		// check access
		
		if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != "true")
		{
			echo("Morate biti logirani.");
			exit();
		}
		
		// establish connection
		include("../classes.php");
		$conn = new connect();
		
		if(isset($_POST['deleteHits']))
		{
			$conn->selectDb("hr");
			$conn->mysqli->query("delete from hit_count");
		}
		
		if(isset($_POST['deletePoll']))
		{
			$conn->mysqli->query("delete from grades");
		}

		if(isset($_POST['saveAdmin']))
		{
			$conn->mysqli->query("update users set username = '".$_POST['inpAdminUser']."', password = '".$_POST['inpAdminPass']."' where user_id = '1'");
		}
		
		$hitResult = $conn->mysqli->query("select ip, date, total from hit_count order by date");

		echo "<form method='POST' id='formHitCounter'> <input type='hidden' name='inpAction' id='inpAction'>";
		echo "<input type='hidden' name='inpValue' id='inpValue'>";
		echo "<input type='hidden' name='inpId' id='inpId'>";
		echo "<input type='hidden' name='inpId2' id='inpId2'>";
		
		echo '<button type="submit" name="deletePoll">Obriši anketne rezultate</button>&nbsp;';
		echo '<button type="submit" name="deleteHits">Obriši dnevnik posjeta</button><br/><br/>';
		
		$usersResult = $conn->mysqli->query("select username, password from users");
		$row = $usersResult->fetch_array();
		
		echo '<fieldset><legend>Admin podaci</legend>';
		echo "user <input type='text' name='inpAdminUser' value='".$row["username"]."'></input><br/>";
		echo "pass <input type='text' name='inpAdminPass' value='".$row["password"]."'></input><br/>";
		echo '<button type="submit" name="saveAdmin">Spremi</button>';
		echo '</fieldset><br/>';

		$hitCountResult = $conn->mysqli->query("select count(ip) as total_per_ip, sum(total) as all_requests_from_all_IPs from hit_count");
		$row = $hitCountResult->fetch_array();

		echo '<p><label>Ukupno različitih IP adresa koje su posjetile web-site: '.$row["total_per_ip"].'</label></p>';
		echo '<p><label>Ukupno posjeta ukjučujuči višestruke posjete s iste IP adrese: '.$row["all_requests_from_all_IPs"].'</label></p>';
		echo "<table width='100%' cellpading='0' cellspacing='0' class='adminTable'>";
		echo '<tr><td>date</td><td>IP</td><td>Broj posjeta s IP adrese</td></tr>';

		$counter = 1;
		$count = $hitResult->num_rows;
		while($row = $hitResult->fetch_array())
		{
			echo '<tr><td>'.$row["date"].'</td><td>'.$row["ip"].'</td><td>'.$row["total"].'</td></tr>';
		}		
		
		echo "</table></form>";
		
		unset($conn);
?>

</body>

</html>
