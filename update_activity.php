<?php

include('database_conn.php');

session_start();

// updates chat log history to latest activity
$sql = "UPDATE login_activity SET last_activity = now() WHERE login_details_id = '".$_SESSION["login_details_id"]."' ";

$stmt = $conn->prepare($sql);

$stmt->execute();

 ?>
