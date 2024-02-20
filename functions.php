<?php

function connectToDatabase(){
    $servername = "localhost";
    $username = "library_system";
    $password = "1234453";
    $dbname = "system_db";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function executeQuery($conn, $sql, $params = []){
    try {
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception($conn->error);
        }

        // Check if it's a SELECT query
        $isSelectQuery = stripos($sql, 'SELECT') === 0;

        if (!$isSelectQuery && !empty($params)) {
            // For non-SELECT queries, proceed with binding parameters
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();

        if ($isSelectQuery) {
            $result = $stmt->get_result();

            if ($result === FALSE) {
                throw new Exception($stmt->error);
            }

            return $result;
        }

        return true; // For non-SELECT queries
    } catch (Exception $e) {
        // Log the exception or handle it appropriately
        echo "Error: " . $e->getMessage();
    
        // Close the statement if it's not null
        if ($stmt !== null) {
            $stmt->close();
        }
    
        // Close the connection and reconnect
        $conn->close();
        $conn = connectToDatabase();
    
        // Retry the query
        return executeQuery($conn, $sql, $params);
    }    
}

function displaylibraryData($conn) {
    $sql_select = "SELECT * FROM library";
    $result = executeQuery($conn, $sql_select);
    $Count = 11;

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead>";
        echo "<tr>
                <th>Increment</th>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>Date and Time</th>
                <th>Action</th>
              </tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            $remainingCount = max(0, $Count - 1);
            echo "<tr>";
            echo "<td>" . $remainingCount . "</td>";
            echo "<td>" . $row["studentname"] . "</td>";
            echo "<td>" . $row["studentid"] . "</td>";
            echo "<td>" . $row["booktitle"] . "</td>";
            echo "<td>" . $row["timeco"] . "</td>";
            echo "<td>";
            echo "<div style='display: inline-block;'>";
            echo "<form action='update-library.php' method='get'>";
            echo "<input type='hidden' name='studentname' value='" . $row["studentname"] . "'>";
            echo "<input type='hidden' name='studentid' value='" . $row["studentid"] . "'>";
            echo "<input type='hidden' name='booktitle' value='" . $row["booktitle"] . "'>";
            echo "<input type='hidden' name='timeco' value='" . $row["timeco"] . "'>";
            echo "<input type='submit' value='Update' style='background-color: #007bff; color: #ffffff; border: none; padding: 8px 17px; border-radius: 4px; cursor: pointer;'>";
            echo "</form>";
            echo "</div>";
            echo "<div style='display: inline-block;'>";
            echo "<form method='GET' action='delete-library.php'>";
            echo "<input type='hidden' name='studentname' value='" . $row["studentname"] . "'>";
            echo "<input type='submit' value='Delete' style='background-color: #dc3545; color: #ffffff; border: none; padding: 8px 19px; border-radius: 5px; cursor: pointer;'>";
            echo "</form>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
            $Count--;
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No records found.";
    }
}
?>