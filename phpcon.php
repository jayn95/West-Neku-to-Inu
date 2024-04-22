<?php

$username = "root";
$password = ""; // Use the correct password here
$server = "localhost";
$db = "forum";

$conn = mysqli_connect($server, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Added semicolon and corrected error message
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $subject = $_POST["subject"];
    $content = $_POST["content"]; // Changed from "area" to "content" to match textarea name
    
    // Escape special characters to prevent SQL injection
    $subject = mysqli_real_escape_string($conn, $subject);
    $content = mysqli_real_escape_string($conn, $content);
    
    // SQL query to insert data into the database (using prepared statement)
    $sql = "INSERT INTO forum_subject (subject, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $subject, $content);
    
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $stmt->close(); // Close the prepared statement
}

$conn->close(); // Close the database connection
?>
