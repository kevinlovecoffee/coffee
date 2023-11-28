<?php

$servername = "db"; // Use the service name defined in docker-compose.yml
$username = "root";
$password = "password";
$dbname = "api_midcourse_capstone";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SHOW TABLES LIKE 'coffee'");

if ($result->num_rows == 0) {
    // Read SQL file content
    $sql = file_get_contents('init.sql');

    // Execute SQL file
    if ($conn->multi_query($sql) === TRUE) {
        echo "Database initialized successfully";
    } else {
        echo "Error initializing database: " . $conn->error;
    }
}

$conn->close();

?>