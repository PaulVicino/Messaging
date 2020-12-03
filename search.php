<?php

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "messaging_systems";

$connn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// function for search bar functionality

// Check connection
if($connn === false){
    die("Connection Error" . $connn->connect_error);
}

if(isset($_REQUEST["search"])){
    $sql = "SELECT * FROM register WHERE UserName LIKE ?";

    if($stmt = $connn->prepare($sql)){
        $stmt->bind_param("s", $param_term);

        $param_term = $_REQUEST["search"] . '%';

        if($stmt->execute()){
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    echo "<p>" . $row["UserName"] . "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } 
    }
    $stmt->close();
}
$connn->close();
 ?>
