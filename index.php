<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
        <a class="lib"> Library Management System</a>
        <div class="inputBox1">
        <form class="form" action="add-library.php" method="POST" id="library-form">
            <div class="form-group">
                <label for="studentname">Student Name:</label>
                <input name="studentname" class="input" type="text" required="required" id="studentname" required>
            </div>
            <div class="form-group">
                <label for="studentid">Student ID:</label>
                <input name="studentid" class="input" type="text" required="required" id="studentid" required>
            </div>
            <div class="form-group">
                <label for="booktitle">Book Title/ID:</label>
                <input name="booktitle" class="input" type="text" id="booktitle" required>
            </div>
            <div class="form-group">
                <label for="datetime">Date and Time:</label>
                <input name="datetime" class="input" type="datetime-local" required="required" id="datetime" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- JavaScript for client-side validation -->
    <script>
        const form = document.getElementById('library-form');

        form.addEventListener('submit', function(event) {
            const inputs = form.querySelectorAll('input');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    isValid = false;
                    // Optionally, you can add error messages or styling here
                }
            });

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    </script>
</body>
</html>
<?php include "functions.php"; 

$conn = connectToDatabase();

displaylibraryData($conn);

$conn->close();
?>