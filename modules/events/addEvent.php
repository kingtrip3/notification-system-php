<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$client = clean($_POST['client']);
	$notification = clean($_POST['notification']);
	$date = clean($_POST['date']);
	$frequency = clean($_POST['frequency']);
	
	$stmt = $db->prepare("INSERT INTO events (client_id, notification_id, start_date, frequency) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $client, $notification, $date, $frequency);
    $stmt->execute();
    $stmt->close();

	logger('ClientEvent', 'Add');
	redirect('../../');
}

$stmt1 = $db->prepare("SELECT client_id, company_name FROM clients");
$stmt1->execute();
$stmt1->bind_result($cid, $cname);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Add Client Event</title>

	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/mdb.min.css">
</head>
<body>
	<div class="container external">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<h3 class="dark-grey-text text-center">
				<strong>Add Client Event</strong>
			</h3>

			<hr>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Client<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<select class="form-control" name="client">
							<?php

							while ($stmt1->fetch()) {
								echo "<option value='$cid'>$cname</option>";
							}

							$stmt1->close();

							?>
						</select>
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Notification<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<select class="form-control" name="notification">
							<?php

							$stmt2 = $db->prepare("SELECT id, name FROM notifications");
							$stmt2->execute();
							$stmt2->bind_result($nid, $nname);

							while ($stmt2->fetch()) {
								echo "<option value='$nid'>$nname</option>";
							}

							$stmt2->close();

							?>
						</select>
					</div>
				</div>
			</div>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Start Date<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="date" class="form-control" name="date">
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
						<input type="number" class="form-control" name="frequency">
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
