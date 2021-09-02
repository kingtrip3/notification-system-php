<?php

include 'private/session.php';

if (logged_in()) {
	header("Location: dashboard.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Home</title>

	<link rel="stylesheet" type="text/css" href="assets/css/mdb.min.css">

	<style type="text/css">
		body {
			background-image: url('assets/images/background.jpg');
			background-repeat: no-repeat;
			background-size: cover;
			text-align: center;
			color: white;
		}

		h1 {
			margin-top: 150px;
			font-weight: bold;
		}

		h4 {
			margin: 90px 0;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<h1>Welcome To Accounting Firm Application</h1>
	<h4>Login To Continue</h4>
	<a href="login.php" class="btn btn-success">Login</a>
</body>
</html>
