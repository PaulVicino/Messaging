<?php

session_start();

session_destroy();

header("location: messengerLogin.php");

exit;
 ?>
