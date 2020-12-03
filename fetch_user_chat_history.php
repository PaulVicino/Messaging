<?php

include('database_conn.php');

session_start();

echo fetch_user_chat_history($_SESSION['user_id'], $_POST['reciever_id'], $conn);

 ?>
