<?php

$secret = "coffee";

// function to encode token
function encodeJWT($data, $secret) {
    $header = base64_encode(json_encode(array("alg" => "HS256", "typ" => "JWT")));
    $payload = base64_encode(json_encode($data));
    $signature = hash_hmac("sha256", $header . "." . $payload, $secret, true);
    $signature = base64_encode($signature);
    return $header . "." . $payload . "." . $signature;
}

// function to decode token
function decodeJWT($token, $secret) {
    $parts = explode(".", $token);
    if (count($parts) != 3) {
        return false;
    }
    list($header, $payload, $signature) = $parts;
    $signatureCheck = hash_hmac("sha256", $header . "." . $payload, $secret, true);
    $signatureCheck = base64_encode($signatureCheck);
    if ($signature != $signatureCheck) {
        return false;
    }
    return json_decode(base64_decode($payload), true);
}

function response($response_code, $response_desc) {
	$response['response_desc'] = $response_desc;
	http_response_code($response_code);
	echo json_encode($response_desc);
    exit();
}

// grab data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['request']) && !empty($data['request'])) {
    $requestType = $data['request'];
} else {
    http_response_code(400);
    echo json_encode('There was an error with your request');
}
if (isset($data['username']) && !empty($data['username'])) {
    $requestUsername = $data['username'];
}
if (isset($data['password']) && !empty($data['password'])) {
    $requestPassword = $data['password'];
}

// register a new user
if ($requestType == 'register') {
    include_once('../db.php');
    
    if (isset($requestUsername) && isset($requestPassword)) {

        // check if username already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $requestUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt->close();
            $conn->close();
            response(400, 'Opps, that username is already taken!');
            } else {
            // continue with registration
            $sql = "INSERT INTO users (username, password, user_status) VALUES ('$requestUsername', '$requestPassword', 0)";
            // execute the query
            if ($conn->query($sql) === TRUE) {
                response(200, 'New user created!');
            } else {
                response(400, $conn->error);
            }
        }
        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
    response(200, 'Could not create user.');
}

// login
if ($requestType == 'login') {
    include_once('../db.php');
    if (isset($requestUsername) && isset($requestPassword)) {
        $stmt = mysqli_prepare($conn, 'SELECT * FROM users WHERE username = ? AND password = ?');
        mysqli_stmt_bind_param($stmt, 'ss', $requestUsername, $requestPassword);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            // return a JWT
            $data = array("username" => $requestUsername);
            $newToken = encodeJWT($data, $secret);
            response(200, $newToken);
        } else {
            // error
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            response(401, 'There was an error!');
        }
        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
}