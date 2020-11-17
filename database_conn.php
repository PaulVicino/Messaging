<?php

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "messaging_systems";

// $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

$conn = new PDO("mysql:host=localhost;dbname=messaging_systems", "root", "");

date_default_timezone_set('America/New_York');

function fetch_user_last_activity($user_id, $conn)
{
      $sql = "SELECT * FROM login_activity WHERE user_id = '$user_id' ORDER BY last_activity DESC LIMIT 1";

      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();

      foreach($result as $row)
      {
            return $row['last_activity'];
      }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $conn)
{
      $sql2 = "SELECT * FROM message WHERE (from_user_id = ' ".$from_user_id." ' AND to_user_id = ' ".$to_user_id." ')
                        OR (from_user_id = ' ".$to_user_id." ' AND to_user_id = ' ".$from_user_id." ') ORDER BY timestamp ASC";

      $stmt = $conn->prepare($sql2);
      $stmt->execute();
      $result = $stmt->fetchAll();

      $output = '<ul class="list-unstyled">';

      foreach($result as $row)
      {
            $username = '';
            if ($row["from_user_id"] == $from_user_id)
            {
                  $username = '<b class= "text-success">You</b>' ;
            }
            else
            {
                  $username = '<b class="text-danger">' .get_user_name($row['from_user_id'], $conn). '</b>';
            }
            $output .= '
            <li style="border-bottom: 1px dotted #ccc">
                  <p> '.$username.' - '.$row["message"].'
                        <div align="right">
                              - <small><em> '.$row['timestamp'].' </em></small>
                        </div>
                  </p>
            </li>
            ';
      }
      $output .= '</ul>';
      return $output;
}

function get_user_name($user_id, $conn)
{
      $sql3 = "SELECT UserName FROM register WHERE user_id = '$user_id' ";

      $stmt = $conn->prepare($sql3);
      $stmt->execute();
      $result = $stmt->fetchAll();

      foreach($result as $row)
      {
            return $row['UserName'];
      }
}

 ?>
