<?php

// Retrieve form data
$studentname = $_POST['studentname'];
$studentid = $_POST['studentid'];
$booktitle = $_POST['booktitle'];
$timeco = $_POST['timeco'];

// Create a new MySQLi connection
$conn = new mysqli("localhost", "library_system", "1234453", "system_db");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement with placeholders
$sql = "INSERT INTO library (studentname, studentid, booktitle, timeco) VALUES (?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $studentname, $studentid, $booktitle, $timeco);

// Execute the statement
$stmt->execute();

// Close statement
$stmt->close();

// Close connection
$conn->close();

// Redirect to index.php after insertion
header('location: index.php');
exit();

?>
