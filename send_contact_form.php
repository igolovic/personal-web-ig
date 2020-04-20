<?php

if(isset($_POST["author"]) && isset($_POST["comment"]) && isset($_POST["mail"]) && isset($_POST["lang"]))
{
	mail("dummy@dummy.dummy", 	"New message", $_POST["author"]." <".$_POST["mail"]."> wrote:\r\n".substr($_POST["comment"], 0, 700));
	echo $_POST["lang"];
}

?>
