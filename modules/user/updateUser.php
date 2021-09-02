<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

check_login();

$username = get_username();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$fname = clean($_POST['fname']);
	$lname = clean($_POST['lname']);
	$email = clean($_POST['email']);
	$phone = clean($_POST['phone']);
	$position = clean($_POST['position']);

	$stmt = $db->prepare("UPDATE users SET fname = ?, lname = ?, email = ?, phone = ?, position = ? WHERE username = ?");
	$stmt->bind_param('ssssss', $fname, $lname, $email, $phone, $position, $username);
	$stmt->execute();
	$stmt->close();

	logger('User', 'Update');
	redirect('../../');
}

$stmt = $db->prepare("SELECT fname, lname, email, phone, position FROM users WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($fname, $lname, $email, $phone, $position);
$stmt->fetch();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Update User</title>

	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/mdb.min.css">
</head>
<body>
	<div class="container external">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<h3 class="dark-grey-text text-center">
				<strong>Update User</strong>
			</h3>

			<hr>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">First Name<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>">
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
						<input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>">
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Email<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Phone<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Position<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<select class="form-control" name="position">
							<option <?php if ($position == 'Manager') echo "selected"; ?> value="Manager">Manager</option>
							<option <?php if ($position == 'Senior Accountant') echo "selected"; ?> value="Senior Accountant">Senior Accountant</option>
							<option <?php if ($position == 'Junior Accountant') echo "selected"; ?> value="Junior Accountant">Junior Accountant</option>
							<option <?php if ($position == 'Chartered Accountant') echo "selected"; ?> value="Chartered Accountant">Chartered Accountant</option>
							<option <?php if ($position == 'Book Keeper') echo "selected"; ?> value="Book Keeper">Book Keeper</option>
						</select>
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
