<?php

// Initialize variables for database credentials
$dbhost = "hostname"; // Enter the database hostname
$dbuser = "database"; // Enter the database username
$dbpass = "username"; // Enter the database password
$dbname = "password"; // Enter the database name

// Create database connection
$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check if the connection was successful
if ($dblink->connect_errno) {
  printf("Failed to connect to database");
  exit();
}

header("Content-type: application/json"); // Set the response content type as JSON

// Fetch rows from the "Sensor" table
$result = $dblink->query("SELECT * FROM Sensor");

// Initialize an array variable
$dbdata = [];

// Fetch rows into an associative array
while ($row = $result->fetch_assoc()) {
  $dbdata[] = $row;
}

// Print the array in JSON format
echo json_encode($dbdata);

?>
