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
	<p>
	<?php
		include("command_handler.php");
		if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != "true")
		{
			echo("Morate biti logirani.<br><a href='../index.php'>Naslovna stranica</a>");
			exit();
		}
		echo("Uspješno ste logirani kao administrator");
	?>
	<p>
	<form id="formFront" action="front.php" method="post">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top" style="width:15%">
				<a href="home.php" target="frame">Početna stranica</a><br/>
				<a href="technical.php" target="frame">Tehnički detalji</a><br/>
				<a href="cv.php" target="frame">Životopis</a><br/>
				<label>Izvan posla</label>
				<ul>
				<li>
					<a href="leisure_text_modules.php" target="frame">tekst</a>
				</li><li>
					<a href="leisure_galleries.php" target="frame">galerije</a>
				</li>
				</ul>
				<a href="prog.php" target="frame">Omiljeni programi</a><br/>
				<a href="link.php" target="frame">Omiljeni linkovi</a><br/>
				<a href="admin_guestbook.php" target="frame">Guestbook</a><br/>
				<a href="admin_hit_counter.php" target="frame">Broj posjeta, anketa, admin prijava</a><br/><br/>
				<button type="submit" name="btnLogout" >Logout</button><br/>
			</td>
			<td valign="top" style="width:90%;">
				<iframe frameborder="0" id="frame" name="frame" src ="home.php" width="100%" height="600">
				</iframe>
			</td>
		</tr>
	</table>
	</form>
</body>

</html>
