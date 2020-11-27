<?php

include('database_conn.php');

session_start();

$data = array(
      ':to_user_id' => $_POST['to_user_id'],
      ':from_user_id' => $_SESSION['user_id'],
      ':message' => $_POST['message']
);

// updates the mysql message database every time a message is sent

$sql = "INSERT INTO message (message, from_user_id, to_user_id) VALUES (:message, :from_user_id, :to_user_id)";

$stmt = $conn->prepare($sql);

if ($stmt->execute($data))
{
      echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $conn);
}

 ?>
