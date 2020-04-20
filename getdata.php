<?php

$conn = new connect();
add_hit();
$newsResult = $conn->mysqli->query("select * from news");
unset($conn);

?>