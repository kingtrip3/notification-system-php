<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

$stmt = $db->prepare("SELECT * FROM notifications");
$stmt->execute();
$stmt->bind_result($id, $name, $type, $status);

?>

<div class="container">
    <div class="row">
        <a href="modules/notifications/addNotification.php" class="btn btn-success">add new notification</a>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-sm" id="myTable">
                <thead>
                    <tr>
                        <th class="text-uppercase">ID</th>
                        <th class="text-uppercase">Name</th>
                        <th class="text-uppercase">Type</th>
                        <th class="text-uppercase">Status</th>
                        <th class="text-uppercase">Enable/Disable</th>
                        <th class="text-uppercase">update</th>
                        <th class="text-uppercase">delete</th>
                    </tr>
                </thead>
                <tbody id="data">
                    <?php

                    while ($stmt->fetch()) {
                        $prompt = ($status == "enabled") ? "disable" : "enable";

                        echo "<tr><td>" . $id . "</td><td>" . $name . "</td><td>" . $type . "</td><td>" . $status . "</td><td><a href='modules/notifications/changeStatus.php?enabled=" . $status . "&Nid=" . $id . "' class='btn btn-sm btn-warning'>" . $prompt . "</a></td><td><a href='modules/notifications/changeName.php?Nid=" . $id . "&name=" . $name . "' class='btn btn-sm btn-success'>Change Name</a><td><a href='modules/notifications/deleteNotification.php?archive=" . $id . "' class='btn btn-sm btn-danger'>Archive</a></tr>";
                    }

                    $stmt->close();

                    logger('Notification', 'View');

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
