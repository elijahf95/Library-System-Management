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
                   
                    <input name="studentname" class="input" type="text" required="required" id="studentname" required>
                    <span class="user">Student Name</span>
                </div>
                <div class="form-group">

                    <input name="studentid" class="input" type="text" required="required" id="studentid" required>
                    <span>Student ID</span>
                </div>
                <div class="form-group">
                    <input name="booktitle" class="input" type="text" id="booktitle" required>
                    <span>Book Title</span>
                </div>
                <div class="form-group">
                    <label for="datetime">Date and Time:</label>
                    <input name="datetime" class="input" type="datetime-local" required="required" id="datetime" required>
                </div>
                <button type="submit" class="enter">Submit</button>
            </form>
        </div>
    </div>
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