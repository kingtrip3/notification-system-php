<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

$username = get_username();

$stmt = $db->prepare("SELECT fname, lname, email, phone, position, picture FROM users WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $email, $phone, $position, $picture);
$stmt->fetch();
$stmt->close();

$directory = "files/thumbnails/";
$img_src = $directory . $picture;

logger('User', 'View');

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
        	<img src="<?php echo $img_src; ?>" alt="No Photo">
        	<p style="margin-top: 32px;"><?php echo $first_name . " " . $last_name; ?></p>
        	<p><?php echo $position; ?></p>
        	<p><?php echo $email; ?></p>
        	<p><?php echo $phone; ?></p>
        	<a href='modules/user/updateUser.php' class='btn btn-primary'>Update</a>
        	<a href="modules/user/uploadPhoto.php" class="btn btn-primary">Upload Photo</a>
        </div>
    </div>
</div>
