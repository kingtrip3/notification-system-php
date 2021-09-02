<?php

include '../../private/session.php';
include '../../private/database.php';
include '../../private/functions.php';

$stmt = $db->prepare("SELECT * FROM clients");
$stmt->execute();
$stmt->bind_result($client_id, $company_name, $business_number, $first_name, $second_name, $phone_number, $cell_number, $website);

?>

<div class="container">
    <div class="row">
        <a href="modules/client/addClient.php" class="btn btn-success">
            add new client
        </a>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-sm" id="myTable">
                <thead>
                    <tr>
                        <th class="text-uppercase">Client ID</th>
                        <th class="text-uppercase">Company Name</th>
                        <th class="text-uppercase">Bussiness number</th>
                        <th class="text-uppercase">First name</th>
                        <th class="text-uppercase">Second Name</th>
                        <th class="text-uppercase">Phone Number</th>
                        <th class="text-uppercase">Cell number</th>
                        <th class="text-uppercase">Website</th>
                        <th class="text-uppercase">update</th>
                        <th class="text-uppercase">archive</th>
                    </tr>
                </thead>
                <tbody id="data">
                    <?php

                    while ($stmt->fetch()) {
                        echo "<tr><td>" . $client_id . "</td><td>" . $company_name . "</td><td>" . $business_number . "</td><td>" . $first_name . "</td><td>" . $second_name . "</td><td>" . $phone_number . "</td><td>" . $cell_number . "</td><td>" . $website . "</td><td><a href='modules/client/updateClient.php?id=" . $client_id . "&cname=" . $company_name . "&bnumber=" . $business_number . "&fname=" . $first_name . "&lname=" . $second_name . "&pnumber=" . $phone_number . "&cnumber=" . $cell_number . "&website=" . $website . "' class='btn btn-sm btn-success'>Update</a><td><a href='modules/client/deleteClient.php?archive=" . $client_id . "' class='btn btn-sm btn-danger'>Archive</a></tr>";
                    }

                    $stmt->close();

                    logger('Client', 'View');

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
