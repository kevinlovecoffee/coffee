<?php
$servername = "db";
$username = "apiMidcourseCapstone";
$password = "iAmAWeakPassword";
$dbname = "api_midcourse_capstone";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

// CREATE USER 'apiMidcourseCapstone'@'localhost' IDENTIFIED BY 'iAmAWeakPassword';
// GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT  on api_midcourse_capstone.* TO 'apiMidcourseCapstone'@'localhost';
// create table coffee (id int NOT NULL, name varchar(255), origin varchar(255), roast_level varchar(20), PRIMARY KEY (id));
// insert into coffee values (0, "Revival", "Ethopia", "5");
// insert into coffee values (1, "Rise and shine", "Ethopia", "4");
// insert into coffee values (2, "Jitters", "Ethopia", "4");
// create table orders (id int NOT NULL AUTO_INCREMENT, order_id varchar(20), email varchar(255), coffee_id int, quantity int, order_status varchar(20), PRIMARY KEY (id));
// create table users (id int NOT NULL, username varchar(255), password varchar(255), user_status int, PRIMARY KEY (id));