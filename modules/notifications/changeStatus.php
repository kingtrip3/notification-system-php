<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

if (isset($_GET['enabled'])) {
	$id = $_GET['Nid'];
	$status = ($_GET['enabled'] == "enabled") ? "disabled" : "enabled";

	$stmt = $db->prepare("UPDATE notifications SET status = ? WHERE id = ?");
    $stmt->bind_param('ss', $status, $id);
    $stmt->execute();
    $stmt->close();

    logger('Notification', 'Update');
    redirect('../../');
}

?>
