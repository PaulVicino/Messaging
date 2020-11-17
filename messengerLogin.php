<?php

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	header("location: contacts.php");
	exit;
}

$userName = "";
$password = "";

$userName_error  = "";
$password_error = "";

include('database_conn.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// check if both username and email are empty, at least 1 must be filled
	if (empty(trim($_POST["username"]))) {
		$userName_error = "Enter a Username";
	} else {
		$userName = trim($_POST["username"]);
	}

	// check if password is empty
	if (empty(trim($_POST["password"]))) {
		$password_error = "Enter a password";
	} else {
		$password = trim($_POST["password"]);
	}

	if (empty($userName_error) && empty($password_error)) {

		$sql = "SELECT * FROM register WHERE UserName = :username";


		$stmt = $conn->prepare($sql);
		$stmt->execute(
			array(
				':username' => $_POST["username"]
			)
		);
		$count = $stmt->rowCount();
		if($count > 0)
		{
			$result = $stmt->fetchAll();
			foreach ($result as $row)
			{
				if (password_verify($password, $row['Password']))
				{
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['username'] = $row['UserName'];
					$sub_sql = "INSERT INTO login_activity (user_id) VALUES ('".$row['user_id']."')";
					$stmt = $conn->prepare($sub_sql);
					$stmt->execute();
					$_SESSION['login_details_id'] = $conn->lastInsertId();
					header("location: contacts.php");
				}
				else
				{
					$password_error = "Incorrect Password";
				}
			}
		}
		else
		{
			$userName_error = "Username does not exist";
		}
/*
		if ($stmt = $conn->prepare($sql)) {
			$stmt->bind_param("s", $param_username);
			$param_username = $userName;

			if ($stmt->execute()) {
				$stmt->store_result();

				if ($stmt->num_rows == 1) {
					$stmt->bind_result($userName, $hashed_password);

					if ($stmt->fetch()) {
						if (password_verify($password, $hashed_password)) {
							session_start();

							$_SESSION['loggedin'] = true;
							$_SESSION['user_id'] = $row['id'];
							$_SESSION['username'] = $param_username;

							$sub_sql = "INSERT INTO login_activity (id) VALUES (' ".$row['id']. " ')";
							$stmt = $conn->prepare($sub_sql);
							$stmt->execute();
							$_SESSION['login_details_id'] = $conn->lastInsertId();

							header("location: contacts.php");
						} else {
							$password_error = "Incorrect Password";
						}
					}
				} else {
					$userName_error = "Username does not exist";
				}
			} else {
				echo "Unknown Error. Try again later4";
			}

			$stmt->close();
		}
		*/
	}
}

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
	<title>Messenger App Login</title>
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
			<h1>Login Here</h1>

			<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">

				<div class="form-group <?php echo (!empty($userName_error)) ? 'has-error' : ' '; ?>">
					<p>Username</p>
					<input type="text" name="username" class = "form-control" placeholder="Enter Username" value = "<?php echo $userName; ?>">
					<span class = "help-block" style = "color:red"><?php echo $userName_error; ?></span>
				</div>

				<div class="form-group <?php echo (!empty($password_error)) ? 'has-error' : ' '; ?>">
					<p>Password</p>
					<input type="password" name="password" class = "form-control" placeholder="Enter Password" value = "<?php echo $password; ?>">
					<span class = "help-block" style = "color:red"><?php echo $password_error; ?></span>
				</div>

				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Login"> <br>
				</div>

				<a href="messengerRegister.php">Register</a> <br>

			</form>
		</div>

	</section>

	<footer>
		<p>Paul Vicino CS Projects, Copyright nonexistant lol</p>
	</footer>

</body>
</html>
