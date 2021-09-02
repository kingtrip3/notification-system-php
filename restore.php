<?php

include 'private/session.php';
include 'private/database.php';
include 'private/functions.php';

check_login();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_FILES)) {
		$file = $_FILES["backup"]["name"];
		$tmp = $_FILES["backup"]["tmp_name"];

		if (!in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), array("sql"))) {
			$error = "Invalid File Type";
		} else {
			if (is_uploaded_file($tmp)) {
				move_uploaded_file($tmp, $file);

				$sql = "";

				if (file_exists($file)) {
					$lines = file($file);

					foreach ($lines as $line) {
						if (substr($line, 0, 2) == '--' || $line == '') {
							continue;
						}

						$sql .= $line;

						if (substr(trim($line), -1, 1) == ';') {
							$result = mysqli_query($db, $sql);

							if (!$result) {
								$error .= mysqli_error($db) . "\n";
							}

							$sql = '';
						}
					}

					exec('rm ' . $file);

					if (!$error) {
						redirect("index.php");
					}
				}
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Restore Database</title>

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/mdb.min.css">
</head>
<body>
	<div class="container external">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
			<h3 class="dark-grey-text text-center">
				<strong>Restore Database</strong>
			</h3>

			<hr>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Choose Backup File<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="file" class="form-control" name="backup">
					</div>
				</div>
			</div>

			<div>
				<button type="submit" class="btn btn-primary">Restore</button>

				<a class="btn btn-info" href="index.php">Cancel</a>
			</div>
		</form>

		<p><?php echo $error; ?></p>
	</div>

	<script type="text/javascript" src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="../../assets/js/script.js"></script>
</body>
</html>
