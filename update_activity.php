<?php

include('database_conn.php');

session_start();

$sql = "UPDATE login_activity SET last_activity = now() WHERE login_details_id = '".$_SESSION["login_details_id"]."' ";

$stmt = $conn->prepare($sql);

$stmt->execute();

 ?>
