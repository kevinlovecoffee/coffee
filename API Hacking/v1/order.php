<?php
header("Content-Type:application/json");
// $response = array("status" => "Order placed!", "orderID" => "1234");

// header("Content-Type: application/json");
// echo json_encode($response);
// exit();

// get the data from the order
// generate an ID for it
// insert it into the db
// return the generated id back to the user

if (isset($_GET['email']) && isset($_GET['coffee']) && isset($_GET['q'])) {
    $email = $_GET['email'];
    $coffee = $_GET['coffee'];
    $quantity = $_GET['q'];

    // sanitise input
    $passed = 0;
    if (strlen($email) < 30 && ($email != '')) { $passed += 1; }
    if (ctype_digit($coffee) && ($coffee < 10000) && ($coffee >= 0)) { $passed += 1; }
    if (ctype_digit($quantity) && ($quantity < 100) && ($quantity > 0)) { $passed += 1; }

    if ($passed != 3) {
        $response = array("status" => "Opps, something with wrong!");
        echo json_encode($response);
        exit();
    }

    // generate orderID
    $prefix = 'order';
    $orderID = uniqid($prefix);
    $order_status = 'pending';

    // insert into db
    include_once('../db.php');
    $stmt = $conn->prepare("INSERT INTO orders (order_id, email, coffee_id, quantity, order_status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiis", $orderID, $email, $coffee, $quantity, $order_status);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    $response = array("status" => "Order placed!", "orderID" => $orderID);
    http_response_code(200);
    echo json_encode($response);
    exit();
} else {
    $response = array("status" => "Opps, something with wrong!");
    http_response_code(400);
    echo json_encode($response);
    exit();
}