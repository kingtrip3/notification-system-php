<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

if (isset($_GET['archive'])) {
	$id = $_GET['archive'];

	$stmt = $db->prepare("DELETE FROM notifications WHERE id = ?");
	$stmt->bind_param('s', $id);
	$stmt->execute();
	$stmt->close();

	logger('Notification', 'Delete');
	redirect('../../');
}

?>
