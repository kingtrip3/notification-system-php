<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

check_login();

$username = get_username();

$error = '';

$photo_dir = "../../files/pictures/";
$thumb_dir = "../../files/thumbnails/";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$file = $_FILES['image']['tmp_name'];
	$sourceProperties = getimagesize($file);
	$imageType = $sourceProperties[2];
	$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	$imageName = time() . "." . $extension;
	$image = $photo_dir . $imageName;
	$thumb = $thumb_dir . $imageName;

	switch ($imageType) {
		case IMAGETYPE_PNG:
			$imageResource = imagecreatefrompng($file);
			$target = imageResize($imageResource, $sourceProperties[0], $sourceProperties[1]);
			imagepng($target, $thumb);
			break;
		case IMAGETYPE_JPEG:
			$imageResource = imagecreatefromjpeg($file);
			$target = imageResize($imageResource, $sourceProperties[0], $sourceProperties[1]);
			imagejpeg($target, $thumb);
			break;
		default:
			$error = "Only JPEG and PNG Images are Allowed";
			break;
	}

	if (move_uploaded_file($file, $image)) {
		$stmt = $db->prepare("UPDATE users SET picture = ? WHERE username = ?");
		$stmt->bind_param('ss', $imageName, $username);
		$stmt->execute();
		$stmt->close();

		logger('User', 'Upload Image');
		redirect('../../');
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Upload Photo</title>

	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/mdb.min.css">
</head>
<body>
	<div class="container external">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
			<h3 class="dark-grey-text text-center">
				<strong>Upload Photo</strong>
			</h3>

			<hr>

			<div class="md-form">
				<div class="form-row">
					<div class="col">
						<i class="fas fa-user prefix grey-text"></i>
						<label for="">Select Image<span style="display: none" id="id_r">*</span> </label>
					</div>

					<div class="col">
						<input type="file" class="form-control" name="image">
					</div>
				</div>
			</div>

			<div>
				<button type="submit" class="btn btn-primary">Upload</button>

				<a class="btn btn-info" href="../../">Cancel</a>
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
