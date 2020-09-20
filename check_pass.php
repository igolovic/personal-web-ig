<?php
	include("classes.php");

	if( isset($_POST["user"]) && 
		isset($_POST["pass"]) && 
		(strlen($_POST["user"]) <= 20) && 
		(strlen($_POST["pass"]) <= 20) && 
		filter_input(INPUT_POST,"user",FILTER_SANITIZE_STRING) &&
		filter_input(INPUT_POST,"pass",FILTER_SANITIZE_STRING)  )
	{
	
		$conn = new connect();
		$conn->selectDb("hr");
		
		$check_result = $conn->mysqli->query("select * from users where username = '".$conn->mysqli->real_escape_string($_POST["user"])."' and password = '".$conn->mysqli->real_escape_string($_POST["pass"])."' limit 1");
		unset($conn);

		if($row = $check_result->fetch_array())
		{
			session_start();
			$_SESSION["admin"] = "true";
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
?>