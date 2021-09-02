<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

$sql = "SELECT events.id, clients.company_name, notifications.name, start_date, frequency FROM events INNER JOIN clients ON events.client_id = clients.client_id INNER JOIN notifications ON events.notification_id = notifications.id";
$stmt = $db->prepare($sql);
$stmt->execute();
$stmt->bind_result($id, $cname, $nname, $date, $frequency);

?>

<div class="container">
    <div class="row">
        <a href="modules/events/addEvent.php" class="btn btn-success">add new event</a>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-sm" id="myTable">
                <thead>
                    <tr>
                        <th class="text-uppercase">Client</th>
                        <th class="text-uppercase">Notification</th>
                        <th class="text-uppercase">Start Date</th>
                        <th class="text-uppercase">Frequency</th>
                        <th class="text-uppercase">Update</th>
                        <th class="text-uppercase">Delete</th>
                    </tr>
                </thead>
                <tbody id="data">
                    <?php

                    while ($stmt->fetch()) {
                        echo "<tr><td>" . $cname . "</td><td>" . $nname . "</td><td>" . $date . "</td><td>" . $frequency . "</td><td><a href='modules/events/updateEvent.php?id=" . $id . "&date=" . $date . "&frequency=" . $frequency . "' class='btn btn-sm btn-success'>Update</a><td><a href='modules/events/deleteEvent.php?archive=" . $id . "' class='btn btn-sm btn-danger'>Archive</a></tr>";
                    }

                    $stmt->close();

                    logger('ClientEvent', 'View');

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
