<?php

// variables


$FName_error = "";
$LName_error = "";
$email_error = "";
$userName_error  = "";
$password_error = "";
$Cpassword_error = "";


include('database_conn.php');

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	header("location: contacts.php");
	exit;
}

if (isset($_POST["register"]))
{
      $FName = trim($_POST['FName']);
      $LName = trim($_POST['LName']);
      $email = trim($_POST['email']);
      $userName = trim($_POST["username"]);
      $password = trim($_POST["password"]);
      $Cpassword = trim($_POST['Cpassword']);

      $sql = "SELECT * FROM register WHERE UserName = :username";

      $stmt = $conn->prepare($sql);
      $data = array(
            ':username' => $userName
      );

      if ($stmt->execute($data))
      {
            if (strlen(trim($_POST["FName"])) > 20 )
            {
                  $FName_error = "First Name must be less than 20 characters";
            }

            if (strlen(trim($_POST["LName"])) > 20 )
            {
                  $LName_error = "Last Name must be less than 20 characters";
            }

            if (empty(trim($_POST["email"])))
            {
                  $email_error = "Enter an Email";
            }
            else
            {
                  $sql2 = "SELECT email FROM register WHERE email = :email";

                  $stmt2 = $conn->prepare($sql2);
                  $data2 = array(
                        ':email' => $email
                  );

                  if ($stmt->execute($data2))
                  {
                        if ($stmt2->rowCount() > 0)
                        {
                              $email_error = "Email is taken";
                        }
                  }
            }

            if ($stmt->rowCount() > 0)
            {
                  $userName_error = "Username is taken";
            }
            else
            {
                  if (empty($userName))
                  {
                        $userName_error = "Enter a Username";
                  }

                  if (empty(trim($_POST["password"]))) {
                        $password_error = "Enter a password";
                  } elseif (strlen(trim($_POST["password"])) < 8) {
                        $password_error = "Password must be at least 8 characters";
                  } elseif (strlen(trim($_POST["password"])) > 20) {
                        $password_error = "Password can be no longer than 20 characters";
                  } else {
                        $password = trim($_POST["password"]);
                  }

                  if (empty($password))
                  {
                        $password_error = "Enter a Password";
                  }
                  else
                  {
                        if ($password != $Cpassword)
                        {
                              $Cpassword_error = "Passwords do not match";
                        }
                  }

                  if (empty($FName_error) && empty($LName_error) && empty($email_error) && empty($userName_error) && empty($password_error) && empty($Cpassword_error))
                  {
                        $data = array(
                              ':firstName' => $FName,
                              ':lastName' => $LName,
                              ':email' => $email,
                              ':username' => $userName,
                              ':password' => password_hash($password, PASSWORD_DEFAULT)
                        );

                        $sql3 = "INSERT INTO register (FirstName, LastName, email, userName, password) VALUES (:firstName, :lastName, :email, :username, :password)";

                        $stmt = $conn->prepare($sql3);
                        if ($stmt->execute($data))
                        {
                              header("location: messengerLogin.php");
                        }
                  }
            }
      }
}

/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (strlen(trim($_POST["FName"])) > 20 )
      {
            $FName_error = "First Name must be less than 20 characters";
      }

      if (strlen(trim($_POST["LName"])) > 20 )
      {
            $LName_error = "Last Name must be less than 20 characters";
      }

      // validate email
      if (empty(trim($_POST["email"])))
      {
            $email_error = "Enter an Email";
      }
      else
      {
            $sql = "SELECT email FROM register WHERE email = ?";

            if ($stmt = $conn->prepare($sql)) {
                  $stmt->bind_param("s", $param_email);
                  $param_email = trim($_POST["email"]);

                  if ($stmt->execute()) {
                        $stmt->store_result();

                        if ($stmt->num_rows == 1) {
                              $email_error = "Email is taken";
                        } else {
                              $email = trim($_POST["email"]);
                        }
                  } else {
                        echo "Unknown Error. Try again later1";
                  }

                  $stmt->close();
            }
      }

      // validate username
      if (empty(trim($_POST["username"])))
      {
            $userName_error = "Enter a Username";
      }
      else
      {
            $sql2 = "SELECT UserName FROM register WHERE UserName = ?";

            if ($stmt = $conn->prepare($sql2)){
                  $stmt->bind_param("s", $param_username);
                  $param_username = trim($_POST["username"]);

                  if ($stmt->execute()) {
                        $stmt->store_result();

                        if ($stmt->num_rows == 1) {
                              $userName_error = "Username is taken";
                        } else {
                              $userName = trim($_POST["username"]);
                        }
                  } else {
                        echo "Unknown Error. Try again later2";
                  }

                  $stmt->close();
            }
      }

      // validate password
      if (empty(trim($_POST["password"]))) {
            $password_error = "Enter a password";
      } elseif (strlen(trim($_POST["password"])) < 8) {
            $password_error = "Password must be at least 8 characters";
      } elseif (strlen(trim($_POST["password"])) > 20) {
            $password_error = "Password can be no longer than 20 characters";
      } else {
            $password = trim($_POST["password"]);
      }

      // validate password confirmation
      if (empty(trim($_POST["Cpassword"]))) {
            $Cpassword_error = "Please confirm password";
      }
      else {
            $Cpassword = trim($_POST["Cpassword"]);
            if (empty($password_error) && ($password != $Cpassword)) {
                  $Cpassword_error = "Passwords do not match";
            }
      }

      if (empty($FName_error) && empty($LName_error) && empty($email_error) && empty($userName_error) && empty($password_error) && empty($Cpassword_error)) {

            $sql = "INSERT INTO register (FirstName, LastName, email, userName, password) values (?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {

                  $stmt -> bind_param("sssss", $param_fname, $param_lname, $param_email, $param_username, $param_password);

                  $param_fname = $FName;
                  $param_lname = $LName;
                  $param_email = $email;
                  $param_username = $userName;
                  $param_password = password_hash($password, PASSWORD_DEFAULT);

                  if ($stmt->execute()) {
                        header("location: messengerLogin.php");
                  } else {
                        echo "Unknown Error. Try again later3";
                  }

                  $stmt->close();
            }
      }

      $conn->close();
}
*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="Projects made by Paul Vicino">
	<meta name="keywords" content="CS projects, resume, messenger, messenger app">
	<meta name="author" content="Paul Vicino">
	<title>Messenger App Registration</title>
	<link rel="stylesheet" href="style.css">

</head>

<body>

      <header>
		<div class="container">
			<div id="brand">
				<h1><span class="highlight">SonicDeveloper</span></h1>
			</div>
			<nav>
				<ul>
					<li><a href="index.html">Home</a></li>
					<li class="current"><a href="projects.html">Projects</a></li>
					<li><a href="about.html">About</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<section id = "loginPage">
		<div class="loginSection">
			<h1>Register Here</h1>

			<form method="post">

                        <div class="form-group <?php echo (!empty($FName_error)) ? 'has-error' : ' '; ?>">
                              <p>First Name</p>
                              <input type="text" name="FName" class = "form-control" placeholder="Enter First Name (Optional)">
                              <span class = "help-block" style = "color:red"> <?php echo $FName_error; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($LName_error)) ? 'has-error' : ' '; ?>">
                              <p>Last Name</p>
                              <input type="text" name="LName" class = "form-control" placeholder="Enter Last Name (Optional)">
                              <span class = "help-block" style = "color:red"> <?php echo $LName_error; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($email_error)) ? 'has-error' : ' '; ?>">
                              <p>Email</p>
                              <input type="email" name="email" class = "form-control" placeholder="Enter Email">
                              <span class = "help-block" style = "color:red"> <?php echo $email_error; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($userName_error)) ? 'has-error' : ' '; ?>">
                              <p>Username</p>
                              <input type="text" name="username" class = "form-control" placeholder="Enter Username">
                              <span class = "help-block" style = "color:red"> <?php echo $userName_error; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($password_error)) ? 'has-error' : ' '; ?>">
                              <p>Password</p>
                              <input type="password" name="password" class = "form-control" placeholder="Enter Password">
                              <span class = "help-block" style = "color:red"> <?php echo $password_error; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($Cpassword_error)) ? 'has-error' : ' '; ?>">
                              <p>Confirm Password</p>
                              <input type="password" name="Cpassword" class = "form-control" placeholder="Confirm Password">
                              <span class = "help-block" style = "color:red"> <?php echo $Cpassword_error; ?></span>
                        </div>

                        <div class="form-group">
                              <input type="submit" name="register" class = "btn btn-primary" value="Register"> <br>
                        </div>

                        <a href="messengerLogin.php">Login</a> <br>
                  </form>

		</div>

	</section>

	<footer>
		<p>Paul Vicino CS Projects, Copyright nonexistant lol</p>
	</footer>

</body>
</html>
