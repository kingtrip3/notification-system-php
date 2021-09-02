<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = clean($_POST['id']);
	$name = clean($_POST['name']);
	
	$stmt = $db->prepare("UPDATE notifications SET name = ? WHERE id = ?");
    $stmt->bind_param('ss', $name, $id);
    $stmt->execute();
    $stmt->close();

    logger('Notification', 'Update');
	redirect('../../');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Update Client</title>

	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/mdb.min.css">
</head>
<body>
	<div class="container external">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<h3 class="dark-grey-text text-center">
				<strong>Change Notification Name</strong>
			</h3>

			<hr>

			<input type="text" name="id" value="<?php echo $_GET['Nid']; ?>" style="display: none;">

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Name<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="name" value="<?php echo $_GET['name']; ?>">
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
