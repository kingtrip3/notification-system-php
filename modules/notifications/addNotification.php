<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = clean($_POST['name']);
	$type = clean($_POST['type']);
	
	$stmt = $db->prepare("INSERT INTO notifications (name, type) VALUES (?, ?)");
    $stmt->bind_param('ss', $name, $type);
    $stmt->execute();
    $stmt->close();

	logger('Notification', 'Add');
	redirect('../../');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Add Notification</title>

	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/mdb.min.css">
</head>
<body>
	<div class="container external">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<h3 class="dark-grey-text text-center">
				<strong>Add Notification</strong>
			</h3>

			<hr>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Name<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="name">
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Type<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="type">
					</div>
				</div>
			</div>

			<div>
				<button type="submit" class="btn btn-primary">Add</button>

				<a class="btn btn-info" href="../../">Cancel</a>
			</div>
		</form>
	</div>

	<script type="text/javascript" src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="../../assets/js/script.js"></script>
</body>
</html>
