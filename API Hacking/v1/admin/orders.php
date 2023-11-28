<?php

header("Content-Type:application/json");
include_once('../../db.php');

$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$coffee_data = array();
	while($row = $result->fetch_assoc()) {
		$coffee_data[] = $row;
	}
	echo json_encode($coffee_data);
} else {
	echo json_encode('Error');
}
$conn->close();
