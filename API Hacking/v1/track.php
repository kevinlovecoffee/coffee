<?php
header("Content-Type:application/json");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // sanitise input
    $passed = 0;
    if (strlen($id) < 50 && ($id != '')) { $passed += 1; }

    if ($passed != 1) {
        $response = array("status" => "Opps, something with wrong!");
        echo json_encode($response);
        exit();
    }

    // insert into db
    include_once('../db.php');
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    $response = array("status" => $order['order_id'], "email" => $order['email'], "tracking_status" => $order['order_status']);
    echo json_encode($response);
    exit();
} else {
    $response = array("status" => "Opps, something with wrong!");
    echo json_encode($response);
    exit();
}