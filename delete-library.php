<?php

// Retrieve the student name from the URL parameter
$studentname = $_GET['studentname'];

// Create a new MySQLi connection
$conn = new mysqli("localhost", "library_system", "1234453", "system_db");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement with a placeholder
$sql = "DELETE FROM library WHERE studentname = ?";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $studentname);

// Execute the statement
$stmt->execute();

// Close statement
$stmt->close();

// Close connection
$conn->close();

// Redirect to index.php after deletion
header('location: index.php');
exit();

?>
