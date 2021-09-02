<?php

include 'private/session.php';
include 'private/database.php';
include 'private/functions.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = clean($_POST["username"]);
	$password = md5(clean($_POST["password"]));

	$stmt = $db->prepare("SELECT status FROM users WHERE username = ? && password = ?");
	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($status);
		$stmt->fetch();

		if ($status == "active") {
			log_in($username);
		} else {
			$error = "Your account has been suspended";
		}
	} else {
		$error = "Invalid username and password combination";
	}

	$stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Login</title>

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/mdb.min.css">
	
	<style type="text/css">
		body {
			background-image: url('assets/images/background.jpg');
			background-repeat: no-repeat;
			background-size: cover;
		}

		.container {
			width: 30%;
			position: absolute;
			top: 30%;
			right: 15%;
		}

		.card {
			padding: 32px;
		}

		.footer {
			text-align: center;
		}

		.footer p {
			margin: 5px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="content">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
					<div class="form-group">
				    	<input type="text" class="form-control" name="username" value="john" placeholder="username" required>
				  	</div>
				  	
				  	<div class="form-group">
				    	<input type="password" class="form-control" name="password" value="john" placeholder="password" required>
				  	</div>

				  	<div class="footer">	
				  		<button type="submit" class="btn btn-info">Login</button>
				  	</div>
				</form>

				<?php echo $error; ?>				
			</div>
		</div>
	</div>
</body>
</html>
