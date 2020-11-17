<?php

include('database_conn.php');

// make sure connected to database
session_start();

// can be changed to load contacts instead of all users
$sql = "SELECT * FROM register WHERE user_id != ' ".$_SESSION['user_id']." ' ";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

$output = '
<table class = "table table-bordered">
      <tr>
            <td>Username</td>
            <td>Name</td>
            <td>Action</td>
      </tr>
';

foreach($result as $row)
{
      $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
      $current_timestamp = date('Y-m-d H:i:s' , $current_timestamp);
      $user_last_activity = fetch_user_last_activity($row['user_id'], $conn);
      $output .= '
      <tr>
            <td> '.$row['UserName']. '</td>
            <td> '.$row['FirstName'].'  '.$row['LastName'].'</td>
            <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['UserName'].'">Message</button></td>
      </tr>
      ';
}

$output .= '</table>';

echo $output;

 ?>
