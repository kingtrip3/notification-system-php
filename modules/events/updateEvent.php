<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = clean($_POST['id']);
	$date = clean($_POST['date']);
	$frequency = clean($_POST['frequency']);

	$stmt = $db->prepare("UPDATE events SET start_date = ?, frequency = ? WHERE id = ?");
    $stmt->bind_param("sss", $date, $frequency, $id);
    $stmt->execute();
    $stmt->close();

	logger('ClientEvent', 'Update');
	redirect('../../');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Update Client Event</title>

	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/mdb.min.css">
</head>
<body>
	<div class="container external">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<h3 class="dark-grey-text text-center">
				<strong>Update Client Event</strong>
			</h3>

			<hr>

			<input type="text" name="id" value="<?php echo $_GET['id']; ?>" style="display: none;">

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Start Date<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="date" class="form-control" name="date" value="<?php echo $_GET['date']; ?>">
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Frequency<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="number" class="form-control" name="frequency" value="<?php echo $_GET['frequency']; ?>">
					</div>
				</div>
			</div>

			<div>
				<button type="submit" class="btn btn-primary">Update</button>

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
