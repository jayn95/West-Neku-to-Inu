<?php
include "cfg/db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $subject = $_POST["subject"];
    $content = $_POST["content"]; // Changed from "area" to "content" to match textarea name
    
    // Escape special characters to prevent SQL injection
    $subject = mysqli_real_escape_string($db, $subject);
    $content = mysqli_real_escape_string($db, $content);
    
    // SQL query to insert data into the database (using prepared statement)
    $sql = "INSERT INTO forum_subject (subject, content) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $subject, $content);
    
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
    
    $stmt->close(); // Close the prepared statement
}

$db->close(); // Close the database connection
?>