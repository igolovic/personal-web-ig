<?php
		// SESSION MUST BE ALREADY STARTED FROM front.php!
		
		if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != "true")
		{
			echo("Morate biti logirani.");
			echo '<br><a href="../index.php">Naslovna stranica</a>';
			exit();
		}

		if(isset($_POST['btnLogout']))
		{
				unset($_SESSION['admin']);
		}
?>