<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$cname = clean($_POST['cname']);
	$bnumber = clean($_POST['bnumber']);
	$fname = clean($_POST['fname']);
	$lname = clean($_POST['lname']);
	$pnumber = clean($_POST['pnumber']);
	$cnumber = clean($_POST['cnumber']);
	$website = clean($_POST['website']);

	$stmt = $db->prepare("INSERT INTO clients (company_name, business_number, first_name, second_name, phone_number, cell_number, website) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssss', $cname, $bnumber, $fname, $lname,  $pnumber, $cnumber, $website);
    $stmt->execute();
	$stmt->close();

	logger('Client', 'Add');
	redirect('../../');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Add Client</title>

	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/mdb.min.css">
</head>
<body>
	<div class="container external">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<h3 class="dark-grey-text text-center">
				<strong>Add Client</strong>
			</h3>

			<hr>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Company Name<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="cname">
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Business Number<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="bnumber">
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">First Name<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="fname">
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Last Name<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="lname">
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Phone Number<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="pnumber">
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Cell Number<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="cnumber">
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Website<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="website">
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
