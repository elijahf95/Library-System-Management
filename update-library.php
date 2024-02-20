<?php

$studentname = $_GET['studentname'];

// Retrieve existing data for the record
$conn = new mysqli("localhost", "library_system", "1234453", "system_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM library WHERE studentname=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $studentname);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

// Update record when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newStudentName = $_POST['studentname'];
    $booktitle = $_POST['booktitle'];
    $timeco = $_POST['timeco'];

    $sql = "UPDATE library SET studentname=?, booktitle=?, timeco=? WHERE studentname=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $newStudentName, $booktitle, $timeco, $studentname);
    $stmt->execute();
    $stmt->close();

    // Redirect to index.php after update
    header('location: index.php');
    exit();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Update Record</h1>
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?studentname=' . urlencode($studentname); ?>" method="POST">
            <div class="form-group">
                <label for="studentname">Student Name:</label>
                <input name="studentname" class="input" type="text" id="studentname" value="<?php echo $row['studentname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="booktitle">Book Title/ID:</label>
                <input name="booktitle" class="input" type="text" id="booktitle" value="<?php echo $row['booktitle']; ?>" required>
            </div>
            <div class="form-group">
                <label for="timeco">Date and Time:</label>
                <input name="timeco" class="input" type="datetime-local" id="timeco" value="<?php echo date('Y-m-d\TH:i', strtotime($row['timeco'])); ?>" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
