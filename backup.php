<?php

include 'private/session.php';
include 'private/database.php';
include 'private/functions.php';

check_login();

$tables = array();
$sql = "SHOW TABLES";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_row($result)) {
	$tables[] = $row[0];
}

$script = "";

foreach ($tables as $table) {
	$query = "SHOW CREATE TABLE $table";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_row($result);

	$script .= "\n\n" . $row[1] . ";\n\n";

	$query = "SELECT * FROM $table";
	$result = mysqli_query($db, $query);

	$num_fields = mysqli_num_fields($result);

	for ($i = 0; $i < $num_fields; $i++) { 
		while ($row = mysqli_fetch_row($result)) {
			$script .= "INSERT INTO $table VALUES (";

			for ($j = 0; $j < $num_fields; $j++) { 
				$row[$j] = $row[$j];

				if (isset($row[$j])) {
					$script .= '"' . $row[$j] . '"';
				} else {
					$script .= '""';
				}

				if ($j < ($num_fields - 1)) {
					$script .= ',';
				}
			}

			$script .= ");\n";
		}
	}

	$script .= "\n";
}

if (!empty($script)) {
	$location = "files/backup/";
	$backup = $location . $db_name . "_backup_" . time() . ".sql";

	$handler = fopen($backup, "w+");
	fwrite($handler, $script);
	fclose($handler);

	redirect("index.php");
}

?>
